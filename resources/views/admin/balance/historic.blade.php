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
            <form action="{{route('historic.search')}}" method="POST" class="form-inline">
                {!! csrf_field() !!}
                <input type="text" class="form-control" name="id" placeholder="Id">
                <input type="date" class="form-control" name="date">
                <select name="type" class="form-control">
                    <option value="">Tipo</option>
                    @foreach($types as $key => $type)
                        <option value="{{$key}}">{{$type}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </form>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <td>Código</td>
                    <td>Tipo</td>
                    <td>Valor</td>
                    <td>Data</td>
                    <td>Pessoa</td>
                </tr>
                </thead>
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
            </table>
            @if(isset($data))
                {{ $historics->appends($data)->links() }}
            @else
                {{ $historics->links() }}
            @endif
        </div>
    </div>
@stop
