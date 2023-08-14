<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campeonato extends Model
{
    use HasFactory;
    protected $fillable = ['nome','tipo_id','timesPorEquipe','modalidade_id','especialidade_id'];

    public function tipos() {
        return $this->hasOne(Tipo::class);
    }

    public function modalidades() {
        return $this->hasOne(Modalidade::class);
    }

    public function espcialidades() {
        return $this->hasOne(Especialidade::class);
    }

    public function equipes() {
        return $this->belongsToMany(Equipe::class);
    }

    public function times() {
        return $this->hasMany(Time::class);
    }

    public function jogos() {
        return $this->hasMany(Jogo::class);
    }
}
