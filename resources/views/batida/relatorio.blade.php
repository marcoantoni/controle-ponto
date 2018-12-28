@extends('layouts.app')

@section('content')
	<?php 
		$total_trabalhado = 0;
		$tempo_esperado = 0; 
	?>
<div class="container">
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
	      <th scope="col">Minutos</th>
	    </tr>
	  </thead>
	  <tbody>
			@foreach ($batidas AS $batida)
	    <tr>
	      <td><a href="consultardia/{{ $batida->data }}">{{ \Carbon\Carbon::parse($batida->data)->format('d/m/Y') }}</a></td>
				<td>
					@if ($batida->total_trabalhado >= $batida->tempo_esperado)
						<?php 
							$tempo = $batida->total_trabalhado - $batida->tempo_esperado; 
							$horas = \Carbon\Carbon::createFromFormat('H:m', '00:00')->addMinutes($tempo)->toTimeString()
						?>
						Sobrou {{ \Carbon\Carbon::parse($horas)->format('H:i') }} 
					@else
						<?php 
							$tempo = $batida->tempo_esperado - $batida->total_trabalhado; 
							$horas = \Carbon\Carbon::createFromFormat('H:m', '00:00')->addMinutes($tempo)->toTimeString()
						?>
						Faltou {{ \Carbon\Carbon::parse($horas)->format('H:i') }}
					@endif
				</td>
			</tr>
			<?php
				$total_trabalhado = $total_trabalhado + $batida->total_trabalhado;
				$tempo_esperado = $tempo_esperado + $batida->tempo_esperado;
			?>
			@endforeach
			<tr>
				<td>TOTAL DO MÊS</td>
				<td>
					@if ($total_trabalhado >= $tempo_esperado)
						<?php 
							$tempo = $total_trabalhado - $tempo_esperado; 
							$horas = \Carbon\Carbon::createFromFormat('H:m', '00:00')->addMinutes($tempo)->toTimeString()
						?>
						Sobrou {{ \Carbon\Carbon::parse($horas)->format('H:i') }} este mês
					@else
						<?php 
							$tempo = $tempo_esperado - $total_trabalhado; 
							$horas = \Carbon\Carbon::createFromFormat('H:m', '00:00')->addMinutes($tempo)->toTimeString()
						?>
						Faltou {{ \Carbon\Carbon::parse($horas)->format('H:i') }} este mês
					@endif
				</td>
			</tr>
		</tbody>
	</table>
</div>
	<script type="text/javascript">
		function buscar(){
			var select = document.getElementById("mes");
			var mes = select.options[select.selectedIndex].value;	
			var baseUrl = location.protocol+'//'+location.hostname+(location.port ? ':'+location.port: '');
			var redirectTo = baseUrl + '/relatorio/' + mes;
			window.location.replace(redirectTo);
		}
	</script>
@endsection