@extends('layouts.main') 

@section('title', 'Contas') 

@auth
@section('floating-button-href', '/accounts/create')
@endif

@section('content') 

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="fs-4 fs-md-3 fs-lg-2">Lista de Contas</h1>
    </div>

    <div class="table-responsive">
        @if($financial_accounts->isEmpty())
        <p class="text-center text-muted">Nenhuma conta cadastrada.</p>
        @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="fs-6 fs-md-5 fs-lg-4">Nome da Conta</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Banco</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Agência</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Conta</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Tipo</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Saldo Inicial</th>
                    <th class="fs-6 fs-md-5 fs-lg-4 text-center" style="width: 100px;" colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($financial_accounts as $account)
                <tr>
                    <td class="fs-6 fs-md-5 fs-lg-4">{{ $account->account_name }}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4">{{ $account->bank_code }}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4">{{ $account->agency_code }}-{{ $account->agency_digit }}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4">{{ $account->account_number }}-{{ $account->account_digit }}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4">{{ $account->account_type}}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4">{{ $account->preferred_currency_id }} {{ number_format($account->initial_balance, 2, ',', '.') }}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4" style="width: 50px;">
                        <a class="btn btn-primary" href="/accounts/edit/{{$account->id}}">
                            <i class="bi bi-pencil-square"></i>
                        </a> 
                    </td>
                    <td class="fs-6 fs-md-5 fs-lg-4" style="width: 50px;">
                        <form action="/accounts/{{$account->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta conta? Essa ações excluirá todas as transações desta conta')" type="submit">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection