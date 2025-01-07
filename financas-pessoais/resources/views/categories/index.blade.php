@extends('layouts.main') 

@section('title', 'Categorias') 

@section('floating-button-href', '/categories/create')

@section('content') 

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="fs-4 fs-md-3 fs-lg-2">Lista de Categorias</h1>

    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="fs-6 fs-md-5 fs-lg-4">Nome</th>
                    <th class="fs-6 fs-md-5 fs-lg-4">Descrição</th>
                    <th class="fs-6 fs-md-5 fs-lg-4 text-center" colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td class="fs-6 fs-md-5 fs-lg-4"> {{$category->name}}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4"> {{$category->description}}</td>
                    <td class="fs-6 fs-md-5 fs-lg-4">
                        <a class="btn btn-primary" href="/categories/edit/{{$category->id}}">
                            <i class="bi bi-pencil-square"></i>
                        </a> 
                    </td>

                    <td class="fs-6 fs-md-5 fs-lg-4">
                        <form action="/categories/{{$category->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir a categoria?')" type="submit">
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