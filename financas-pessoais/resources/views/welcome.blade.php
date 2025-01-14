@extends('layouts.main') 

@section('title', 'Página Inicial') 

@section('content') 

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        @auth
        <h1 class="fs-4 fs-md-3 fs-lg-2">Página Inicial Autenticado</h1>
        @endauth
        @guest
        <h1 class="fs-4 fs-md-3 fs-lg-2">Demonstração</h1>
        @endguest

        <div class="form-group mb-4">
            <form action="/" method="POST">
                @csrf
                <label for="currency_id" class="form-label fs-6 fs-md-5 fs-lg-4">Moeda:</label>
                <select class="form-select" name="currency_id" id="currency_id" onchange="this.form.submit()">
                    @foreach ($currencies as $currency)
                        <option value="{{ $currency->id }}" 
                            {{ $currency->id !== 10 ? '' : '' }} 
                            {{ $currency->id == $selectedCurrency->id ? 'selected' : '' }}>
                            {{ $currency->name }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
        <div class="col">
            <div class="card text-white bg-success h-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <h5 class="card-title fs-6 fs-md-5 fs-lg-4">Receitas</h5>
                            <p class="card-text fs-4 fs-md-3 fs-lg-2">
                                + {{ $selectedCurrency->symbol }} 
                                @auth
                                {{ number_format($receitas, 2, ',', '.') }}
                                @endauth
                                @guest
                                12.515,84
                                @endguest    
                            </p>
                        </div>
                        <div class="col-3 d-flex justify-content-center align-items-center">
                            <i class="bi bi-box-arrow-in-down fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card text-white bg-danger h-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <h5 class="card-title fs-6 fs-md-5 fs-lg-4">Despesas</h5>
                            <p class="card-text fs-4 fs-md-3 fs-lg-2">
                                - {{ $selectedCurrency->symbol }} 
                                @auth
                                {{ number_format($despesas, 2, ',', '.') }}
                                @endauth
                                @guest
                                3.251,44
                                @endguest
                            </p>
                        </div>
                        <div class="col-3 d-flex justify-content-center align-items-center">
                            <i class="bi bi-box-arrow-up fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card text-white bg-primary h-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <h5 class="card-title fs-6 fs-md-5 fs-lg-4">Saldo Atual</h5>
                            <p class="card-text fs-4 fs-md-3 fs-lg-2">
                                {{ $selectedCurrency->symbol }} 
                                @auth
                                {{ number_format($saldo , 2, ',', '.') }}
                                @endauth
                                @guest
                                9.264,51
                                @endguest</p>
                        </div>
                        <div class="col-3 d-flex justify-content-center align-items-center">
                            <i class="bi bi-wallet fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title fs-6 fs-md-5 fs-lg-4">Receitas x Despesas</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center fs-6 fs-md-5 fs-lg-4">
                            <div class="col-sm-2 d-flex flex-column">Receitas</div>
                            <div class="col-sm-8">
                                <div class="progress mt-1">
                                    <div class="progress-bar bg-success" style="width: 79.44%;">
                                        79,44%
                                    </div>
                                    <div class="progress-bar bg-danger" style="width: 20.56%;">
                                        20,56%
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2 d-flex flex-column align-items-end">Despesas</div>
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
                    <h5 class="card-title fs-6 fs-md-5 fs-lg-4">Gastos por Categoria</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center fs-6 fs-md-5 fs-lg-4">
                            <div class="col-sm-2">Alimentação</div>
                            <div class="col-sm-8">
                                <div class="progress mt-1">
                                    <div class="progress-bar bg-success" style="width: 100%"></div>
                                    <div class="progress-bar bg-danger" style="width: 20%"></div>
                                </div>
                                <div class="text-end">
                                    <span class="badge rounded-pill bg-danger">120%</span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="d-flex flex-column align-items-end">
                                    <span class="badge rounded-pill bg-danger">R$ 1.800,00</span>
                                    <small class="text-muted">Meta: R$ 1.500,00</small>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center fs-6 fs-md-5 fs-lg-4">
                            <div class="col-sm-2">Transporte</div>
                            <div class="col-sm-8">
                                <div class="progress mt-1">
                                    <div class="progress-bar bg-success" style="width: 80%"></div>
                                </div>
                                <div class="text-end">
                                    <span class="badge rounded-pill bg-success">80%</span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="d-flex flex-column align-items-end">
                                    <span class="badge rounded-pill bg-primary">R$ 800,00</span>
                                    <small class="text-muted">Meta: R$ 1.000,00</small>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center fs-6 fs-md-5 fs-lg-4">
                            <div class="col-sm-2">Lazer</div>
                            <div class="col-sm-8">
                                <div class="progress mt-1">
                                    <div class="progress-bar bg-success" style="width: 75%"></div>
                                </div>
                                <div class="text-end">
                                    <span class="badge rounded-pill bg-success">75%</span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="d-flex flex-column align-items-end">
                                    <span class="badge rounded-pill bg-primary">R$ 450,00</span>
                                    <small class="text-muted">Meta: R$ 600,00</small>
                                </div>
                            </div>
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
                    <h5 class="card-title fs-6 fs-md-5 fs-lg-4">Objetivos</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item fs-6 fs-md-5 fs-lg-4">
                            <div class="col-sm-12 d-flex align-items-center">
                                <div class="col-sm-2">
                                    Viagem dos Sonhos
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12 text-end">
                                        <span class="badge rounded-pill bg-success">R$ 10.000,00 / R$ 10.000,00</span>
                                        <span class="badge rounded-pill bg-success">30/12/2024</span>
                                    </div>
                                
                                    <div class="progress col-sm-12 mt-2">
                                    <div class="progress-bar bg-success" style="width: 100%">
                                        100%    
                                    </div>
                                    </div>
                                    <div class="col-sm-12 text-end">
                                        <span>Atingido</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        
                        <li class="list-group-item fs-6 fs-md-5 fs-lg-4">
                            <div class="col-sm-12 d-flex align-items-center">
                                <div class="col-sm-2">
                                Novo Carro
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12 text-end">
                                        <span class="badge rounded-pill bg-secondary">R$ 40.000,00 / R$ 50.000,00</span>
                                        <span class="badge rounded-pill bg-primary">15/06/2026</span>
                                    </div>
                                
                                    <div class="progress col-sm-12 mt-2">
                                    <div class="progress-bar bg-success" style="width: 80%">
                                        80%                               
                                    </div>
                                    </div>
                                    <div class="col-sm-12 text-end">
                                        <span>Valor mensal a ser guardado: R$ 1.470,59</span>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item fs-6 fs-md-5 fs-lg-4">
                            <div class="col-sm-12 d-flex align-items-center">
                                <div class="col-sm-2">
                                    Reforma da Casa
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12 text-end">
                                        <span class="badge rounded-pill bg-warning text-dark">R$ 7.500,00 / R$ 20.000,00</span>
                                        <span class="badge rounded-pill bg-danger">01/03/2025</span>
                                    </div>
                                
                                    <div class="progress col-sm-12 mt-2">
                                        <div class="progress-bar bg-success" style="width: 37.5%">
                                            37,5%
                                        </div>
                                    </div>
                                    <div class="col-sm-12 text-end">
                                        <span>Valor mensal a ser guardado: R$ 1.090,91</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection