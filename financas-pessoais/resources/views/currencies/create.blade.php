@extends('layouts.main') 

@section('title', 'Cadastrar Moeda') 

@section('content') 

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">

        <a href='/currencies' type="button" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left-square"></i>
        </a>

        <h1 class="fs-4 fs-md-3 fs-lg-2">Nova Moeda</h1>
        
    </div>

    <form action='/currencies' method='post'>

        @csrf

        <div class="form-group mb-3">
            <label for="code" class="form-label fs-6 fs-md-5 fs-lg-4">Código da Moeda:</label>
            <input type="text" class="form-control" name="code" id="code" placeholder="Informe o código da moeda" required>
        </div>

        <div class="form-group mb-3">
            <label for="name" class="form-label fs-6 fs-md-5 fs-lg-4">Nome da Moeda:</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Informe o nome da moeda" required>
        </div>

        <div class="form-group mb-3">
            <label for="symbol" class="form-label fs-6 fs-md-5 fs-lg-4">Símbolo da Moeda:</label>
            <input type="text" class="form-control" name="symbol" id="symbol" placeholder="Informe o símbolo da moeda" required>
        </div>

        <div class="form-group d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-plus-circle-fill"></i>
                <span>Cadastrar</span>
            </button>
            <button type="reset" class="btn btn-outline-danger">
                <i class="bi bi-backspace-reverse"></i>                
                <span>Limpar</span>
            </button>
        </div>
    </form>
</div>
@endsection