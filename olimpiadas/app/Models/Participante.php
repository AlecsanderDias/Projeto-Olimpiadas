<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['nome', 'ala', 'dataNascimento','capitao', 'equipe_id'];

    public function equipes() {
        return $this->belongsTo(Equipe::class);
    }
}
