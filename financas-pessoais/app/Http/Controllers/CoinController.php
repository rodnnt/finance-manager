<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coin;

class CoinController extends Controller
{
    public function index() {
        $coins = Coin::all(); 
        return view('coins.index', compact('coins'));
    }

    public function create() {
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
        Coin::findOrFail($id)->delete();
        return redirect('/coins')->with('msg', 'Moeda excluída com sucesso');
    }

    public function edit($id) {
        $coin = Coin::findOrFail($id);
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
