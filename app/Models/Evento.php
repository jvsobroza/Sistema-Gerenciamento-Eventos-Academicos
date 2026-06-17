<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'eventos';
    protected $fillable = [
        'nome',
        'sigla',
        'local',
        'data_inicio',
        'data_fim',
        'descricao',
        'logo'
    ];

    public function atividades()
    {
        return $this->hasMany(Atividade::class, 'id_evento');
    }

    public function certificados()
    {
        return $this->hasMany(Certificado::class, 'id_evento');
    }
}
