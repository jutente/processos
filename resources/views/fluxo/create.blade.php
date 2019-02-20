@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{route('processos.index')}}">processo</a> - Novo Registro</div>
                <br>
                {!! Form::open(['method' => 'post', 'url' => route('fluxo.store'), 'class' => 'form-horizontal']) !!}


                <div class="form-group ">
                    {{ Form::label('numprocesso', 'Numero do processo:', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::text('numprocesso', $processos->numprocesso, ['class' => 'form-control', 'readonly' =>'true']) }}
                        @if ($errors->has('numprocesso'))
                            <span class="help-block">
                            <strong>{{$errors->first('numprocesso')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group ">
                    {{ Form::label('descricaoprocesso', 'Descriçao:', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::textarea('descricaoprocesso', $processos->descricao, ['class' => 'form-control', 'readonly' =>'true']) }}
                        @if ($errors->has('descricao'))
                            <span class="help-block">
                                <strong>{{$errors->first('descricao')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                 <!-- Selecionar setor de destino -->
                 <div class="form-group  {{ $errors->has('setor_id') ? ' has-error' : '' }}">
                    {{ Form::label('setordestino', 'Encaminhar para o Setor:', ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                        {!! Form::select('setordestino', $setors, null, ['placeholder' => 'Escolha um setor...', 'class' => 'form-control']) !!}
                        @if ($errors->has('setor_id'))
                            <span class="help-block">
                                <strong>{{$errors->first('setor_id')}}</strong>
                            </span>
                        @endif
                        </div>
                </div>

                <!-- descricao fluxo -->
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

                {{ Form::hidden('processo_id', $processos->id)}}
                {{ Form::hidden('user_id', Auth::user()->id)}}


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
