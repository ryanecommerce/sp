<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Shoplist;
use Socialite;

class SocialController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'destroy']);
    }

    /**
     * Redirect the user to the OAuth Provider.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $shoplists = Shoplist::all();
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);

        if(!$authUser->activated){
            return view('users.social')->with(compact('authUser'))->with(compact('shoplists'));
        }

        auth()->login($authUser);
        flash(auth()->user()->name . '님, 환영합니다.');

        return redirect('/');

    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
//    public function findOrCreateUser($user, $provider)
//    {
//        $authUser = User::where('provider_id', $user->id)->first();
//        if ($authUser) {
//            return $authUser;
//        }
//        return User::create([
//            'name'     => $user->name,
//            'email'    => $user->email,
//            'provider' => $provider,
//            'provider_id' => $user->id
//        ]);
//    }

    public function findOrCreateUser($user, $provider)
    {

        $authUser = User::where('provider_id', $user->id)->first();

        if ($authUser) {
            return $authUser;
        }

        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id
        ]);

    }

//    public function userComfirmed($user)
//    {
//        $user = User::create([
//            'name'     => $user->name,
//            'email'    => $user->email,
//            'provider' => $provider,
//            'provider_id' => $user->id
//        ]);
//    }

    public function update(Request $request)
    {
//        $this->validate($request, [
//            'shop_id' => 'required',
//            'agree_terms' => 'required',
//            'agree_privacy' => 'required',
//        ],$messages = [
//            'shop_id.required' => '* 쇼핑몰을 선택해주세요.',
//            'agree_terms.required' => '* 서비스 약관 동의해 주세요.',
//            'agree_privacy.required' => '* 개인정보 수집 및 이용에 동의해 주세요.',
//        ]);

        $user = $request->all();

        $authUser = User::where('provider_id', $user["provider_id"])->first();

        $authUser->update([
            'shop_id' => $request->shop_id,
            'activated' => '1',
            'agree_terms' => date('Y-m-d H:i:s'),
            'agree_privacy' => date('Y-m-d H:i:s'),
        ]);

        auth()->login($authUser);
        flash(auth()->user()->name . '님. 환영합니다.');

        return redirect('/');
    }

}
