@extends('layout.main')

@section('title', ' - Dashboard')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <div class="alert alert-success">
        <p>Hallo <span class="font-weight-bold">{{auth()->user()->name}}</span>, Kamu Login Sebagai <span class="font-weight-bold">{{auth()->user()->role}}</span>.</p>
    </div>
@endsection 