@extends("main")


@section("corpo")

<div class="p-3">

    <a href="/" class="btn btn-success"> <i class="fas fa-arrow-left"></i> Voltar Para Lista de Contatos </a>

</div>

<div class="row">

    <div class="col-md-4 "></div>

    <div class="col-md-4">

        <div>
            <span class="font-weight-bold"> Nome: </span> <span id="nome"></span>
        </div>
        <div>
            <span class="font-weight-bold"> Telefones: </span> <i class="fas fa-phone-alt"></i>
            <div id="telefones">

            </div>
        </div>
        <div>
            <span class="font-weight-bold"> Celulares: </span> <i class="fas fa-mobile-alt"></i>
            <div id="celulares">

            </div>
        </div>
        <div>
            <span class="font-weight-bold"> EMails: </span> <i class="fas fa-at"></i>
            <div id="emails">

            </div>

            <span class="font-weight-bold"> Endereço: </span> <i class="fas fa-map-marker-alt"></i>

            <div id="endereco">

                <div><span class="font-weight-bold"> Logradouro: </span> <span id="logradouro"></span></div>
                <div> <span class="font-weight-bold"> Bairro: </span> <span id="bairro"></span></div>

                <div><span class="font-weight-bold"> UF: </span> <span id="uf"></span></div>

                <div><span class="font-weight-bold"> Localidade: </span> <span id="localidade"></span></div>


            </div>

        </div>

        <div> <a onclick="navegarEditar()" class="btn btn-warning"> Editar Contato </a> </div>

        <div> <button onclick="removerContato()" class="btn btn-danger"> Remover Contato </button> </div>

    </div>

    <div class="col-md-4"></div>

</div>




@section("scriptsPagina")

<script>
    let searchParams = new URLSearchParams(window.location.search)
    let param = searchParams.get('id')


    $(document).ready(function() {




        $.ajax({
            url: urlBackend + 'contatos/' + param
            , method: 'GET'
            , success: function(data) {
                $('#nome').text(data.nome);

                console.log(data);

                for (let i = 0; i < data.telefones.length; i++) {

                    $('#telefones').append(`<div>${data.telefones[i].numero}</div>`)
                }

                for (let i = 0; i < data.celulares.length; i++) {

                    $('#celulares').append(`<div>${data.celulares[i].numero}</div>`)
                }

                for (let i = 0; i < data.emails.length; i++) {

                    $('#emails').append(`<div>${data.emails[i].endereco}</div>`)
                }

                console.log(data.enderecos);

                $('#logradouro').text(data.enderecos.logradouro);
                $('#uf').text(data.enderecos.uf);

                $('#localidade').text(data.enderecos.localidade);

                $('#bairro').text(data.enderecos.bairro);


            }
            , error: function() {
            }

        });

    });


    function removerContato() {

        $.ajax({
            url: urlBackend + 'contatos/' + param
            , method: 'DELETE'
            , success: function(data) {

                window.location = "http://localhost:8000";

            }
        });

    }


    function navegarEditar() {

        window.location = "/editar-contato?id=" + param;

    }

</script>
@stop
@stop
