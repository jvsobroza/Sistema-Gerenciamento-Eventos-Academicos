<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscricao extends Model
{
    protected $table = 'inscricaos';
    protected $fillable = [
        'id_usuario',
        'id_atividade',
        'data_inscricao'
    ];

    public function atividade()
    {
        return $this->belongsTo(Atividade::class, 'id_atividade');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
