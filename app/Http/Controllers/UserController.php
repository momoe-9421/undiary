<?php

namespace App\Http\Controllers;

use App\User; // App\User クラスをインポートする
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show()
    {
        $user = User::find(1); // ユーザーID:1 のユーザー情報を取得して $user 変数に代入する
        return view('users.show', ['user' => $user]);
        return view('users.show');
    }
}
