<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    public function index() {
        $goals = Goal::join('financial_accounts', 'goals.account_id', '=', 'financial_accounts.id')
            ->where('goals.created_by', Auth::id())
            ->select(
                'goals.*',
                'financial_accounts.account_name'
            )
        ->get();
        
        return view('goals.index', compact('goals'));
    }

    public function create() {
        $financial_accounts = Account::where('created_by', Auth::id())->get();
        return view('goals.create', compact('financial_accounts'));
    }

    public function store(Request $request) {
        $goal = new Goal();
        $goal->created_by = Auth::id();
        $goal->name = $request->name;
        $goal->description = $request->description;
        $goal->target_value = $request->target_value;
        $goal->deadline = $request->deadline;
        $goal->account_id = $request->account_id;       

        $goal->save();

        return redirect( '/goals' )->with( 'msg', 'Objetivo criado com sucesso');
    }

    public function destroy( $id ) {
        Goal::findOrFail($id)->delete();
        return redirect('/goals')->with('msg', 'Objetivo excluído com sucesso');
    }

    public function edit( $id ) {
        $goals = Goal::findOrFail($id);
        $financial_accounts = Account::where('created_by', Auth::id())->get();
        return view('goals.edit', ['goal' => $goals, 'financial_accounts' => $financial_accounts]);
    }

    public function update( Request $request ) {
        $goal = Goal::findOrFail($request->id);
    
        $goal->name = $request->name;
        $goal->description = $request->description;
        $goal->target_value = $request->target_value;
        $goal->deadline = $request->deadline;
        $goal->account_id = $request->account_id;

        $goal->save();
    
        return redirect('/goals')->with('msg', 'Objetivo atualizado com sucesso');
    }
}
