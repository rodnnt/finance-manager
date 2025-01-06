@extends('layouts.main')

@section('title', 'Transações')

@section('content')

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Lista de Transações</h1>
        <a href="/transactions/create" type="button" class="btn btn-primary">
            <i class="bi bi-plus-square"></i>
            <span>Nova Transação</span>
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Transação</th>
                    <th>Tipo</th>
                    <th>Categoria</th>
                    <th>Valor</th>
                    <th>Conta</th>
                    <th>Descrição</th>
                    <th colspan="2" class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->transaction_date }}</td>
                    <td>{{ $transaction->name }}</td>
                    <td>{{ $transaction->type }}</td>
                    <td>{{ $transaction->category_id}}</td>
                    <td>R$ {{ number_format($transaction->value, 2, ',', '.') }}</td>
                    <td>{{ $transaction->account_id}}</td>
                    <td>{{ $transaction->description}}</td>
                    <td class="text-right">
                        <a class="btn btn-primary" href="/transactions/edit/{{$transaction->id}}">
                            <i class="bi bi-pencil-square"></i>
                        </a> 
                    </td>
                    <td class="text-left">
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