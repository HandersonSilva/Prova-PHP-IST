<!DOCTYPE html>
<html lang="en" style="background: #f7f8f9;">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>CRUD PHP</title>
        <link
            rel="stylesheet"
            href="{{ url('assets/bootstrap/css/bootstrap.min.css') }}"
        />
        <link rel="stylesheet" href="{{ url('assets/css/style.css') }}" />

    </head>

    <body style="background: #f7f8f9;">
        <div class="container-md conteudo-titulo">
            <h2>Prova PHP IST</h2>
            <h3>
                Projeto realizado com as seguintes tecnologias PHP, Framework laravel, banco de dados MYSQL e Docker
            </h3>
        </div>
        <div class="container-md">
            <div class="row ">
                <div class="col-12 col-md-2 menu-lateral">
                    @include('template.menu_lateral')
                </div>
                <br/>
                <div class="col-12 col-md-10 content">
                    @yield('conteudo')
                </div>
            </div>
        </div>

    </body>

    <script
        src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"
    ></script>
    <script
        src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" crossorigin="anonymous"></script>
    <script src="{{ url('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/js/util.js') }}"></script>
    <script src="{{ url('assets/js/crud.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</html>
