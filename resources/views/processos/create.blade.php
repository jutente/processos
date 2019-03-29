@extends('layouts.app')

@section('content')
<div class="container">

                <div><a href="{{route('processos.index')}}">processo</a> - Novo Registro</div>
                <br>
                {!! Form::open(['method' => 'post', 'url' => route('processos.store'), 'class' => 'form-horizontal','enctype'=>'multipart/form-data']) !!}

                {{ Form::hidden('user_id', Auth::user()->id)}}
                {{ Form::hidden('atual', Auth::user()->id)}}

                <!-- numprocesso  -->
                    <div class="form-group {{ $errors->has('numprocesso') ? ' has-error' : '' }}">
                            {{ Form::label('numprocesso', 'Numero do processo:', ['class' => 'control-label']) }}
                            <div>
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
                        {{ Form::label('descricao', 'Descricao:', ['class' => 'control-label']) }}
                        <div>
                            {{ Form::textarea('descricao', '', ['class' => 'form-control text-uppercase']) }}
                            @if ($errors->has('descricao'))
                                <span class="help-block">
                                    <strong>{{$errors->first('descricao')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- arquivo  -->
                    <div class="form-group {{ $errors->has('descricao') ? ' has-error' : '' }}">
                        {{ Form::label('image', 'Arquivo:', ['class' => 'control-label']) }}
                        <div>
                            {{ Form::file('image',['class' => 'form-control']) }}
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


            <a href="{{route('processos.index')}}" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Voltar</a>


</div>
@endsection
