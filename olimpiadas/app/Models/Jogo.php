<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jogo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['data', 'casa', 'adversario', 'resultadoCasa', 'resultadoAdversario','placarCasa','placarAdversario'];
}
