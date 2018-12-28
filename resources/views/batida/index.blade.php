@extends('layouts.app')

@section('content')
	<div class="container">
	  <h1>Relatório de batidas</h1>
	  <form class="form-inline">
				<div class="form-group">
	        <label for="mes" class="col-md-6 control-label">Selecione o mês</label>
	        <div class="col-md-5">
	            <select id="mes" name="mes">
	            	<option value="1">Janeiro</option>
	            	<option value="2">Fevereiro</option>
	            	<option value="3">Março</option>
	            	<option value="4">Abril</option>
	            	<option value="5">Maio</option>
	            	<option value="6">Junho</option>
	            	<option value="7">Julho</option>
	            	<option value="8">Agosto</option>
	            	<option value="9">Setembro</option>
	            	<option value="10">Outubro</option>
	            	<option value="11">Novembro</option>
	            	<option value="12">Dezembro</option>
	            </select>
	        </div>
	      </div>
			 	<div class="form-group">
	        <div class="col-md-8 col-md-offset-4">
	          <a class="btn btn-primary" onclick="buscar();">Buscar</a>
	        </div>
	      </div>
	  </form>
		<table class="table">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">Dia</th>
		      <th scope="col">Entrada</th>
		      <th scope="col">Saída</th>
		      <th scope="col">Tempo trabalhado</th>
		      <th>Opções</th>
		    </tr>
		  </thead>
		  <tbody>
		  @foreach ($batidas AS $batida)
		  	<tr>
		  		<td>{{ \Carbon\Carbon::parse($batida->data)->format('d/m/Y') }}</td>
		  		<td>{{ \Carbon\Carbon::parse($batida->entrada)->format('H:i')}}</td>
		  		<td>
		  			@if ($batida->saida == NULL)
		  				<a href="/batida/{{$batida->id}}/edit">Saída</a>
		  			@else 
		  				{{\Carbon\Carbon::parse($batida->saida)->format('H:i')}}
		  			@endif
		  		</td>
		  		<td>
		  			@if ($batida->minutos == NULL)
		  				- 
		  			@else 
		  				<?php $horas = \Carbon\Carbon::createFromFormat('H:m', '00:00')->addMinutes($batida->minutos)->toTimeString() ?>
		  				{{ \Carbon\Carbon::parse($horas)->format('H:i') }}
		  			@endif
		  		</td>
		  		<td>
		  			<a href="/batida/{{$batida->id}}/edit">Editar</a>
						{{ Form::open(array('url' => 'batida/' . $batida->id)) }}
              {{ Form::hidden('_method', 'DELETE') }}
              {{ Form::submit('Apagar', array('class' => 'btn btn-danger')) }}
            {{ Form::close() }}
		  		</td>
		  	</tr>
		  @endforeach
	</div>
	<script type="text/javascript">
		function buscar(){
			var select = document.getElementById("mes");
			var mes = select.options[select.selectedIndex].value;	
			var baseUrl = location.protocol+'//'+location.hostname+(location.port ? ':'+location.port: '');
			var redirectTo = baseUrl + '/batida/' + mes;
			window.location.replace(redirectTo);
		}
	</script>
@endsection