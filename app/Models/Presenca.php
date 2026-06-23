<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presenca extends Model
{
    protected $table = 'presencas';

    protected $fillable = [
        'id_usuario',
        'id_atividade',
        'presente'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function atividade()
    {
        return $this->belongsTo(Atividade::class, 'id_atividade');
    }
}