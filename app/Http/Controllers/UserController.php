<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data Seluruh User',
            'data_user' => User::all(),
        );

        return view('admin.user.list', $data);
    }

    public function store(Request $request)
    {
        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => $request->level,
        ]);

        return redirect('/user')->with('success', 'Data berhasil disimpan !');
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => $request->level,
        ]);

        return redirect('/user')->with('success', 'Data berhasil diubah !');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect('/user')->with('success', 'Data berhasil dihapus !');
    }
}
