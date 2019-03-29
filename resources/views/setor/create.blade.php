@extends('layouts.app')

@section('content')
<div class="container">



                <div><a href="{{route('setor.index')}}">setor</a> - Novo Registro</div>
                <br>
                {!! Form::open(['method' => 'post', 'url' => route('setor.store'), 'class' => 'form-horizontal']) !!}

                <!-- setor -->
                <div class="form-group {{ $errors->has('setor') ? ' has-error' : '' }}">
                    {{ Form::label('setor', 'setor:', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::text('setor', '', ['class' => 'form-control text-uppercase']) }}
                        @if ($errors->has('setor'))
                            <span class="help-block">
                                <strong>{{$errors->first('setor')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <!-- centrocusto  -->
                <div class="form-group {{ $errors->has('centrocusto') ? ' has-error' : '' }}">
                        {{ Form::label('centrocusto', 'centrocusto:', ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::text('centrocusto', '', ['class' => 'form-control text-uppercase']) }}
                            @if ($errors->has('centrocusto'))
                                <span class="help-block">
                                    <strong>{{$errors->first('centrocusto')}}</strong>
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

            <a href="{{route('setor.index')}}" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Voltar</a>


</div>
@endsection
