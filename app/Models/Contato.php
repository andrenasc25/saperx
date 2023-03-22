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
            'email' => 'required|email|unique:contatos,email,'.$this->id,
            'data_de_nascimento' => 'required',
            'cpf' => 'required'
        ];
    }

    public function feedback(){
        return [
            'nome.required' => 'O campo nome não pode ficar vazio',
            'email.required' => 'O campo email não pode ficar vazio',
            'email.email' => 'O campo email tem que ser do tipo email',
            'email.unique' => 'Já existe um contato com o e-mail inserido',
            'data_de_nascimento' => 'O campo data_de_nascimento não pode ficar vazio',
            'cpf.required' => 'O campo cpf não pode ficar vazio'
        ];
    }

    public function telefones(){
        return $this->hasMany('App\Models\Telefone');
    }
}
