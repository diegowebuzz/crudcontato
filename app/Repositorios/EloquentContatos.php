<?php

namespace App\Repositorios;

use App\Models\Celular;
use App\Models\Contato;
use App\Models\Email;
use App\Models\Endereco;
use App\Models\Telefone;
use stdClass;

class EloquentContatos implements ContatosRepositorio
{
   
    private $contato;
    private $telefone;
    private $celular;
    private $email;
    private $endereco;

     public function __construct(Contato $contato, Email $email, Telefone $telefone, Celular $celular, Endereco $endereco){


        $this->contato = $contato;
        $this->telefone = $telefone;
        $this->celular = $celular;
        $this->email = $email;
        $this->endereco = $endereco;


     }

 
    public function recuperarContatos(){

        return $this->contato::with('telefones')->with('celulares')->with('emails')->with('enderecos')->get();


    }

    public function adicionarContato($atributos){


        $contato = new stdClass;
        $contato->nome = $atributos["nome"];

        $contato_db = new Contato();

        $contato_db->nome = $contato->nome;

        $contato_db->save();

        $endereco = new Endereco();

        $endereco->logradouro = $atributos["endereco"]["logradouro"];
        $endereco->bairro = $atributos["endereco"]["bairro"];
        $endereco->uf = $atributos["endereco"]["uf"];
        $endereco->localidade = $atributos["endereco"]["localidade"];
        $endereco->id_contato = $contato_db->id;

        $endereco->save();


         for($i = 0; $i <  count($atributos["telefones"]); $i++){

            $telefone = new Telefone();
            $telefone->id_contato = $contato_db->id;
            $telefone->numero = $atributos["telefones"][$i];
            $telefone->save();

         }


         for($i = 0; $i <  count( $atributos["celulares"]); $i++){

           $celular = new Celular();
           $celular->id_contato = $contato_db->id;
           $celular->numero = $atributos["celulares"][$i];
           $celular->save();

        }

        for($i = 0; $i <  count($atributos["emails"]); $i++){

           $email = new Email();
           $email->id_contato = $contato_db->id;
           $email->endereco = $atributos["emails"][$i];
           $email->save();

        }




    }
     
    public function recuperarContato($id){

   return $this->contato::with('telefones')->with('celulares')->with('emails')->with('enderecos')->find($id);


    }

    public function removerContato($id){

        $contato = $this->contato::find($id);


        $contato->delete();
        $this->telefone::where('id_contato', $id)->delete();
        $this->celular::where('id_contato', $id)->delete();
        $this->email::where('id_contato', $id)->delete();
        $this->endereco::where('id_contato', $id)->delete();

    }

    public function atualizarContato($id, $atributos){


        $contato = Contato::find($id);
        $this->telefone::where('id_contato', $id)->delete();
        $this->celular::where('id_contato', $id)->delete();
        $this->email::where('id_contato', $id)->delete();
        $this->endereco::where('id_contato', $id)->delete();

        


        $contato_db =  $this->contato::find($id);

        $contato_db->nome = $atributos["nome"];

        $contato_db->save();

        $endereco = new Endereco();

        $endereco->logradouro = $atributos["endereco"]["logradouro"];
        $endereco->bairro = $atributos["endereco"]["bairro"];
        $endereco->uf = $atributos["endereco"]["uf"];
        $endereco->localidade = $atributos["endereco"]["localidade"];
        $endereco->id_contato = $contato_db->id;

        $endereco->save();

       
         for($i = 0; $i <  count($atributos["telefones"]); $i++){

            $telefone = new Telefone();
            $telefone->id_contato = $contato_db->id;
            $telefone->numero = $atributos["telefones"][$i];
            $telefone->save();

         }

       


         for($i = 0; $i <  count($atributos["celulares"]); $i++){

           $celular = new Celular();
           $celular->id_contato = $contato_db->id;
           $celular->numero = $atributos["celulares"][$i];
           $celular->save();

        }

        for($i = 0; $i <  count($atributos["emails"]); $i++){

           $email = new Email();
           $email->id_contato = $contato_db->id;
           $email->endereco = $atributos["emails"][$i];
           $email->save();

        }

    }

}