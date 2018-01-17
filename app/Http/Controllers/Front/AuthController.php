<?php

namespace App\Http\Controllers\Front;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use SocialiteProviders\Manager\Config;

class AuthController extends Controller
{
    /**
     * Метод делает запрос в вк на авторизацю
     * @return mixed
     */
    public function vkLogin()
    {
        $clientId = env('VKONTAKTE_KEY');
        $clientSecret = env('VKONTAKTE_SECRET');
        $redirectUrl = env('VKONTAKTE_REDIRECT_URI');
        $config = new Config($clientId, $clientSecret, $redirectUrl);
        return Socialite::with('vkontakte')
            ->setConfig($config)
            ->setScopes([])
            ->redirect();
    }

    /**
     * Коллбек с вк, добавляем в базу и авторизуем пользователя, а если есть в базе, то просто авторизуем
     * @return \Illuminate\Http\RedirectResponse
     */
    public function AuthVk()
    {
        $user = Socialite::driver('vkontakte')->user();

        $isUserVk = User::isVk($user->user['uid']);
        if(!$isUserVk){
            $newUser = User::add([
                'uids'=>$user->user['uid'],
                'name'=>$user->user['first_name'],
                'vk_url'=>'https://vk.com/id'.$user->user['uid']
            ]);
            Auth::login($newUser);
            return redirect('/')->with('status', 'Вы вошли в систему');
        }else
        {
            Auth::login($isUserVk);
            return redirect('/')->with('status', 'Вы вошли в систему');
        }
    }

    /**
     * Выход
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
