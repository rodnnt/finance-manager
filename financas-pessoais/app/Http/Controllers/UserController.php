<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Cep;
use App\Models\Coin;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $ceps = Cep::all();
        $coins = Coin::all();
        $defaultType = 'Cliente';
        $defaultStatus = 'Ativo';

        return view('/users/create', compact('ceps', 'coins', 'defaultType', 'defaultStatus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'cep_id' => 'nullable|exists:ceps,id',
            'address_number' => 'nullable|string',
            'status' => 'required|in:Ativo,Inativo',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'preferred_coin_id' => 'nullable|exists:coins,id',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->cep_id = $request->cep_id;
        $user->address_number = $request->address_number;
        $user->address_complement = $request->address_complement;
        $user->status = $request->status;
        if ($request->hasFile('profile_image')) {
            $user->profile_image = $request->file('profile_image')->store('profile_images', 'public');
        }
        $user->preferred_coin_id = $request->preferred_coin_id;

        $user->save();

        return redirect( '/users' )->with('msg', 'Usuário registrado com sucesso!'); //validar isso
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect( '/users' )->with('msg', 'Usuário excluído com sucesso!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $ceps = Cep::all();
        $coins = Coin::all();
        return view( '/users.edit', [ 'user' => $user, 'ceps' => $ceps, 'coins' => $coins ] );
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'cep_id' => 'nullable|exists:ceps,id',
            'address_number' => 'nullable|string',
            'status' => 'required|in:Ativo,Inativo',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'preferred_coin_id' => 'nullable|exists:coins,id',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->cep_id = $request->cep_id;
        $user->address_number = $request->address_number;
        $user->address_complement = $request->address_complement;
        $user->status = $request->status;
        if ($request->hasFile('profile_image')) {
            $user->profile_image = $request->file('profile_image')->store('profile_images', 'public');
        }
        $user->preferred_coin_id = $request->preferred_coin_id;
        
        $user->save();

        return redirect('/users')->with('msg', 'Usuário atualizado com sucesso!');
    }
}