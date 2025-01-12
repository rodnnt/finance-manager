@extends('layouts.main') 

@section('title', 'Categorias') 

@auth
@section('floating-button-href', '/categories/create')
@endauth

@section('content') 

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="fs-4 fs-md-3 fs-lg-2">Lista de Categorias</h1>

    </div>

    <div class="table-responsive">
        @if($categories->isEmpty())
        <p class="text-center text-muted">Nenhuma conta cadastrada.</p>
        @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="fs-6 fs-md-5 fs-lg-4">Nome</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Descrição</th>
                    @auth
                    <th class="fs-6 fs-md-5 fs-lg-4">Tipo</th>
                    <th class="fs-6 fs-md-5 fs-lg-4 text-center" style="width: 100px;" colspan="2">Ações</th>
                    @endauth
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td class="fs-6 fs-md-5 fs-lg-4"> {{$category->name}}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4"> {{$category->description}}</td>
                    @auth
                    <td class="fs-6 fs-md-5 fs-lg-4"> {{$category->type}}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4 text-center" style="width: 50px;">
                        <a class="btn btn-primary" href="/categories/edit/{{$category->id}}">
                            <i class="bi bi-pencil-square"></i>
                        </a> 
                    </td>
                    <td class="fs-6 fs-md-5 fs-lg-4 text-center" style="width: 50px;">
                        <form action="/categories/{{$category->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir a categoria?')" type="submit">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                    @endauth
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection