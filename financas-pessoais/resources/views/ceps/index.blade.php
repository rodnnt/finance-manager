@extends('layouts.main') 

@section('title', 'CEPs') 

@section('floating-button-href', '/ceps/create')

@section('content') 

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="fs-4 fs-md-3 fs-lg-2">Lista de CEPs</h1>

    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="fs-6 fs-md-5 fs-lg-4">CEP</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Rua</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Bairro</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Cidade</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Estado</th>
                    <th class="fs-6 fs-md-5 fs-lg-4 text-center" style="width: 100px;" colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ceps as $cep)
                <tr>
                    <td class="fs-6 fs-md-5 fs-lg-4"> {{$cep->cep}}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4"> {{$cep->street}}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4"> {{$cep->neighborhood}}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4"> {{$cep->city}}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4"> {{$cep->state}}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4 text-center" style="width: 50px;">
                        <a class="btn btn-primary" href="/ceps/edit/{{$cep->id}}">
                            <i class="bi bi-pencil-square"></i>
                        </a> 
                    </td>

                    <td class="fs-6 fs-md-5 fs-lg-4 text-center" style="width: 50px;">
                        <form action="/ceps/{{$cep->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir o CEP?')" type="submit">
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