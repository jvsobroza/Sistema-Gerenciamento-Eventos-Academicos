<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
    protected $table = 'atividade';
    protected $fillable = [
        'id_evento',
        'tipo',
        'titulo',
        'data',
        'hora_inicio',
        'hora_fim',
        'local',
        'vagas',
        'responsaveis',
        'resumo'
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class, 'id_evento');
    }
}
