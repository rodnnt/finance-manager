@extends('layouts.main') 

@section('title', 'Categorias') 

@section('content') 

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Lista de Categorias</h1>
        <a href="/categories/create" type="button" class="btn btn-primary">
            <i class="bi bi-plus-square"></i>
            <span>Nova Categoria</span>
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th colspan="2" class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td> {{$category->id}}</td>
                    <td> {{$category->name}}</td>
                    <td> {{$category->description}}</td>
                    <td class="text-right">
                        <a class="btn btn-primary" href="/categories/edit/{{$category->id}}">
                            <i class="bi bi-pencil-square"></i>
                        </a> 
                    </td>

                    <td class="text-left">
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