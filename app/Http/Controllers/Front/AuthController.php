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
        if(!Auth::check())
        {
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
        }else
        {
            $profile = User::find(Auth::user()->id);
            $profile->addFieldsVk([
                'uids'=>$user->user['uid'],
                'vk_url'=>'https://vk.com/id'.$user->user['uid']
            ]);
            Auth::login($profile);
            return redirect()->back()->with('statusProfile', 'Вы прявязали аккаунт от VK');
        }
    }

    /**
     * Показать форму восстановления пароля
     */
    public function resetPassShowForm()
    {
        return view('front.reset');
    }

    /**
     * Восстановить пароль
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function resetPass(Request $request)
    {
        $this->validate($request,[
            'email' =>  'required|email',
           ]);
        dd($request->all());
       // return redirect()->back()->with('statusLogin', 'Неправильный логин или пароль');
    }
    /**
     * Показать форму авторизации
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loginForm()
    {
        return view('front.login');
    }

    /**
     * Залогинить пользователя
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(Request $request)
    {
        $this->validate($request,[
            'login' => 'required',
            'password' => 'required'
        ]);
        //Попытаться на основе полей залоигинить пользователя
        if(Auth::attempt([
            'login' => $request->get('login'),
            'password' => $request->get('password'),
        ]))
        {
            return redirect('/');
        }
        return redirect()->back()->with('statusLogin', 'Неправильный логин или пароль');
    }

    /**
     * Отобразить форму регистрации
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function registerForm()
    {
        return view('front.register');
    }

    /**
     * Зарегестрировать пользователя
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'login' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);
        $user = User::add($request->all());
        $user->generatePassword($request->get('password'));
        return redirect('/login');
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
