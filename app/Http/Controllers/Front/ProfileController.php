<?php
namespace App\Http\Controllers\Front;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
class ProfileController extends Controller
{
    /**
     * @return $this
     */
    public function index()
    {
        $user = Auth::user();
        return view('front.profile')->with('user', $user);
    }
    /**
     * @return $this
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(Auth::user()->id),
            ],
            'login' => [
                'required',
                Rule::unique('users')->ignore(Auth::user()->id),
            ],
            'password' => 'confirmed'

        ]);
        $user = Auth::user();
        $user->edit($request->all());
        $user->generatePassword($request->get('password'));
        return redirect()->back()->with('statusProfile', 'Профиль успешно обновлен');
    }
}