<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['nome', 'capitao'];

    public function participantes() {
        return $this->hasMany(Participante::class);
    }

    public function campeonatos() {
        return $this->belongsToMany(Campeonato::class);
    }

    public function times() {
        return $this->hasMany(Time::class);
    }
}
