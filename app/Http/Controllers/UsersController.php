<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Shoplist;
use Spatie\Permission\Models\Role;
use DB;

class UsersController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('guest');
    }*/

    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $shoplists = Shoplist::all();
        $roles = Role::pluck('name','name')->all();
        return view('users.create')->with(compact('roles'))->with(compact('shoplists'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|confirmed|min:6',
            'shop_id' => 'required',
            'agree_terms' => 'required',
            'agree_privacy' => 'required',
        ],$messages = [
            'name.required' => '* 이름 또는 닉네임을 정확히 입력해주세요.',
            'email.required' => '* 이메일을 정확히 입력해주세요.',
            'password.required' => '* 비밀번호를 정확히 입력해주세요.',
            'password_confirmation.required' => '* 입력하신 비밀번호와 동일하게 입력해주세요.',
            'shop_id.required' => '* 쇼핑몰을 선택해주세요.',
            'agree_terms.required' => '* 서비스 약관 동의해 주세요.',
            'agree_privacy.required' => '* 개인정보 수집 및 이용에 동의해 주세요.',
        ]);


        $confirmCode = str_random(60);

        $user = \App\User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'provider' => 'native',
            'provider_id' => '0',
            'confirm_code' => $confirmCode,
            'shop_id' => $request->shop_id,
            'agree_terms' => '1',
            'agree_privacy' => '1',
        ]);

        $user->assignRole('default');

        /* \Mail::send('emails.auth.confirm', compact('user'), function ($message) use ($user) {
            $message->to($user->email);
            $message->subject(
                sprintf('[%s] 회원 가입을 확인해 주세요.', config('app.name'))
            );
    }); Change to Event*/

        event(new \App\Events\UserCreated($user));

        //flash('가입하신 메일 계정으로 가입 확인 메일을 보내드렸습니다.가입 확인하시고 로그인 해주세요.');
        //return redirect('/');

        return $this->respondCreated('가입하신 메일 계정으로 가입 확인 메일을 보내드렸습니다.가입 확인하시고 로그인 해주세요.');
    }

    protected function respondCreated($message)
    {
        flash($message);

        return redirect('/');
    }

    public function confirm($code)
    {
        $user = \App\User::whereConfirmCode($code)->first();

        if (! $user) {
            flash('URL이 정확하지 않습니다.');

            return redirect('/');
        }

        $user->activated = 1;
        $user->confirm_code = null;
        $user->save();

        auth()->login($user);
        flash(auth()->user()->name . '님, 환영합니다. 가입 확인 되었습니다.');

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $user = User::find($id);

        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.edit',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();

        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));
        }


        $user = User::find($id);

        $user->update($input);

        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success','User updated successfully');
    }


    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)
    {
        User::find($id)->delete();

        return redirect()->route('users.index')
            ->with('success','User deleted successfully');

    }
}
