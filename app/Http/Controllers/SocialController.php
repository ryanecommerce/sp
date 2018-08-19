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

//        $authUser = $this->findOrCreateUser($user, $provider);

//        auth()->login($authUser);
//        flash(auth()->user()->name . '님. 환영합니다.');

        return view('users.social')->with(compact('authUser'))->with(compact('shoplists'));
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




}
