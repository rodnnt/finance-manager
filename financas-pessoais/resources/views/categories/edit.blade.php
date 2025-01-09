@extends('layouts.main') 

@section('title', 'Editar Categoria') 

@section('content') 

<div class="container my-4">
    <h1 class="fs-4 fs-md-3 fs-lg-2">Editar Categoria</h1>

    <form action='/categories/update/{{$category->id}}' method='post'>

        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="name" class="form-label fs-6 fs-md-5 fs-lg-4">Nome da Categoria:</label>
            <input type="text" class="form-control" name="name" id="name" value='{{$category->name}}' 
                placeholder="Informe o nome da categoria" required>
        </div>

        <div class="form-group mb-3">
            <label for="description" class="form-label fs-6 fs-md-5 fs-lg-4">Descrição da Categoria:</label>
            <input type="text" class="form-control" name="description" id="description" value='{{$category->description}}' 
                placeholder="Informe a descrição da categoria" required>
        </div>
        
        @if (Auth::user()->type === 'Admin')
        <div class="mb-3">
            <label for="type" class="form-label fs-6 fs-md-5 fs-lg-4">Tipo:</label>
            <select class="form-select" id="type" name="type" required>
                <option value="Padrão" {{$category->type == 'Padrão' ? 'selected' : '' }}>Padrão</option>
                <option value="Individual"{{$category->type == 'Individual' ? 'selected' : '' }}>Individual</option>
            </select>
        </div>
        @endif

        <div class="form-group mb-3">
            <label for="created_at" class="form-label fs-6 fs-md-5 fs-lg-4">Data de Criação:</label>
            <input type="text" class="form-control" name="created_at" id="created_at" value='{{$category->created_at}}' disabled>
        </div>

        <div class="form-group mb-3">
            <label for="updated_at" class="form-label fs-6 fs-md-5 fs-lg-4">Última Atualização:</label>
            <input type="text" class="form-control" name="updated_at" id="updated_at" value='{{$category->updated_at}}' disabled>
        </div>

        <div class="form-group d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle-fill"></i>
                <span>Salvar</span>
            </button>
            <a href='/categories' class="btn btn-outline-danger">Cancelar</a>
        </div>

    </form>
</div>
@endsection