@extends('layouts.main') 

@section('title', 'Editar Categoria') 

@section('content') 

<h1>Editar Categorias</h1>

    <form action='/categories/update/{{$category->id}}' method='post'>

        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Nome Categoria:</label>
            <input type="text" class="form-control" name="name" id="name" value='{{$category->name}}'
                placeholder="Informe o nome da categoria" required>
        </div>

        <div class="form-group">
            <label for="description">Descrição Categoria:</label>
            <input type="text" class="form-control" name="description" id="description" value='{{$category->description}}'
                placeholder="Informe a descrição da categoria" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href='/categories' class="btn btn-secondary">Cancelar</a>
        </div>

    </form>

@endsection