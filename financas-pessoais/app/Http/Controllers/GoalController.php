<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Account;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    public function index() {
        $goals = Goal::with('currency', 'financial_accounts')
            ->where('goals.created_by', Auth::id())
            ->get();
        
        return view('goals.index', compact('goals'));
    }

    public function create() {
        $financial_accounts = Account::where('created_by', Auth::id())->get();
        return view('goals.create', compact('financial_accounts'));
    }

    public function store(Request $request) {
        $financial_accounts = Account::findOrFail($request->account_id);
        
        $goal = new Goal();
        $goal->created_by = Auth::id();
        $goal->name = $request->name;
        $goal->description = $request->description;
        $goal->target_value = $request->target_value;
        $goal->current_value = $request->;
        $goal->deadline = $request->deadline;
        $goal->account_id = $request->account_id;
        $goal->currency_id = $financial_accounts->currency_id;      

        $goal->save();

        return redirect( '/goals' )->with( 'msg', 'Objetivo criado com sucesso');
    }

    public function destroy( $id ) {
        $goal = Goal::findOrFail($id);
        if (Auth::id() !== $goal->created_by) {
            return redirect('/goals')->withErrors('Você não tem permissão para excluir este objetivo.');
        } else {
            $goal->delete();
            return redirect('/goals')->with('msg', 'Objetivo excluído com sucesso');
        }
    }

    public function edit( $id ) {
        $goals = Goal::findOrFail($id);
        if (Auth::id() !== $goals->created_by) {
            return redirect('/goals')->withErrors('Você não tem permissão para editar este objetivo.');
        } else {
            $financial_accounts = Account::where('created_by', Auth::id())->get();
            return view('goals.edit', ['goal' => $goals, 'financial_accounts' => $financial_accounts]);
        }
    }

    public function update( Request $request ) {
        $goal = Goal::findOrFail($request->id);
    
        $goal->name = $request->name;
        $goal->description = $request->description;
        $goal->target_value = $request->target_value;
        $goal->current_value = $request->current_value;
        $goal->deadline = $request->deadline;
        $goal->account_id = $request->account_id;

        $goal->save();
    
        return redirect('/goals')->with('msg', 'Objetivo atualizado com sucesso');
    }
}
