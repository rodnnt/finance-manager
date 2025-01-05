@extends('layouts.main') 

@section('title', 'Cadastrar Categoria') 

@section('content') 

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Cadastrar Categoria</h1>
        <a href='/categories' type="button" class="btn btn-secondary">
            <i class="bi bi-arrow-left-square"></i>
            <span>Voltar</span>
        </a>
    </div>

    <form action='/categories' method='post'>

        @csrf

        <div class="form-group mb-3">
            <label for="name">Nome da Categoria:</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Informe o nome da categoria" required>
        </div>

        <div class="form-group mb-3">
            <label for="description">Descrição da Categoria:</label>
            <input type="text" class="form-control" name="description" id="description" 
                placeholder="Informe a descrição da categoria" required>
        </div>

        <div class="form-group d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <button type="reset" class="btn btn-secondary">
                <i class="bi bi-backspace-reverse"></i>                
                <span>Limpar</span>
            </button>
        </div>

    </form>
</div>
@endsection