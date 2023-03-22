<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\ContatoController;
use App\Models\Contato;

class ApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_existem_contatos()
    {
        $response = $this->get('http://localhost:8000/api/contato');
        $response->assertStatus(200);
    }

    public function test_existem_nomes()
    {
        $response = $this->get('http://localhost:8000/api/nomes');
        $response->assertStatus(200);
    }

    public function test_novo_contato()
    {
        $response = $this->post('http://localhost:8000/api/contato', [
            'nome' => 'nome3',
            'email' => 'email@email4.com',
            'data_de_nascimento' => '5/5/2020',
            'cpf' => 12345678911,
            'telefone' => 12345678,12345678
        ]);
        $response->assertStatus(201);
    }

    public function test_atualizar_contato()
    {
        $response = $this->post('http://localhost:8000/api/contato/2?filtro=3', [
            '_method' => 'put',
            'nome' => 'nome3',
            'email' => 'email@email4.com',
            'data_de_nascimento' => '5/5/2020',
            'cpf' => 12345678911,
            'telefone' => 12345678
        ]);
        $response->assertStatus(200);
    }

    public function test_deletar_contato()
    {
        $response = $this->post('http://localhost:8000/api/contato/1');
        $response->assertStatus(200);
    }

    public function test_deletar_telefone()
    {
        $response = $this->post('http://localhost:8000/api/telefone/1?filtro=2');
        $response->assertStatus(200);
    }
}
