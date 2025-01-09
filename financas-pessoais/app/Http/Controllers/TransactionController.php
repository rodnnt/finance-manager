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
        $transactions = Transaction::join('categories', 'transactions.category_id', '=', 'categories.id')
            ->join('financial_accounts', 'transactions.account_id', '=', 'financial_accounts.id')
            ->where('financial_accounts.created_by', Auth::id())
            ->select(
                'transactions.*',
                'categories.name as category_name',
                'financial_accounts.account_name as account_name'
            )
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
        $transaction = new Transaction();
        $transaction->transaction_date = $request->transaction_date;
        $transaction->name = $request->name;
        $transaction->type = $request->type;
        $transaction->category_id = $request->category_id;
        $transaction->value = $request->value;
        $transaction->account_id = $request->account_id;
        $transaction->description = $request->description;

        $transaction->save();

        return redirect( '/transactions' )->with( 'msg', 'Transação criada com sucesso');
    }

    public function destroy( $id ) {
        Transaction::findOrFail( $id )->delete();
        return redirect( '/transactions' )->with( 'msg', 'Transação excluida com sucesso');
    }

    public function edit( $id ) {
        $categories = Category::where(function($query) {
            $query->where('type', 'Padrão')
                  ->orWhere(function($query) {
                      $query->where('type', 'Individual')
                            ->where('created_by', Auth::id());
                  });
        })->get();
        $financial_accounts = Account::where('created_by', Auth::id())->get();
        $transaction = Transaction::findOrFail( $id );

        return view( '/transactions.edit', [ 'transaction' => $transaction, 'categories' => $categories, 'financial_accounts' => $financial_accounts ] );
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