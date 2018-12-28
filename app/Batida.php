<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Batida extends Model {
    
    protected $table = 'batidas';
    public $timestamps = false;
   
    public static function getRelatorio($id_usuario, $dt_inicio, $dt_fim){
         $sql = "SELECT data, SUM(minutos) AS total_trabalhado, SUM(tempo_esperado) AS tempo_esperado FROM batidas WHERE id_usuario = $id_usuario AND data BETWEEN '$dt_inicio' AND '$dt_fim' GROUP BY data ORDER BY data ASC";
        
         return DB::select($sql);
    }

    public static function getBatidas($id_usuario, $dt_inicio, $dt_fim){
         $sql = "SELECT id, entrada, saida, minutos, data FROM batidas WHERE id_usuario = $id_usuario AND data BETWEEN '$dt_inicio' AND '$dt_fim' ORDER BY data ASC";
        
         return DB::select($sql);
    }
    
}