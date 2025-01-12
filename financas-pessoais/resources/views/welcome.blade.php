@extends('layouts.main') 

@section('title', 'Página Inicial') 

@section('content') 

@guest
<h1>Página Inicial</h1>
@endguest

@auth
<h1>Página Inicial Autenticado</h1>
@endauth

@endsection