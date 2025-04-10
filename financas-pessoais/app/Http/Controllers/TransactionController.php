<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Transaction;
use App\Models\Category;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index() {
        $transactions = Transaction::with('currency', 'financial_accounts', 'category')
            ->whereHas('financial_accounts', function ($query) {
                $query->where('created_by', Auth::id());
            })
            ->get();
    
        return view('transactions.index', compact('transactions'));
    }

    public function create() {
        $categories = Category::where(function($query) {
            $query->where('type', 'Padrão')
                  ->orWhere(function($query) {
                      $query->where('type', 'Individual')
                            ->where('created_by', Auth::id());
                  });
        })->get();
        $financial_accounts = Account::where('created_by', Auth::id())->get();
        return view('transactions.create', compact('categories', 'financial_accounts'));       
    }

    public function store(Request $request) {
        $financial_accounts = Account::findOrFail($request->account_id);
        
        $transaction = new Transaction();
        $transaction->transaction_date = $request->transaction_date;
        $transaction->name = $request->name;
        $transaction->type = $request->type;
        $transaction->category_id = $request->category_id;
        $transaction->value = $request->value;
        $transaction->account_id = $request->account_id;
        $transaction->description = $request->description;
        $transaction->currency_id = $financial_accounts->currency_id;

        $transaction->save();

        return redirect( '/transactions' )->with( 'msg', 'Transação criada com sucesso');
    }

    public function destroy( $id ) {
        $transaction = Transaction::findOrFail( $id );
        if (Auth::id() !== $transaction->financial_accounts->created_by) {
            return redirect('/transactions')->withErrors('Você não tem permissão para excluir esta transação.');
        } else {
            $transaction->delete();
            return redirect( '/transactions' )->with( 'msg', 'Transação excluida com sucesso');
        }
    }

    public function edit( $id ) {
        $categories = Category::where(function($query) {
            $query->where('type', 'Padrão');
            if (Auth::check()) {
                $query->orWhere('created_by', Auth::id());
            }
        })
        ->get();
        $financial_accounts = Account::where('created_by', Auth::id())->get();
        $transaction = Transaction::findOrFail( $id );
        if (Auth::id() !== $transaction->financial_accounts->created_by) {
            return redirect('/transactions')->withErrors('Você não tem permissão para editar esta transação.');
        } else {
            return view( '/transactions.edit', [ 'transaction' => $transaction, 'categories' => $categories, 'financial_accounts' => $financial_accounts ] );
        }
    }

    public function update( Request $request ) {
        $transaction = Transaction::findOrFail($request->id);

        $transaction->update([
            'transaction_date' => $request->transaction_date,
            'name' => $request->name,
            'type' => $request->type,
            'category_id' => $request->category_id,
            'value' => $request->value,
            'account_id' => $request->account_id,
            'description' => $request->description,
        ]);

        return redirect('/transactions')->with('msg', 'Transação atualizada com sucesso!');
    }
}