<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coin;
use Illuminate\Support\Facades\Auth;

class CoinController extends Controller
{
    public function index() {
        $coins = Coin::all(); 
        return view('coins.index', compact('coins'));
    }

    public function create() {
        if (Auth::user()->type !== 'Admin') {
            return redirect('/coins')->withErrors('Somente administradores têm permissão para cadastrar moedas.');
        }
        return view('coins.create');
    }

    public function store(Request $request) {
        $request->validate([
            'code' => ['required', 'unique:coins', 'regex:/^[A-Z]{3,5}$/'],
            'name' => 'required|string',
            'symbol' => 'required|string',
        ]);

        $coin = new Coin();
        $coin->code = $request->code;
        $coin->name = $request->name;
        $coin->symbol = $request->symbol;
        $coin->save();

        return redirect('/coins')->with('msg', 'Moeda criada com sucesso');
    }

    public function destroy($id) {
        $coin = Coin::findOrFail( $id );
        if (Auth::id() !== $coin->created_by) {
            return redirect('/coins')->withErrors('Você não tem permissão para excluir esta moeda.');
        }
        
        $coin->delete();
        
        return redirect('/coins')->with('msg', 'Moeda excluída com sucesso');
    }

    public function edit($id) {
        $coin = Coin::findOrFail($id);
        if (Auth::user()->type !== 'Admin') {
            return redirect('/coins')->withErrors('Somente administradores têm permissão para editar moedas.');
        }
        return view('coins.edit', ['coin' => $coin]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'code' => ['required', 'regex:/^[A-Z]{3,5}$/'],
            'name' => 'required|string',
            'symbol' => 'required|string',
        ]);

        $coin = Coin::findOrFail($id);
        $coin->update([
            'code' => $request->code,
            'name' => $request->name,
            'symbol' => $request->symbol,
        ]);

        return redirect('/coins')->with('msg', 'Moeda atualizada com sucesso!');
    }
}