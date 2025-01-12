<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Cep;
use App\Models\Currency;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {
        if (Auth::user()->type !== 'Admin') {
            $users = User::where('id', Auth::id())->get();
       
            return view('users.index', compact('users'));
        } else {
            $users = User::all();
            return view('users.index', compact('users'));
        }
    }

    public function create() {
        if (Auth::user()->type !== 'Admin') {
            return redirect('/users')->withErrors('Somente administradores têm permissão para cadastrar usuários.');
        } else {
            $ceps = Cep::orderBy('cep', 'asc')->get();
            $currencies = Currency::all();
            $defaultType = 'Cliente';
            $defaultStatus = 'Ativo';
            
            return view('/users/create', compact('ceps', 'currencies', 'defaultType', 'defaultStatus'));
        }  
    }

    public function store(Request $request) {
        $defaultType = 'Cliente';
        $defaultStatus = 'Ativo';

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'cep_id' => 'nullable|exists:ceps,id',
            'address_number' => 'nullable|string',
            'status' => 'required|in:Ativo,Inativo',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'preferred_currency_id' => 'nullable|exists:currencies,id',
            'type' => ['nullable', 'in:Admin,Cliente,Outro'],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $validated['email'];
        $user->password = bcrypt($request->password);
        $user->type = $request->type ?? $defaultType;
        $user->cep_id = $request->cep_id;
        $user->address_number = $request->address_number;
        $user->address_complement = $request->address_complement;
        $user->status = $request->status ?? $defaultStatus;
        if ($request->hasFile('profile_image')) {
            $user->profile_image = $request->file('profile_image')->store('profile_images', 'public');
        }
        $user->preferred_currency_id = $request->preferred_currency_id;

        $user->save();

        return redirect( '/users' )->with('msg', 'Usuário registrado com sucesso!');
    }

    public function destroy($id) {
        if (Auth::user()->type !== 'Admin') {
            return redirect('/users')->withErrors('Você não tem permissão para excluir este usuário.');
        } else {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect('/users')->with('msg', 'Usuário excluído com sucesso!');
        }
    }

    public function edit($id) {
        if (Auth::user()->type !== 'Admin') {
            return redirect('/users')->withErrors('Somente administradores têm permissão para editar usuários.');
        } else {
            $user = User::findOrFail($id);
            $ceps = Cep::orderBy('cep', 'asc')->get();
            $currencies = Currency::all();
            return view('/users.edit', ['user' => $user, 'ceps' => $ceps, 'currencies' => $currencies]);
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'type' => ['nullable', 'in:Admin,Cliente,Outro'],
            'cep_id' => 'nullable|exists:ceps,id',
            'address_number' => 'nullable|string',
            'status' => 'required|in:Ativo,Inativo',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'preferred_currency_id' => 'nullable|exists:currencies,id',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->type = $request->type;
        $user->cep_id = $request->cep_id;
        $user->address_number = $request->address_number;
        $user->address_complement = $request->address_complement;
        $user->status = $request->status;
        if ($request->hasFile('profile_image')) {
            $user->profile_image = $request->file('profile_image')->store('profile_images', 'public');
        }
        $user->preferred_currency_id = $request->preferred_currency_id;
        
        $user->save();

        return redirect('/users')->with('msg', 'Usuário atualizado com sucesso!');
    }
}