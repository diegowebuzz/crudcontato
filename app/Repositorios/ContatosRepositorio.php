<?php

namespace App\Repositorios;


interface ContatosRepositorio
{
    public function recuperarContatos();

    public function adicionarContato($atributos);
     
    public function recuperarContato($id);

    public function removerContato($id);

    public function atualizarContato($id, $atributos);



}