@extends('layouts.main') 

@section('title', 'Contas Bancárias') 

@section('content') 

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Lista de Contas Bancárias</h1>
        <a href="/bank-accounts/create" type="button" class="btn btn-primary">
            <i class="bi bi-plus-square"></i>
            <span>Nova Conta Bancária</span>
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome da Conta</th>
                    <th>Banco</th>
                    <th>Agência</th>
                    <th>Conta</th>
                    <th>Tipo</th>
                    <th>Saldo Inicial</th>
                    <th colspan="2" class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bankAccounts as $account)
                <tr>
                    <td>{{ $account->account_name }}</td>
                    <td>{{ $account->bank_code }}</td>
                    <td>{{ $account->agency_code }}-{{ $account->agency_digit }}</td>
                    <td>{{ $account->account_number }}-{{ $account->account_digit }}</td>
                    <td>{{ $account->account_type}}</td>
                    <td>R$ {{ number_format($account->initial_balance, 2, ',', '.') }}</td>
                    <td class="text-right">
                        <a class="btn btn-primary" href="/bank-accounts/edit/{{$account->id}}">
                            <i class="bi bi-pencil-square"></i>
                        </a> 
                    </td>
                    <td class="text-left">
                        <form action="/bank-accounts/{{$account->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta conta bancária? Essa ações excluirá todas as transações desta conta')" type="submit">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection