@extends('layouts.main') 

@section('title', 'Cadastrar Categoria') 

@section('content') 

<h1>Cadastrar Categorias</h1>

    <form action='/categories' method='post'>

        @csrf
        
        <div class="form-group">
            <label for="name">Nome Categoria:</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Informe o nome da categoria" required>
        </div>

        <div class="form-group">
            <label for="description">Descrição Categoria:</label>
            <input type="text" class="form-control" name="description" id="description"
                placeholder="Informe a descrição da categoria" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <button type="reset" class="btn btn-secondary">Limpar</button>
        </div>

    </form>

@endsection