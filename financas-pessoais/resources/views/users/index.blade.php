@extends('layouts.main') 

@section('title', 'Usuários') 

@section('floating-button-href', '/users/create')

@section('content') 

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="fs-4 fs-md-3 fs-lg-2">Lista de Usuários</h1>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="fs-6 fs-md-5 fs-lg-4">Nome</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Email</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Tipo</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Endereço</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Cidade</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Estado</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">CEP</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Moeda Preferida</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Status</th>
                    <th class="fs-6 fs-md-5 fs-lg-4 text-center" style="width: 100px;" colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="fs-6 fs-md-5 fs-lg-4">{{$user->name}}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4">{{$user->email}}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4">{{$user->type}}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4">
                        {{$user->cep->street ?? 'Não informado'}}, {{$user->address_number ?? 'S/N'}}
                    </td>
                    <td class="fs-6 fs-md-5 fs-lg-4">{{$user->cep->city ?? 'Não informado'}}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4">{{$user->cep->state ?? 'Não informado'}}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4">{{$user->cep->cep ?? 'Não informado'}}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4">{{$user->preferredCurrency->name  ?? 'Não informada'}}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4">{{$user->status}}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4 text-center" style="width: 50px;">
                        <a class="btn btn-primary" href="/users/edit/{{$user->id}}">
                            <i class="bi bi-pencil-square"></i>
                        </a> 
                    </td>
                    <td class="fs-6 fs-md-5 fs-lg-4 text-center" style="width: 50px;">
                        <form action="/users/{{$user->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir o usuário?')" type="submit">
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