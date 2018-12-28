@extends('layouts.app')

@section('content')
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">Batida de entrada</div>
		<div class="panel-body">
			{!! Form::open([
				'route' => 'batida.store',
				'class' => 'form-horizontal'
			]) !!}
				<div class="form-group">
					<div class="form-group">
		          <label for="email" class="col-md-4 control-label">Data</label>
		          <div class="col-md-6">
		              <input id="data" type="date" class="form-control" name="data" value="{{ date('Y-m-d') }}" required>
		          </div>
		      </div>
		      <div class="form-group">
		          <label for="email" class="col-md-4 control-label">Entrada</label>
		          <div class="col-md-6">
		              <input id="entrada" type="time" class="form-control" name="entrada" value="{{ old('entrada') }}" required autofocus>
		          </div>
		      </div>
		      <div class="form-group">
		          <label for="email" class="col-md-4 control-label">Tempo esperado da jornada de trabalho</label>
		          <div class="col-md-6">
		              <input id="tempo_esperado" type="number" class="form-control" name="tempo_esperado" value="4" placeholder="Apenas o número inteiro de horas" value="4">
		          </div>
		      </div>
				 	<div class="form-group">
            <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Salvar
                </button>
            </div>
		      </div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection