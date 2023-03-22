<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Telefone;
use App\Models\Contato;

class TelefoneController extends Controller
{
    public function destroy(Request $request, $id){
        $contato = Contato::find($id);

        if($contato == null){
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        
        
        }
        $telDeletado = false;
        
        if($request->has('filtro')){
            $telefones = Telefone::where('contato_id', $contato->id)->get();
            
            foreach($telefones as $key => $telefone){
                if($telefones[$key]->id == $request->filtro){
                    $tel = Telefone::find($telefones[$key]->id);
                    $tel->delete();
                    $telDeletado = true;
                }
            }
        }else{
            return response()->json(['erro' => 'É necessário indicar o id do telefone a ser deletado']);
        }

        if(!$telDeletado){
            return response()->json(['erro' => 'É necessário fornecer um id de telefone que pertença ao contato']);
        }
    }
}
