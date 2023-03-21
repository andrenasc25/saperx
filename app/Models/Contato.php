<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'email', 'data_de_nascimento', 'cpf'];

    public function rules(){
        return [
            'nome' => 'required',
            'email' => 'required|email',
            'data_de_nascimento' => 'required',
            'cpf' => 'required'
        ];
    }
}
