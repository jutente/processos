@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

	        {{-- avisa se um usuario foi excluido --}}
	        @if(Session::has('deleted_processos'))
                <div class="alert alert-info">
                    <a href="#" class="close" data-dismiss="alert" aria-label="Fechar">&times;</a>
                    <strong>Info!</strong> {{ session('deleted_processos') }}
                </div>
	        @endif
	        {{-- avisa quando um usuário foi modificado --}}
	        @if(Session::has('create_processos'))
                <div class="alert alert-info">
                    <a href="#" class="close" data-dismiss="alert" aria-label="Fechar">&times;</a>
                    <strong>Info!</strong> {{ session('create_processos') }}
                </div>
	        @endif

            <div class="card">

	            <div class="card-header">
					<div class="row">
					  <div class="col-sm-4">
					  	Meus processos.
					  </div>
					  <div class="col-sm-8 text-right">
					  	<div class="btn-group btn-group-sm">
							<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalFilter">Filtro</a>
							<a href="{{route('processos.create')}}" class="btn btn-primary">Novo Registro</a>
					  	</div>
					  </div>
					</div>
				</div>
				<br>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-hover" >
                            <thead>
                            <tr>
                                <th width="10%">Numero do processo</th>
                                <th width="35%">Descriçao</th>
                                <th width="20%">Arquivo</th>
                                <th width="20%">Data</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach($processos as $p)
                                <tr>

                                    <td>{{$p->numprocesso}}</td>
                                    <td>{{$p->descricao}}</td>

                                    @if (isset($url))
                                        <td> <a href="{{$url}}" >arquivo</a></td>
                                    @else
                                        <td>sem arquivo</td>
                                    @endif

                                    <td>{{\Carbon\Carbon::parse($p->created_at)->format('d/m/Y H:i:s')}}</td>

                                    <td style="text-align: right">
                                        <div class="btn-group">
                                            <a href="{{route('fluxo.show',$p->id)}}" class="btn btn-warning btn-sm" role="button">Tramitar</a>

                                            @if ( !$fluxo->contains('processo_id',$p->id))
                                                <a href="{{route('processos.edit',$p->id)}}" class="btn btn-primary btn-sm" role="button">Alterar</a>
                                                <a href="{{route('processos.show',$p->id)}}" class="btn btn-danger btn-sm" role="button">Excluir</a>
                                            @else
                                                <a href="{{route('fluxo.passagem',$p->id)}}" class="btn btn-info btn-sm" role="button">Detalhar</a>
                                            @endif
                                        </div>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

				<div class="row" align="center">
					{{$processos->links()}}
				</div>
	        </div>
    	</div>
    </div>
</div>

<!-- Modal -->
<div id="modalFilter" class="modal fade" role="dialog">
	<div class="modal-dialog">

	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title">Modal Header</h4>
		</div>
		<div class="modal-body">
			{!! Form::open(['method'=>'GET','url'=>route('processos.index')])  !!}
			<br>
			<div class="form-group">
				{{ Form::label('processos', 'processos:') }}
				{{ Form::text('processos', '', ['class' => 'form-control', 'placeholder' => 'Nome do processos...']) }}
			</div>
			<br>


			<div class="form-group">
				{{ Form::submit('Buscar', ['class' => 'btn btn-default btn-sm']) }}
				<a href="{{ route('processos.index') }}" class="btn btn-default btn-sm" role="button">Limpar</a>
			</div>
			{!! Form::close() !!}
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	  </div>

	</div>
  </div>


@endsection
