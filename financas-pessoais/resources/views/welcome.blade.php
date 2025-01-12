@extends('layouts.main') 

@section('title', 'Página Inicial') 

@section('content') 

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        @auth
        <h1 class="fs-4 fs-md-3 fs-lg-2">Página Inicial Autenticado</h1>
        @endauth
        @guest
        <h1 class="fs-4 fs-md-3 fs-lg-2">Página Inicial Não Autenticado</h1>
        @endguest
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
        <div class="col">
            <div class="card text-white bg-success h-100">
                <div class="card-body">
                    <h5 class="card-title">Receitas</h5>
                    <p class="card-text fs-4">+ R$ 12.515,84</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card text-white bg-danger h-100">
                <div class="card-body">
                    <h5 class="card-title">Despesas</h5>
                    <p class="card-text fs-4">- R$ 3.251,44</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card text-white bg-primary h-100">
                <div class="card-body">
                    <h5 class="card-title">Saldo</h5>
                    <p class="card-text fs-4">+ R$ 9.264,51</p>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Gastos por Categoria</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Alimentação
                            <span class="badge bg-primary rounded-pill">R$ 1.200,00</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Transporte
                            <span class="badge bg-primary rounded-pill">R$ 800,00</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Lazer
                            <span class="badge bg-primary rounded-pill">R$ 450,00</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="col">
        <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Objetivos</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Viagem dos Sonhos
                            <span class="badge bg-success rounded-pill">R$ 5.000,00 / R$ 10.000,00 - 30/12/2025</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Novo Carro
                            <span class="badge bg-success rounded-pill">R$ 15.000,00 / R$ 40.000,00 - 15/06/2026</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Reforma da Casa
                            <span class="badge bg-success rounded-pill">R$ 8.000,00 / R$ 20.000,00 - 01/11/2025</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection