<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    use HasFactory;
    protected $fillable = ['telefone', 'contato_id'];

    public function contato(){
        return $this->belongsTo('App\Models\Contato');
    }
}
