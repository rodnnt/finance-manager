@extends('layouts.main') 

@section('title', 'Página Inicial') 

@section('content') 

<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="fs-4 fs-md-3 fs-lg-2 mb-0">
            @auth
                Olá, {{ Auth::user()->name }}
            @endauth

            @guest
                Olá, Visitante
            @endguest
        </h1>

        <div class="form-group">
            <form action="/" method="POST">
                @csrf
                <label for="currency_id" class="form-label fs-6 fs-md-5 fs-lg-4 mb-0">Moeda:</label>
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

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="text-white bg-success h-100 p-3 border rounded">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h5 class="fs-6 fs-md-5 fs-lg-4 mb-0">Receitas</h5>
                            <p class="fs-4 fs-md-3 fs-lg-2 mb-0">
                                + {{ $selectedCurrency->symbol }} 
                                @auth
                                    {{ number_format($totalIncome, 2, ',', '.') }}
                                @endauth

                                @guest
                                    12.515,84
                                @endguest    
                            </p>
                        </div>
                        <div class="col-3 d-flex justify-content-center">
                            <i class="bi bi-box-arrow-in-down fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="text-white bg-danger h-100 p-3 border rounded">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h5 class="fs-6 fs-md-5 fs-lg-4 mb-0">Despesas</h5>
                            <p class="fs-4 fs-md-3 fs-lg-2 mb-0">
                                - {{ $selectedCurrency->symbol }} 
                                @auth
                                    {{ number_format($totalExpenses, 2, ',', '.') }}
                                @endauth

                                @guest
                                    3.251,44
                                @endguest
                            </p>
                        </div>
                        <div class="col-3 d-flex justify-content-center">
                            <i class="bi bi-box-arrow-up fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="text-white bg-primary h-100 p-3 border rounded">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h5 class="fs-6 fs-md-5 fs-lg-4 mb-0">Saldo Atual</h5>
                            <p class="fs-4 fs-md-3 fs-lg-2 mb-0">
                                {{ $selectedCurrency->symbol }} 
                                @auth
                                    {{ number_format($currentBalance , 2, ',', '.') }}
                                @endauth

                                @guest
                                    9.264,51
                                @endguest</p>
                        </div>
                        <div class="col-3 d-flex justify-content-center">
                            <i class="bi bi-wallet fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="d-flex justify-content-between align-items-center mb-3 bg-white p-3 border rounded">
        <div class="row w-100">
            <div class="col-12">
                <h5 class="fs-6 fs-md-5 fs-lg-4">Receitas x Despesas</h5>
            </div>
            <div class="col-12 d-flex align-items-center">
                <div class="col-3 col-sm-2 d-flex flex-column fs-6 fs-md-5 fs-lg-4">
                    Receitas
                </div>

                <div class="col-6 col-sm-8">
                    <div class="progress mt-1">
                        <div class="progress-bar bg-success"
                            @auth
                                @php
                                    $percentual = ($totalIncome + $totalExpenses) > 0 
                                        ? ($totalIncome * 100) / ($totalIncome + $totalExpenses) 
                                        : 0;
                                @endphp
                                style="width: {{ $percentual }}%;">
                                {{ number_format($percentual, 2, ',', '.') }}%
                            @endauth

                            @guest
                                style="width: 79.44%;">
                                79,44%
                            @endguest    
                        </div>
                        <div class="progress-bar bg-danger"
                            @auth
                                @php
                                    $percentual = ($totalIncome + $totalExpenses) > 0 
                                        ? ($totalExpenses * 100) / ($totalIncome + $totalExpenses) 
                                        : 0;
                                @endphp
                                style="width: {{ $percentual }}%;">
                                {{ number_format($percentual, 2, ',', '.') }}%
                            @endauth
    
                            @guest
                                style="width: 20.56%;">
                                20,56%
                            @endguest
                        </div>
                    </div>
                </div>

                <div class="col-3 col-sm-2 d-flex flex-column align-items-end fs-6 fs-md-5 fs-lg-4">
                    Despesas
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3 bg-white p-3 border rounded">
        <div class="row w-100">
            <div class="col-11 mb-3">
                <h5 class="fs-6 fs-md-5 fs-lg-4">Valores por Categoria</h5>
            </div>
            <div class="col-1 align-items-end fs-6 fs-md-5 fs-lg-4 mb-3">
                <span class="badge rounded-pill bg-primary" href="/categories">Ver mais</span>
            </div>
            
            @auth
                @if($categories->isEmpty())
                    <p class="text-center text-muted">Nenhuma transação registrada.</p>
                @else
                    <div class="row row-cols-1 row-cols-md-3 g-4 overflow-auto d-flex" style="flex-wrap: nowrap; overflow-x: auto;">
                        @foreach($categories as $category)
                            <div class="col-3">
                                <div class="card h-100">
                                    @php
                                        $balance = $category['balance'];
                                        $userBudget = $userBudgets->get($category['id']);
                                        $budget = $userBudget ? $userBudget->budget : $category['budget'];
                                        $badgeClass = '';
                                        if ($budget == 0.01) {
                                            $percentage = 100;
                                            $percentageExcess = 0;
                                            $percentageTotal = 100;
                                        } else {
                                            $percentage = $budget > 0.01 ? ($balance / $budget) * 100 : 0;
                                            $percentageExcess = ($balance > $budget) ? (($balance - $budget) / $budget) * 100 : 0;
                                            $percentageTotal = $percentage + $percentageExcess;
                                        }
                                        $percentageTotal = ($percentageTotal == 100) ? 99.99 : $percentageTotal;

                                        if ($balance > $budget && $budget != 0.01) {
                                            $badgeClass = 'bg-danger';
                                        } elseif ($balance == $budget) {
                                            $badgeClass = 'bg-success';
                                        } else {
                                            $badgeClass = 'bg-primary';
                                        }

                                        switch($category['name']) {
                                            case 'Alimentação':
                                                $imgSrc = 'https://ssl.gstatic.com/calendar/images/eventillustrations/2024_v2/img_lunch.svg';
                                                break;
                                            case 'Viagens':
                                                $imgSrc = 'https://ssl.gstatic.com/calendar/images/eventillustrations/2024_v2/img_trip.svg';
                                                break;
                                            case 'Lazer':
                                                $imgSrc = 'https://ssl.gstatic.com/calendar/images/eventillustrations/2024_v2/img_dinner.svg';
                                                break;
                                            default:
                                                $imgSrc = 'https://ssl.gstatic.com/calendar/images/eventillustrations/2024_v2/img_shopping.svg';
                                                break;
                                        }
                                    @endphp
                                    
                                    <img src="{{ $imgSrc }}" class="card-img-top" />
                                    <div class="card-body">
                                        <h5 class="card-title d-flex justify-content-between fs-6 fs-md-5 fs-lg-4">
                                            {{$category['name']}}
                                            <span class="badge rounded-pill {{$badgeClass}}">
                                                {{$selectedCurrency->symbol}} {{number_format($balance, 2, ',', '.')}}
                                            </span>
                                        </h5>
                                    </div>

                                    <div class="card-footer fs-6 fs-md-5 fs-lg-4">
                                        <div class="progress mt-1">
                                            @if ($percentage < 100 || $budget == 0.01)
                                                <div class="progress-bar bg-primary" style="width: {{ min($percentage, 100) }}%"></div>
                                            @else
                                                <div class="progress-bar bg-success" style="width: {{ min($percentage, 100) }}%"></div>
                                            @endif
                                            @if ($percentageExcess > 0)
                                                <div class="progress-bar bg-danger" style="width: {{ $percentageExcess }}%"></div>
                                            @endif
                                        </div>

                                        <div class="text-end mt-2">
                                            <small class="text-muted">Planejado: {{$selectedCurrency->symbol}} {{number_format($budget, 2, ',', '.')}}</small>
                                            <span class="badge rounded-pill {{$badgeClass}}">
                                                {{number_format($percentageTotal, 0)}}%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endauth

            @guest
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col">
                        <div class="card h-100">
                            <img src="https://ssl.gstatic.com/calendar/images/eventillustrations/2024_v2/img_lunch.svg" class="card-img-top"/>
                            <div class="card-body">
                                <h5 class="card-title d-flex justify-content-between fs-6 fs-md-5 fs-lg-4">
                                    Alimentação
                                    <span class="badge rounded-pill bg-danger">R$ 1.800,00</span>
                                </h5>
                            </div>

                            <div class="card-footer fs-6 fs-md-5 fs-lg-4">
                                <div class="progress mt-1">
                                    <div class="progress-bar bg-success" style="width: 100%"></div>
                                    <div class="progress-bar bg-danger" style="width: 20%"></div>
                                </div>

                                <div class="text-end">
                                    <small class="text-muted">Planejado: R$ 1.500,00</small>
                                    <span class="badge rounded-pill bg-danger">120%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                            
                    <div class="col">
                        <div class="card h-100">
                            <img src="https://ssl.gstatic.com/calendar/images/eventillustrations/2024_v2/img_trip.svg" class="card-img-top"/>
                            <div class="card-body">
                                <h5 class="card-title d-flex justify-content-between fs-6 fs-md-5 fs-lg-4">Transporte
                                    <span class="badge rounded-pill bg-primary">R$ 800,00</span>
                                </h5>
                            </div>

                            <div class="card-footer fs-6 fs-md-5 fs-lg-4">
                                <div class="progress mt-1">
                                    <div class="progress-bar bg-success" style="width: 80%"></div>
                                </div>

                                <div class="text-end">
                                    <small class="text-muted">Planejado: R$ 1.000,00</small>
                                    <span class="badge rounded-pill bg-success">80%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="col">
                        <div class="card h-100">
                            <img src="https://ssl.gstatic.com/calendar/images/eventillustrations/2024_v2/img_dinner.svg" class="card-img-top"/>
                            <div class="card-body">
                                <h5 class="card-title d-flex justify-content-between fs-6 fs-md-5 fs-lg-4">Lazer
                                    <span class="badge rounded-pill bg-primary">R$ 450,00</span>
                                </h5>
                            </div>

                            <div class="card-footer fs-6 fs-md-5 fs-lg-4">
                                <div class="progress mt-1">
                                    <div class="progress-bar bg-success" style="width: 75%"></div>
                                </div>

                                <div class="text-end">
                                    <small class="text-muted">Planejado: R$ 600,00</small>
                                    <span class="badge rounded-pill bg-success">75%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endguest
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3 bg-white p-3 border rounded">
        <div class="row w-100">
            <div class="col-12">
                <h5 class="fs-6 fs-md-5 fs-lg-4">Objetivos</h5>
            </div>

            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card h-100">
                        <img src="https://ssl.gstatic.com/calendar/images/eventillustrations/2024_v2/img_birthday.svg" class="card-img-top"/>
                        <div class="card-body">
                            <h5 class="card-title d-flex justify-content-between fs-6 fs-md-5 fs-lg-4">Festa de 15 da Sophia
                                <span class="badge rounded-pill bg-success">R$ 10.000,00</span>
                            </h5>
                            <p class="card-text text-end fs-6 fs-md-5 fs-lg-4">Atingido</p>
                        </div>

                        <div class="card-footer fs-6 fs-md-5 fs-lg-4">
                            <div class="progress mt-1">
                                <div class="progress-bar bg-success" style="width: 100%;"></div>
                            </div>

                            <div class="text-end">
                                <span class="badge rounded-pill bg-success">100%</span>
                            </div>

                            <div class="d-flex justify-content-between">
                                <small class="text-muted">Meta: R$ 10.000,00</small> 
                                <span class="badge rounded-pill bg-success">30/12/2024</span>              
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100">
                        <img src="https://ssl.gstatic.com/calendar/images/eventillustrations/2024_v2/img_interview.svg" class="card-img-top"/>
                        <div class="card-body">
                            <h5 class="card-title d-flex justify-content-between fs-6 fs-md-5 fs-lg-4">Novo Carro
                                <span class="badge rounded-pill bg-secondary">R$ 40.000,00</span>
                            </h5>
                            <p class="card-text text-end fs-6 fs-md-5 fs-lg-4">Valor mensal a ser guardado: R$ 1.470,59</p>
                        </div>

                        <div class="card-footer fs-6 fs-md-5 fs-lg-4">
                            <div class="progress mt-1">
                                <div class="progress-bar bg-primary" style="width: 80%;"></div>
                            </div>

                            <div class="text-end">
                                <span class="badge rounded-pill bg-primary">80%</span>
                            </div>

                            <div class="d-flex justify-content-between">
                                <small class="text-muted">Meta: R$ 50.000,00</small>
                                <span class="badge rounded-pill bg-primary">15/06/2026</span>              
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100">
                        <img src="https://ssl.gstatic.com/calendar/images/eventillustrations/2024_v2/img_shopping.svg" class="card-img-top"/>
                        <div class="card-body">
                            <h5 class="card-title d-flex justify-content-between fs-6 fs-md-5 fs-lg-4">Reforma da Casa
                                <span class="badge rounded-pill bg-warning text-dark">R$ 7.500,00</span>
                            </h5>
                            <p class="card-text text-end fs-6 fs-md-5 fs-lg-4">Valor mensal a ser guardado: R$ 1.090,91</p>
                        </div>

                        <div class="card-footer fs-6 fs-md-5 fs-lg-4">
                            <div class="progress mt-1">
                                <div class="progress-bar bg-warning" style="width: 37.5%;"></div>
                            </div>

                            <div class="text-end">
                                <span class="badge rounded-pill bg-warning text-dark">37,5%</span>
                            </div>

                            <div class="d-flex justify-content-between">
                                <small class="text-muted">Meta: R$ 20.000,00</small>
                                <span class="badge rounded-pill bg-danger">01/03/2025</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection