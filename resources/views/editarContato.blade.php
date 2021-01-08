@extends("main")

@section("corpo")
<div class="row">

    <div class="col-md-4"></div>
    <div class="col-md-4">

        <div>
            <input id="nome" name="name">
        </div>
        Telefones
        <div id="telefones">
        </div>

        celulares
        <div id="celulares">
        </div>


        EMails
        <div id="emails">
        </div>

        Endereço
        <div id="endereco">


            <div><input onchange="autocompletarEndereco(event)"></div>
            <div>
                <div> <span>Logradouro:</span> <span id="logradouro"></span></div>
                <div> <span>bairro:</span> <span id="bairro"></span> </div>
                <div> <span>localidade:</span> <span id="localidade"></span> </div>

                <div> <span>uf:</span> <span id="uf"></span>
                    <div>
                    </div>


                </div>



                <div>
                    <button id="btnSalva" class="btn btn-warning"> <i class="far fa-save"></i> salvar alterações </button>
                </div>

            </div>
            <div class="col-md-4"></div>


        </div>

        @stop

        @section("scriptsPagina")

        <script>
            let searchParams = new URLSearchParams(window.location.search)
            let param = searchParams.get('id')



            $(document).ready(function() {


                $('#btnSalva').click(salvarAlteracoes);

                $.ajax({

                    url: urlBackend + "contatos/" + param
                    , method: 'GET'
                    , success: function(data) {

                        console.log(data);

                        $('#nome').val(data.nome);


                        $('#logradouro').text(data.enderecos.logradouro);
                        $('#bairro').text(data.enderecos.bairro);
                        $('#localidade').text(data.enderecos.localidade);
                        $('#uf').text(data.enderecos.uf);



                        for (let i = 0; i < data.telefones.length; i++) {

                            $('#telefones').append(`<div><input value="${data.telefones[i].numero}" class="telefoneFixo"></div>`)

                        }

                        for (let i = 0; i < data.celulares.length; i++) {

                            $('#celulares').append(`<div><input value="${data.celulares[i].numero}" class="celular"></div>`)

                        }

                        for (let i = 0; i < data.emails.length; i++) {

                            $('#emails').append(`<div><input value="${data.emails[i].endereco}" class="email"></div>`)

                        }



                    }

                });
            });


            function salvarAlteracoes() {


                let nome = $('#nome').val();
                let endereco = new Object();
                let inputsTelefones = $('.telefoneFixo');
                let inputsCelulares = $('.celular');
                let inputsEmails = $('.email');
                let telefones = [];
                let celulares = [];
                let emails = [];

                endereco.logradouro = $('#logradouro').text();
                endereco.bairro = $('#bairro').text();
                endereco.localidade = $('#localidade').text();
                endereco.uf = $('#uf').text();






                for (let i = 0; i < inputsTelefones.length; i++) {

                    telefones.push($(inputsTelefones[i]).val());

                }

                for (let i = 0; i < inputsCelulares.length; i++) {

                    celulares.push($(inputsCelulares[i]).val());

                }

                for (let i = 0; i < inputsEmails.length; i++) {

                    emails.push($(inputsEmails[i]).val());

                }


                let data = {
                    nome: nome
                    , telefones: telefones
                    , celulares: celulares
                    , emails: emails
                    , endereco: endereco
                };


                $.ajax({
                    url: urlBackend + "contatos/" + param
                    , method: 'POST'
                    , contentType: 'application/json; charset=utf-8',

                    data: JSON.stringify(data)
                    , success: function(data) {
                 
                           window.location =   "http://localhost:8000/detalhes-contato?id=" + param;

                    }
                });


            }

        </script>

        @stop
