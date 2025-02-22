@extends('layouts.main') 

@section('title', 'Cadastrar Categoria') 

@section('content') 

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">

        <a href='/categories' type="button" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left-square"></i>
        </a>

        <h1 class="fs-4 fs-md-3 fs-lg-2">Nova Categoria</h1>
        
    </div>

    <form action='/categories' method='post'>

        @csrf

        <input type="hidden" name="created_by" value="{{ Auth::id() }}">

        <div class="form-group mb-3">
            <label for="name" class="form-label fs-6 fs-md-5 fs-lg-4">Nome da Categoria:</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Informe o nome da categoria" required>
        </div>

        <div class="form-group mb-3">
            <label for="description" class="form-label fs-6 fs-md-5 fs-lg-4">Descrição da Categoria:</label>
            <textarea class="form-control" name="description" id="description"
                placeholder="Informe a descrição da categoria" rows="4" required></textarea>
        </div>

        @if (Auth::user()->type === 'Admin')
        <div class="mb-3">
            <label for="type" class="form-label fs-6 fs-md-5 fs-lg-4">Tipo:</label>
            <select class="form-select" id="type" name="type" required>
                <option value="Padrão" selected>Padrão</option>
                <option value="Individual">Individual</option>
            </select>
        </div>
        @endif

        <div class="mb-3">
            <label for="budget" class="form-label fs-6 fs-md-5 fs-lg-4">Orçamento:</label>
            <input type="number" step="0.01" class="form-control" name="budget" id="budget"
                placeholder="Informe o orçamento planejado para esta categoria" required>
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