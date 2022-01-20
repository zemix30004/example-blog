<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pages.profile', ['user' => $user]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(Auth::user()->id),
            ],
            'avatar' => 'nullable|image',
        ]);
        $user = Auth::user();
        $user = User::add($request->all());
        $user->edit($request->all());
        $user->generatePassword($request->get('password'));
        $user->getImage($request->file('avatar'));

        return redirect()->back()->with('message', 'Профиль успешно обновлен!');
    }
}
