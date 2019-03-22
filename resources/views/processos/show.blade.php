@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{route('processos.index')}}">processos</a> - Excluir</div>
                <br>
                <ul class="list-group">
                    <li class="list-group-item">processo: {{$processo->descricao}}</li>
                </ul>
                <br><br>
                {!! Form::open(['method' => 'POST', 'url' => route('processos.destroy', $processo->id), 'class' => 'form-horizontal']) !!}

                {{ Form::hidden('_method', 'DELETE') }}

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-2 text-center">
                        {{ Form::submit('Excluir?', ['class' => 'btn btn-danger btn-sm']) }}
                    </div>
                </div>

                {!! Form::close() !!}
            </div>

            <a href="{{route('processos.index')}}" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Voltar</a>
        </div>
    </div>
</div>
@endsection
