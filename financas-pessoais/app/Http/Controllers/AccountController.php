<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Account;

class AccountController extends Controller
{
    public function index() {
        $bankAccounts = Account::all();
        return view('bank-accounts.index', compact('bankAccounts'));
    }

    public function create() {
        return view('bank-accounts.create');
    }

    public function store(Request $request) {
        $bankAccount = new Account();
        $bankAccount->account_name = $request->account_name;
        $bankAccount->bank_code = $request->bank_code;
        $bankAccount->agency_code = $request->agency_code;
        $bankAccount->agency_digit = $request->agency_digit;
        $bankAccount->account_number = $request->account_number;
        $bankAccount->account_digit = $request->account_digit;
        $bankAccount->account_type = $request->account_type;
        $bankAccount->initial_balance = $request->initial_balance;
        $bankAccount->credit_limit = $request->account_type == 'Cartão de Crédito' ? $request->credit_limit : null;

        $bankAccount->save();

        return redirect('/bank-accounts')->with('msg', 'Conta bancária criada com sucesso');
    }

    public function destroy( $id ) {
        Account::findOrFail($id)->delete();
        return redirect('/bank-accounts')->with('msg', 'Conta bancária excluída com sucesso');
    }

    public function edit( $id ) {
        $bankAccount = Account::findOrFail($id);
        return view('bank-accounts.edit', ['bankAccount' => $bankAccount]);
    }

    public function update( Request $request ) {
        $bankAccount = Account::findOrFail($request->id);

        $bankAccount->update([
            'account_name' => $request->account_name,
            'bank_code' => $request->bank_code,
            'agency_code' => $request->agency_code,
            'agency_digit' => $request->agency_digit,
            'account_number' => $request->account_number,
            'account_digit' => $request->account_digit,
            'account_type' => $request->account_type,
            'initial_balance' => $request->initial_balance,
            'credit_limit' => $request->account_type == 'Cartão de Crédito' ? $request->credit_limit : null,
        ]);

        return redirect('/bank-accounts')->with('msg', 'Conta bancária atualizada com sucesso!');
    }
}