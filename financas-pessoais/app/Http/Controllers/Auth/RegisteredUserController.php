<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Cep;
use App\Models\Currency;

class RegisteredUserController extends Controller
{
    public function create()
    {
        $ceps = Cep::all();
        $currencies = Currency::all();
        $defaultType = 'Cliente';
        $defaultStatus = 'Ativo';

        return view('auth.register', compact('ceps', 'currencies', 'defaultType', 'defaultStatus'));
    }

    public function store(Request $request)
    {
        $defaultType = 'Cliente';
        $defaultStatus = 'Ativo';

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'type' => ['nullable', 'in:Admin,Cliente,Outro'],
            'status' => ['nullable', 'in:Ativo,Inativo'],
        ]);


        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'type' => $validated['type'] ?? $defaultType,
            'status' => $validated['status'] ?? $defaultStatus,
        ]);

        return redirect()->route('login');
    }
}