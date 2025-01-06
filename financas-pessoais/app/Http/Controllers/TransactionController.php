<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Transaction;
use App\Models\Category;
use App\Models\Account;

class TransactionController extends Controller
{
    public function index() {
        $transactions = Transaction::join('categories', 'transactions.category_id', '=', 'categories.id')
            ->join('bank_accounts', 'transactions.account_id', '=', 'bank_accounts.id')
            ->select(
                'transactions.*',
                'categories.name as category_name',
                'bank_accounts.account_name as account_name'
            )
            ->get();
    
        return view('transactions.index', compact('transactions'));
    }    

    public function create() {
        $categories = Category::all();
        $bankAccounts = Account::all();
        return view('transactions.create', compact('categories', 'bankAccounts'));       
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
        $categories = Category::all();
        $bankAccounts = Account::all();
        $transaction = Transaction::findOrFail( $id );

        return view( '/transactions.edit', [ 'transaction' => $transaction, 'categories' => $categories, 'bankAccounts' => $bankAccounts ] );
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