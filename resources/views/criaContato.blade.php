@extends("main")

@section("corpo")

<div class="p-3">

<a href="/" class="btn btn-success"> <i class="fas fa-arrow-left"></i> Voltar Para Lista de Contatos </a>

</div>

<div class="row">
<div class="col-md-4">
 </div>
 <div class="col-md-4">

<div>
    <label>Nome do Contato  <i style="color:red" class="fas fa-asterisk"></i> </label>
   <div> <input name="nome" id="nome" class="form-control form-control-sm"> </div>
</div>


<div>
   <label>Celular <i style="color:red"  class="fas fa-asterisk"></i> </label>
   <input id="celular1" class="form-control celular">
</div>

<div id="camposNovos">

</div>

<div style="text-align:center" class="p-2" >
 
 <div> <button onclick="abrirJanelaNovoCampo()" class="btn btn-light">  adicionar novo campo </button> </div>

</div>

<div>
   <div class="input-group">
   <input id="cep" placeholder="digite o cep para inserir um endereço" class="form-control">

   <div class="input-group-append">
    <button onclick="autocompletarEndereco()"  class="btn btn-primary" type="button">buscar</button>
  </div>
   </div>
</div>

<div> <span>Logradouro:</span> <span id="logradouro"></span></div> 
<div> <span>bairro:</span> <span id="bairro"></span> </div>
<div> <span>localidade:</span> <span id="localidade"></span> </div>

<div>  <span>uf:</span>  <span id="uf"></span><div> 

<div style="text-align:center" class="p-2">
  <button onclick="salvarContato()" class="btn btn-success" > <i class="fa fa-check" aria-hidden="true"></i>
 adicionar novo contato</button>
</div>
</div>
 <div class="col-md-4">
 </div>
</div>

<div class="modal fade" id="modalNovoContato" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Novo Campo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div onclick="adicionarNovoCampo(event)" class="modal-body">
        
        <div id="novoCelular"> Celular </div>
        <div id="novoTelefoneFixo"> Telefone Fixo </div>
        <div id="novoEmail">E-mail </div>

      </div>
     
    </div>
  </div>
</div>



@section("scriptsPagina")

<script>


let ordemTelefone = 1;
     let ordemCelular = 2;

$('.celular').mask('00 00000-0000', null);
$('.telefoneFixo').mask('00 0000-0000', null);


function abrirJanelaNovoCampo(){

     $('#modalNovoContato').modal();

}

function adicionarNovoCampo(event){




     let tipoCampo = event.target.id;
  

     if(tipoCampo == "novoCelular"){
         $("#camposNovos").append("<div><label>celular</label><input class='form-control'></div>");
     }
     if(tipoCampo == "novoTelefoneFixo")
     {
        $("#camposNovos").append(`<div><label>telefone </label><input name='telefone${ordemTelefone}' class='form-control telefoneFixo'></div>`);
       
        $(`input[name=telefone${ordemTelefone}`).mask('00 0000-0000', null);
        ordemTelefone += 1;
     }
     if(tipoCampo == "novoEmail"){
        $("#camposNovos").append(`<div><label>Email</label><input name='email${ordemTelefone}' class='form-control email'></div>`);

     }


     $('.celular').mask('00 00000-0000', null);


     $('#modalNovoContato').modal('toggle');

}


  function salvarContato(){


    if($('#nome').val() == ''){

$('#nome').css('border-color', 'red');
return false;
}
if($('#celular1').val() == ''){

$('#celular1').css('border-color', 'red');
return false;
}

      let nome = $('#nome').val();
      let inputsTelefones = $('.telefoneFixo');
      let inputsCelulares = $('.celular');
      let inputsEmails = $('.email');


      let telefones = [];
      let celulares = [];
      let emails = [];
      var endereco = new Object();

      endereco.logradouro = $('#logradouro').text();
      endereco.bairro = $('#bairro').text();
      endereco.localidade = $('#localidade').text();
      endereco.uf = $('#uf').text();



      for(let i = 0; i < inputsTelefones.length; i++){

         telefones.push($(inputsTelefones[i]).val());

      }

      for(let i = 0; i < inputsCelulares.length; i++){

celulares.push($(inputsCelulares[i]).val());

}

for(let i = 0; i < inputsEmails.length; i++){

emails.push($(inputsEmails[i]).val());

}



      $.ajax({
         url:  urlBackend + 'contatos',
         method: 'POST',
         contentType: 'application/json; charset=utf-8',
          
         data: JSON.stringify({ nome: nome, celulares: celulares, emails: emails,  telefones: telefones, endereco: endereco }),
         success: function(){
             window.location = "http://localhost:8000/contatos";
         }
      });


  }

 
  


</script>
@stop

@stop