@extends('adminlte::page')

@section('title', 'Histórico')

@section('content_header')
    <h1>Histórico</h1>
    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Saldo</a></li>
        <li><a href="">Histórico</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Histórico</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <td>Código</td>
                    <td>Tipo</td>
                    <td>Valor</td>
                    <td>Data</td>
                    <td>Recebedor</td>
                </tr>

                @foreach($historics as $historic)
                    <tr>
                        <td>{{$historic->id}}</td>
                        <td>{{$historic->type($historic->type)}}</td>
                        <td>{{number_format($historic->amount,2,',','.')}}</td>
                        <td>{{$historic->date}}</td>
                        <td>
                            @if($historic->user_id_transaction)
                                {{$historic->userReceiver->name}}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @endforeach
                </thead>
            </table>
        </div>
    </div>
@stop
