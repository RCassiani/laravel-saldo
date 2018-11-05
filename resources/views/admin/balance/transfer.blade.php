@extends('adminlte::page')

@section('title', 'Transferir')

@section('content_header')
    <h1>Transferência</h1>
    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Saldo</a></li>
        <li><a href="">Transferir</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Fazer Transferência (Informe o Recebedor)</h3>
        </div>
        <div class="box-body">
            @include('admin.includes.alerts')

            <form method="POST" action="{{route('transfer.confirm')}}">
                {{csrf_field()}}
                <div class="form-group">
                    <input type="text" name="receiver" placeholder="Nome do Recebedor" class="form-control">
                </div>
                <div class="form-group">
                    <button class="btn btn-success">Continuar</button>
                </div>
            </form>
        </div>
    </div>
@stop
