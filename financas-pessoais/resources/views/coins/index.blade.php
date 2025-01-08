@extends('layouts.main')  

@section('title', 'Moedas') 

@section('floating-button-href', '/coins/create')

@section('content') 

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="fs-4 fs-md-3 fs-lg-2">Lista de Moedas</h1>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="fs-6 fs-md-5 fs-lg-4">Código</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Nome</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Símbolo</th>
                    <th class="fs-6 fs-md-5 fs-lg-4 text-center" style="width: 100px;" colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($coins as $coin)
                <tr>
                    <td class="fs-6 fs-md-5 fs-lg-4">{{$coin->code}}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4">{{$coin->name}}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4">{{$coin->symbol}}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4 text-center" style="width: 50px;">
                        <a class="btn btn-primary" href="/coins/edit/{{$coin->id}}">
                            <i class="bi bi-pencil-square"></i>
                        </a> 
                    </td>

                    <td class="fs-6 fs-md-5 fs-lg-4 text-center" style="width: 50px;">
                        <form action="/coins/{{$coin->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir a moeda?')" type="submit">
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