@extends('layouts.main')

@section('title', 'Transações')

@section('floating-button-href', '/transactions/create')

@section('content')

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="fs-4 fs-md-3 fs-lg-2">Lista de Transações</h1>       
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="fs-6 fs-md-5 fs-lg-4">Data</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Transação</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Tipo</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Categoria</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Valor</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Conta</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Descrição</th>
                    <th class="fs-6 fs-md-5 fs-lg-4 text-center" colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <td class="fs-6 fs-md-5 fs-lg-4">{{ $transaction->transaction_date->format('d/m/Y') }}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4">{{ $transaction->name }}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4">{{ $transaction->type }}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4">{{ $transaction->category_name}}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4">R$ {{ number_format($transaction->value, 2, ',', '.') }}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4">{{ $transaction->account_name}}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4">{{ $transaction->description}}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4">
                        <a class="btn btn-primary" href="/transactions/edit/{{$transaction->id}}">
                            <i class="bi bi-pencil-square"></i>
                        </a> 
                    </td>
                    <td class="fs-6 fs-md-5 fs-lg-4">
                        <form action="/transactions/{{$transaction->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta transação?')" type="submit">
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