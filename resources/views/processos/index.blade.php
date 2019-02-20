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
	        <div class="panel panel-default">
	            <div class="panel-heading">
					<div class="row">
					  <div class="col-sm-4">
					  	Meus processos.
					  </div>
					  <div class="col-sm-12 text-right">
					  	<div class="btn-group btn-group-sm">
							<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalFilter">Filtro</a>

							<a href="{{route('processos.create')}}" class="btn btn-primary">Novo Registro</a>

					  	</div>
					  </div>
					</div>
				</div>
				<br>

	            <div class="table-responsive">
	                <table class="table table-striped">
	                    <thead>
	                    <tr>
                            <th width="20%">Numero do processo</th>
                            <th width="50%">Descriçao</th>
                            <th>Data</th>
	                    </tr>
	                    </thead>

	                    <tbody>
							@foreach($processos as $p)
							<tr>

								<td>{{$p->numprocesso}}</td>
                                <td>{{$p->descricao}}</td>
                                <td>{{\Carbon\Carbon::parse($p->created_at)->format('d/m/Y')}}</td>

                                <td style="text-align: right">

                                    <a href="{{route('fluxo.show',$p->id)}}" class="btn btn-warning btn-xs" role="button">Tramitar</a>
                                    <a href="{{route('processos.edit',$p->id)}}" class="btn btn-primary btn-xs" role="button">Alterar</a>

                                    <a href="{{route('processos.show',$p->id)}}" class="btn btn-danger btn-xs" role="button">Excluir</a>
                                </td>

							</tr>
							@endforeach
	                    </tbody>
	                </table>
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
