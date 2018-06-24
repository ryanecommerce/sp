<?php

namespace App\Http\Controllers;

use App\Post;
use App\Attachment;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index($slug = null)
    {
        $query = $slug
            ? \App\Tag::whereSlug($slug)->firstOrFail()->posts()
            : new \App\Post;

        $posts = $query->latest()->paginate(10);

        //$posts = \App\Post::latest()->paginate(10);

        return view('index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post;

        return view('posts.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\PostsRequest $request, \App\Post $post)
    {
        if ($request->hasfile('files')) {
            $files = $request->file('files');


            foreach($files as $file) {

                $fileGetSize = $file->getSize();


                $filename = str_random().filter_var($file->getClientOriginalName(), FILTER_SANITIZE_URL);
                $file->move(attachments_path(), $filename);



                $post->attachments()->create([
                    'filename' => $filename,
                    'bytes' => $fileGetSize,
                    'mime' => $file->getClientMimeType()
                ]);
            }
        }

        $rules = [
            'title' => ['required'],
            'content' => ['required', 'min:10'],
        ];

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $post = $request->user()->posts()->create($request->all());

        if (! $post) {
            return back()->with('flash message', '글이 저장되지 않았습니다.')->withInput();
        }

        $post->tags()->sync($request->input('tags'));

        return redirect(route('/'))->with('flash_message', '작성하신 글이 저장되었습니다.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, \App\Post $post)
    {
        $post->update($request->all());
        $post->tags()->sync($request->input('tags'));

        flash()->success('수정하신 내용을 저장했습니다.');

        return redirect(route('posts.show', $post->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\App\Post $post)
    {

        $this->authorize('delete', $post);

        $post->delete();

        return response()->json([], 204);
    }

}
