<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    public function index() {
        $financial_accounts = Account::where(function($query) {
            $query->whereNull('created_by')
                  ->orWhere('created_by', Auth::id());
        })
        ->get();
        
        return view('accounts.index', compact('financial_accounts'));
    }

    public function create() {
        return view('accounts.create');
    }

    public function store(Request $request) {
        $request->validate([
            'account_number' => [
                'required',
                Rule::unique('accounts')->where(function ($query) use ($request) {
                    return $query->where('account_digit', $request->account_digit)
                                 ->where('agency_code', $request->agency_code)
                                 ->where('agency_digit', $request->agency_digit)
                                 ->where('bank_code', $request->bank_code);
                })
            ],
            'account_name' => 'required',
            'bank_code' => 'required',
            'agency_code' => 'required',
            'agency_digit' => 'required',
            'account_number' => 'required',
            'account_digit' => 'required',
            'account_type' => 'required',
            'initial_balance' => 'required|numeric',
        ]);
        try {
            $financial_accounts = new Account();
            $financial_accounts->account_name = $request->account_name;
            $financial_accounts->bank_code = $request->bank_code;
            $financial_accounts->agency_code = $request->agency_code;
            $financial_accounts->agency_digit = $request->agency_digit;
            $financial_accounts->account_number = $request->account_number;
            $financial_accounts->account_digit = $request->account_digit;
            $financial_accounts->account_type = $request->account_type;
            $financial_accounts->created_by = Auth::id();
            $financial_accounts->initial_balance = $request->initial_balance;
            $financial_accounts->credit_limit = $request->account_type == 'Cartão de Crédito' ? $request->credit_limit : null;

            $financial_accounts->save();

            return redirect('/accounts')->with('msg', 'Conta criada com sucesso');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                return back()->withErrors(['error' => 'Já existe uma conta com esses dados. Verifique os números da conta, agência e banco.']);
            }
        }
    }

    public function destroy( $id ) {
        Account::findOrFail($id)->delete();
        return redirect('/accounts')->with('msg', 'Conta excluída com sucesso');
    }

    public function edit( $id ) {
        $financial_accounts = Account::findOrFail($id);
        return view('accounts.edit', ['account' => $financial_accounts]);
    }

    public function update( Request $request ) {
        $financial_accounts = Account::findOrFail($request->id);

        $request->validate([
            'account_number' => [
                'required',
                Rule::unique('accounts')->ignore($financial_accounts->id)->where(function ($query) use ($request) {
                    return $query->where('account_digit', $request->account_digit)
                                 ->where('agency_code', $request->agency_code)
                                 ->where('agency_digit', $request->agency_digit)
                                 ->where('bank_code', $request->bank_code);
                })
            ],
            'account_name' => 'required',
            'bank_code' => 'required',
            'agency_code' => 'required',
            'agency_digit' => 'required',
            'account_number' => 'required',
            'account_digit' => 'required',
            'account_type' => 'required',
            'initial_balance' => 'required|numeric',
        ]);
    
        try {
            $financial_accounts->update([
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
    
            return redirect('/accounts')->with('msg', 'Conta atualizada com sucesso!');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                return back()->withErrors(['error' => 'Já existe uma conta com esses dados. Verifique os números da conta, agência e banco.']);
            }
        }
    }
}