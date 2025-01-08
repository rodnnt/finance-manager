<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cep;

class CepController extends Controller
{
    public function index() {
        $ceps = Cep::all();
        return view('ceps.index', compact('ceps'));
    }

    public function create() {
        return view('ceps.create');
    }

    public function store(Request $request) {
        $request->validate([
            'cep' => ['required', 'unique:ceps', 'regex:/^\d{5}-\d{3}$/'],
            'street' => 'required|string',
            'neighborhood' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string|size:2',
        ]);

        $cep = new Cep();
        $cep->cep = $request->cep;
        $cep->street = $request->street;
        $cep->neighborhood = $request->neighborhood;
        $cep->city = $request->city;
        $cep->state = $request->state;
        $cep->save();

        return redirect('/ceps')->with('msg', 'CEP criado com sucesso');
    }

    public function destroy($id) {
        Cep::findOrFail($id)->delete();
        return redirect('/ceps')->with('msg', 'CEP excluído com sucesso');
    }

    public function edit($id) {
        $cep = Cep::findOrFail($id);
        return view('ceps.edit', ['cep' => $cep]);
    }

    public function update(Request $request) {
        $request->validate([
            'cep' => ['required', 'regex:/^\d{5}-\d{3}$/'],
            'street' => 'required|string',
            'neighborhood' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string|size:2',
        ]);

        $cep = Cep::findOrFail($request->id);
        $cep->update([
            'cep' => $request->cep,
            'street' => $request->street,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city,
            'state' => $request->state,
        ]);

        return redirect('/ceps')->with('msg', 'CEP atualizado com sucesso!');
    }
}
