<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Evento;
use App\Models\Inscricao;
use App\Models\Presenca;

class Atividade extends Model
{
    protected $table = 'atividades';

    protected $fillable = [
        'id_evento',
        'titulo',
        'descricao',
        'data',
        'hora_inicio',
        'hora_fim',
        'local',
        'vagas',
        'responsaveis',
        'tipo',
        'resumo',
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class, 'id_evento');
    }

    public function inscricoes()
    {
        return $this->hasMany(Inscricao::class, 'id_atividade');
    }

    public function presencas()
    {
        return $this->hasMany(Presenca::class, 'id_atividade');
    }
}