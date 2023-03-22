<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use App\Models\Telefone;
use App\Http\Requests\StoreContatoRequest;
use App\Http\Requests\UpdateContatoRequest;
use Symfony\Component\HttpFoundation\Request;
use Carbon\Carbon;

class ContatoController extends Controller
{
    public function __construct(Contato $contato){
        $this->contato = $contato;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->contato->with('telefones')->get(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContatoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->contato->rules(), $this->contato->feedback());
        $data = explode('/', $request->data_de_nascimento);
        $contato = $this->contato->create([
            'nome' => $request->nome,
            'email' => $request->email,
            'data_de_nascimento' => Carbon::createFromDate($data[2], $data[1], $data[0]),
            'cpf' => $request->cpf
        ]);
        if($request->telefone){
            $contato = Contato::where('email', $request->email)->first();
            $telefones = explode(',', $request->telefone);
            foreach($telefones as $telefone){
                Telefone::create([
                    'telefone' => $telefone,
                    'contato_id' => $contato->id
                ]);
            }
        }
        return response()->json($contato, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contato  $contato
     * @return \Illuminate\Http\Response
     */
    public function show(Contato $contato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contato  $contato
     * @return \Illuminate\Http\Response
     */
    public function edit(Contato $contato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContatoRequest  $request
     * @param  \App\Models\Contato  $contato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contato = $this->contato->find($id);

        if($contato == null){
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if($request->telefone){
            if(!$request->has('filtro') || $request->filtro == null){
                return response()->json(['erro' => 'É necessário selecionar qual o id do telefone a ser atualizado'], 400);
            }
        }

        $request->validate(Telefone::rules(), Telefone::feedback());
        $telefones = Telefone::where('contato_id', $contato->id)->get();
        $telAtualizado = false;
        foreach($telefones as $key => $telefone){
            if($telefones[$key]->id == $request->filtro){
                $tel = Telefone::where('id', $telefones[$key]->id)->first()->fill(array(
                    'telefone' => $request->telefone
                ));
                $tel->save();
                $telAtualizado = true;
            }
        }

        if(!$telAtualizado){
            return response()->json(['erro' => 'O id do telefone fornecido não pertence ao contato']);
        }

        $request->validate($contato->rules(), $contato->feedback());
        $data = explode('/', $request->data_de_nascimento);
        $contato->fill(array(
            'nome' => $request->nome,
            'email' => $request->email,
            'data_de_nascimento' => Carbon::createFromDate($data[2], $data[1], $data[0]),
            'cpf' => $request->cpf
        ));
        $contato->save();

        return response()->json($contato, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contato  $contato
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contato = $this->contato->find($id);

        if($contato == null){
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }

        $contato->delete();
        return response()->json(['msg' => 'O contato foi removido com sucesso'], 200);
    }
}
