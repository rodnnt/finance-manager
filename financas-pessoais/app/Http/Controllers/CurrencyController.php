<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use Illuminate\Support\Facades\Auth;

class CurrencyController extends Controller
{
    public function index() {
        $currencies = Currency::all(); 
        return view('currencies.index', compact('currencies'));
    }

    public function create() {
        if (Auth::user()->type !== 'Admin') {
            return redirect('/currencies')->withErrors('Somente administradores têm permissão para cadastrar moedas.');
        }
        return view('currencies.create');
    }

    public function store(Request $request) {
        $request->validate([
            'code' => ['required', 'unique:currencies', 'regex:/^[A-Z]{3,5}$/'],
            'name' => 'required|string',
            'symbol' => 'required|string',
        ]);

        $currency = new Currency();
        $currency->code = $request->code;
        $currency->name = $request->name;
        $currency->symbol = $request->symbol;
        $currency->save();

        return redirect('/currencies')->with('msg', 'Moeda criada com sucesso');
    }

    public function destroy($id) {
        $currency = Currency::findOrFail($id);
        if (Auth::user()->type !== 'Admin') {
            return redirect('/currencies')->withErrors('Você não tem permissão para excluir esta moeda.');
        }
        
        $currency->delete();
        
        return redirect('/currencies')->with('msg', 'Moeda excluída com sucesso');
    }

    public function edit($id) {
        $currency = Currency::findOrFail($id);
        if (Auth::user()->type !== 'Admin') {
            return redirect('/currencies')->withErrors('Somente administradores têm permissão para editar moedas.');
        }
        return view('currencies.edit', ['currency' => $currency]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'code' => ['required', 'regex:/^[A-Z]{3,5}$/'],
            'name' => 'required|string',
            'symbol' => 'required|string',
        ]);

        $currency = Currency::findOrFail($id);
        $currency->update([
            'code' => $request->code,
            'name' => $request->name,
            'symbol' => $request->symbol,
        ]);

        return redirect('/currencies')->with('msg', 'Moeda atualizada com sucesso!');
    }
}