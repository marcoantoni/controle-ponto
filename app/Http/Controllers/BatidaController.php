<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Html\FormFacade;
use Illuminate\Html\HtmlFacade;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Batida;

class BatidaController extends Controller {


	public function __construct() {
 	  $this->middleware('auth');
  }

	public function create() {
		return view('batida.create');
	}

	public function store(Request $request) {
		$batida = New Batida();
		$batida->entrada = $request->input('entrada');
		$batida->data = $request->input('data');
		$batida->tempo_esperado = (int) $request->input('tempo_esperado') * 60;	//armazena o valor em minutos
		$batida->id_usuario = Auth::id();
		$batida->save();
		return redirect('batida')->with('success', 'Agendamento criado com sucesso!');
  }

  public function edit($id) {
		$batida = Batida::find($id);

		if ($batida->id_usuario == Auth::id())
		  return view('batida.edit')->with('batida', $batida);		
	}

  public function update(Request $request, $id) {
  	try {
  		$batida = Batida::find($id);
  		$batida->entrada = $request->input('entrada');
			$batida->data = $request->input('data');
			$batida->saida = $request->input('saida');

			// calcular minutos
			$entrada = \Carbon\Carbon::parse($batida->entrada)->format('H:i');
			$batida->minutos = $this->calcularTempo($entrada , $request->input('saida')); 

			$batida->save();
			return redirect('batida')->with('success', 'Agendamento criado com sucesso!');

		} catch (\Illuminate\Database\QueryException $ex) {
      return back()->withInput()->with('error', 'Erro: ' . $ex->getMessage());
    }       
  }

  public function calcularTempo($entrada, $saida) {
  	$entrada = \Carbon\Carbon::createFromFormat('H:i', $entrada);
		$saida = \Carbon\Carbon::createFromFormat('H:i', $saida);
		return $entrada->diffInMinutes($saida);	
  }

  public function index() {
		$dt_ini = date('Y-m-') . 1; // primeiro dia do mês
		$dt_fim =  date('Y-m-t'); // ultimo dia do mês
  	$batidas = Batida::getBatidas(Auth::id(), $dt_ini, $dt_fim);
  	return view('batida.index')->with(['batidas' => $batidas]);
	}

	public function getRelatorioSaldo($mes=NULL){
		if ($mes == NULL) {
			$dt_ini = date('Y-m-') . 1; // primeiro dia do mês
			$dt_fim =  date('Y-m-t'); // ultimo dia do mês
		} else {
			$dt_ini = date('Y-'. $mes .'-') . 1; // primeiro dia do mês
			$dt_fim =  date('Y-'. $mes .'-t'); // ultimo dia do mês
		}
		$batidas = Batida::getRelatorio(Auth::id(), $dt_ini, $dt_fim);
		return view('batida.relatorio')->with(['batidas' => $batidas]);
	}

	public function destroy($id) {
    // delete
    $batida = Batida::find($id);
    

    if ($batida->id_usuario == Auth::id()){
	    $batida->delete();
    }
	  else
	  	return "Erro";

    // redirect
    //Session::flash('message', 'Successfully deleted the nerd!');
    return redirect('batida');
  }


  public function show($id) {
		$dt_ini = date('Y-') . $id . '-' . 1; // primeiro dia do mês
		$dt_fim =  date('Y-') . $id . '-' . 31; // ultimo dia do mês
  	$batidas = Batida::getBatidas(Auth::id(), $dt_ini, $dt_fim);
  	return view('batida.index')->with(['batidas' => $batidas]);
	}

}
