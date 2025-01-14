@extends('layouts.main') 

@section('title', 'Objetivos Financeiros') 

@auth
@section('floating-button-href', '/goals/create')
@endauth

@section('content') 

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="fs-4 fs-md-3 fs-lg-2">Lista de Objetivos</h1>

    </div>

    <div class="table-responsive">
        @if($goals->isEmpty())
        <p class="text-center text-muted">Nenhum objetivo cadastrado.</p>
        @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="fs-6 fs-md-5 fs-lg-4">Nome</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Descrição</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Valor Desejado</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Valor Atual</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Data Limite</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Conta</th>
                    <th class="fs-6 fs-md-5 fs-lg-4 text-center" style="width: 100px;" colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($goals as $goal)
                <tr>
                    <td class="fs-6 fs-md-5 fs-lg-4"> {{$goal->name}}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4"> {{$goal->description}}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4"> {{$goal->currency->symbol}} {{ number_format($goal->target_value, 2, ',', '.') }}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4"> {{$goal->current_value ?? 'Não informado'}}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4"> {{$goal->deadline}}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4"> {{$goal->financial_accounts->account_name}}</td>

                    <td class="fs-6 fs-md-5 fs-lg-4 text-center" style="width: 50px;">
                        <a class="btn btn-primary" href="/goals/edit/{{$goal->id}}">
                            <i class="bi bi-pencil-square"></i>
                        </a> 
                    </td>

                    <td class="fs-6 fs-md-5 fs-lg-4 text-center" style="width: 50px;">
                        <form action="/goals/{{$goal->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir o objetivo?')" type="submit">
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