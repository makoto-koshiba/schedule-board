<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User; // 追加

class UsersController extends Controller
{
     public function index()
    {
        // ユーザ一覧をidの降順で取得
        $users = User::all();

        // ユーザ一覧ビューでそれを表示
        return view('users.index', [
            'users' => $users,
        ]);
    }
    public function create()
    {
        $user = new User;

        // ユーザー作成ビューを表示
        return view('users.create', [
            'user' => $user,
        ]);
    }
    
    public function store(Request $request)
    {
        // メンバーを作成
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        // ユーザー一覧へリダイレクトさせる
        return redirect()->route('users.index');
    }
    
     public function destroy($id)
    {
        // idの値でメンバーを検索して取得
        $user = User::findOrFail($id);
        // メンバーを削除
        $user->delete();

      // 前のURLへリダイレクトさせる
        return redirect()->route('users.index');
    }
}
