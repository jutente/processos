@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @if(Session::has('edited_processos'))
            <div class="alert alert-info">
                <a href="#" class="close" data-dismiss="alert" aria-label="Fechar">&times;</a>
                <strong>Info!</strong> {{ session('edited_processos') }}
            </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{route('processos.index')}}">processos</a> - Alterar</div>
                <br>

                {!! Form::open(['method' => 'post', 'url' => route('processos.update', $processo->id), 'class' => 'form-horizontal']) !!}

                {{ Form::hidden('_method', 'PUT') }}
                <div class="form-group {{ $errors->has('numprocesso') ? ' has-error' : '' }}">
                    {{ Form::label('numprocesso', 'Numero do processo:', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::text('numprocesso', $processo->numprocesso, ['class' => 'form-control']) }}
                        @if ($errors->has('numprocesso'))
                            <span class="help-block">
                            <strong>{{$errors->first('numprocesso')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('processos') ? ' has-error' : '' }}">
                    {{ Form::label('descricao', 'Descriçao:', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::textarea('descricao', $processo->descricao, ['class' => 'form-control']) }}
                        @if ($errors->has('descricao'))
                            <span class="help-block">
                                <strong>{{$errors->first('descricao')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                 <br>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        {{ Form::submit('Salvar', ['class' => 'btn btn-primary']) }}
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
                <a href="{{route('processos.index')}}" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Voltar</a>
        </div>
    </div>
</div>
@endsection
