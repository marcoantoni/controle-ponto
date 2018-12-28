@extends('layouts.app')

@section('content')
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">Batida de saída</div>
		<div class="panel-body">
			{!! Form::model($batida, [
				'method' => 'PATCH',
				'route' => ['batida.update', $batida->id], 
				'class' => 'form-horizontal'
			]) !!}
				<div class="form-group">
					<div class="form-group">
		          <label for="email" class="col-md-4 control-label">Saída</label>
		          <div class="col-md-6">
		              <input id="saida" type="time" class="form-control" name="saida" value="{{ \Carbon\Carbon::parse($batida->saida)->format('H:i')}}">
		              @if ($errors->has('email'))
		                  <span class="help-block">
		                      <strong>{{ $errors->first('email') }}</strong>
		                  </span>
		              @endif
		          </div>
		      </div>
					<div class="form-group">
		          <label for="email" class="col-md-4 control-label">Data</label>
		          <div class="col-md-6">
		              <input id="data" type="date" class="form-control" name="data" value="{{ $batida->data }}">
		          </div>
		      </div>
		      <div class="form-group">
		          <label for="email" class="col-md-4 control-label">Entrada</label>
		          <div class="col-md-6">
		              <input id="entrada" type="time" class="form-control" name="entrada" value="{{ \Carbon\Carbon::parse($batida->entrada)->format('H:i')}}">
		              @if ($errors->has('email'))
		                  <span class="help-block">
		                      <strong>{{ $errors->first('email') }}</strong>
		                  </span>
		              @endif
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