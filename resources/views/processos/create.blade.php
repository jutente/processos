@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{route('processos.index')}}">processo</a> - Novo Registro</div>
                <br>
                {!! Form::open(['method' => 'post', 'url' => route('processos.store'), 'class' => 'form-horizontal']) !!}

                {{ Form::hidden('user_id', Auth::user()->id)}}
                {{ Form::hidden('atual', Auth::user()->id)}}

                <!-- numprocesso  -->
                <div class="form-group {{ $errors->has('numprocesso') ? ' has-error' : '' }}">
                        {{ Form::label('numprocesso', 'Numero do processo:', ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::text('numprocesso', '', ['class' => 'form-control text-uppercase']) }}
                            @if ($errors->has('numprocesso'))
                                <span class="help-block">
                                    <strong>{{$errors->first('numprocesso')}}</strong>
                                </span>
                            @endif
                        </div>
                </div>

                <!-- processo -->
                <div class="form-group {{ $errors->has('descricao') ? ' has-error' : '' }}">
                    {{ Form::label('descricao', 'Descricao:', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::textarea('descricao', '', ['class' => 'form-control text-uppercase']) }}
                        @if ($errors->has('descricao'))
                            <span class="help-block">
                                <strong>{{$errors->first('descricao')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        {{ Form::submit('Incluir', ['class' => 'btn btn-primary']) }}
                    </div>
                </div>

                {!! Form::close() !!}

            </div>
            <a href="{{route('processos.index')}}" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Voltar</a>
        </div>
    </div>
</div>
@endsection
