@extends("main")

@section("corpo")

<div class="p-4 bg-primary d-none d-sm-block">
    <div>
        <a class="btn btn-success" href="/criar-contato">Adicionar Novo Contato</a>
    </div>
</div>

<div class="row">
    <div class="col-md-4 col-1"></div>
    <div class="col-md-4 col-10">

        <div id="contatos"> <!-- os contatos são exibidos aqui -->
        </div>

    </div>
    <div class="col-md-4 col-1"></div>
</div>


<div style="position:fixed; background-color:white; right:5px; bottom:5px" class="d-md-none">
  <a href="/criar-contato"> <img class="rounded-circle; " style="width:50px;"   src="https://lh3.googleusercontent.com/proxy/M9zt7xlHrFViXais1HQM-LrFIOzYVjaOaqmuuXJu6Kn-K8NJFMvxDot-AQu2dbfk9MMLlapLsYxVaQo5PgcNn2wVlqpCghY"> </a>
</div>

@section("scriptsPagina")

<script>
    $(document).ready(function() { //recupera os contatos via API

        $.ajax({
            url: urlBackend + 'contatos'
            , method: 'GET'
            , success: function(data) {

                for (let i = 0; i < data.length; i++) {

                    $('#contatos').append(`<a href="/detalhes-contato?id=${data[i].id}"> <div class="row bg-light pb-2 align-center-content"><div class="col-md-2 col-2"><img class="img-fluid rounded-circle" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQd22iP4PpHmLceusDiDDk2hiyUis379soeNA&usqp=CAU"> </div> <div class="col-md-10 col-10 text-center pt-2">${data[i].nome}</div>  </div></a>`);

                }

            }
        });

    });

</script>
@stop

@stop
