<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    use HasFactory;
    protected $fillable = ['telefone', 'contato_id'];

    public function rules(){
        return [
            'telefone' => 'required'
        ];
    }

    public function feedback(){
        return [
            'telefone.required' => 'É necessário inserir o telefone'
        ];
    }

    public function contato(){
        return $this->belongsTo('App\Models\Contato');
    }
}
