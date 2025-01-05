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
            <label for="created_at">Data de Criação:</label>
            <input type="text" class="form-control" name="created_at" id="created_at" value='{{$category->created_at}}' disabled>
        </div>

        <div class="form-group">
            <label for="updated_at">Última Atualização:</label>
            <input type="text" class="form-control" name="updated_at" id="updated_at" value='{{$category->updated_at}}' disabled>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href='/categories' class="btn btn-secondary">Cancelar</a>
        </div>

    </form>

@endsection