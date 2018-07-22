<?php

namespace App\Http\Controllers;

use App\News;
use App\Attachments_news;
use Illuminate\Http\Request;
use App\Tag;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('permission:role-list');
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request, $slug = null)
    {
        $query = $slug
            ? \App\Tag::whereSlug($slug)->firstOrFail()->news()
            : new \App\News;

        $newshub = $query->latest()->paginate(30);

        if ($request->ajax()) {

            $view = view('newshub.partial.news', compact('newshub'))->render();

            return response()->json(['html' => $view]);
        }

        //$posts = \App\Post::latest()->paginate(10);

        return view('newshub/list', compact('newshub'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $news = new News;

        return view('newshub.create', compact('news'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\PostsRequest $request)
    {
        $rules = [
            'title' => ['required'],
            'link' => ['required'],
        ];

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $newshub = $request->user()->news()->create($request->all());

        if ($request->hasfile('files')) {
            $files = $request->file('files');



            foreach($files as $file) {

                $fileGetSize = $file->getSize();

                $filename = str_random().filter_var($file->getClientOriginalName(), FILTER_SANITIZE_URL);
                $file->move(attachments_news_path(), $filename);

                $newshub->attachments_news()->create([
                    'news_id' => $newshub->id,
                    'filename' => $filename,
                    'bytes' => $fileGetSize,
                    'mime' => $file->getClientMimeType()
                ]);
            }
        }

        $newshub->tags()->sync($request->input('tags'));

        if (! $newshub) {
            return back()->with('flash message', '글이 저장되지 않았습니다.')->withInput();
        }

        return redirect(route('/'))->with('flash_message', '작성하신 글이 저장되었습니다.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(\App\News $news)
    {
        return view('newshub.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\News $news)
    {
        $this->authorize('update', $news);

        return view('newshub.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, \App\News $news)
    {
        $news->update($request->all());
        $news->tags()->sync($request->input('tags'));

        flash()->success('수정하신 내용을 저장했습니다.');

        return redirect(route('newshub.show', $news->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\App\News $news)
    {
        $this->authorize('delete', $news);

        $news->delete();

        return response()->json([], 204);
    }
}
