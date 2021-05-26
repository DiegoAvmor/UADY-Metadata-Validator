<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap styles -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Metadata Validator</title>

    <!-- Fontawesome -->
    <script defer src="/node_modules/@fortawesome/fontawesome-free/js/brands.js"></script>
    <script defer src="/node_modules/@fortawesome/fontawesome-free/js/solid.js"></script>
    <script defer src="/node_modules/@fortawesome/fontawesome-free/js/fontawesome.js"></script>
</head>

<body>
    <header class="d-flex w-100 mx-0">
        <div class="uady-logo-container">
            <img class="rounded mx-auto d-block mt-2" width="100px" src="{{URL::asset('assets/logouady.png')}}">
        </div>
        <div class="top-bar container-lg d-flex mw-100 mx-0 justify-content-between align-items-center">
            <h5 class="pt-2 hdln-5">Universidad Autónoma de Yucatán</h5>
            <i class="fas fa-globe"></i>
        </div>
    </header>

    <main class="container">
        <div class="row">
            <div class="col-6">
                <h4 class="border-bottom border-warning">Validador de Metadatos</h4>
                <div class="my-5">
                    <label for="floatingInput"><h5>OAI-PMH</h5></label>
                    <input type="url" class="form-control" id="floatingInput" placeholder="genreric.eprints.org">
                </div>
                <div class="mb-3">
                    <label for="xmlTextArea" class="form-label"><h5>Validar XML</h5></label>
                    <textarea class="form-control" id="xmlTextArea" rows="7"></textarea>
                </div>
                <button type="button" class="btn btn-warning offset-md-9 mt-3">Comprobar</button>
            </div>
            <div class="col-5 ml-5 pt-5 pl-5"> <!-- verify the padding tho -->
                <div>
                    <h4 class="pt-4">Resultados</h4>
                    <ol class="list-group list-group-numbered">
                        <li class="list-group-item"><i class="fas fa-check-circle"></i>Status</li>
                        <li class="list-group-item"><i class="fas fa-exclamation-circle"></i>Content Type</li>
                        <li class="list-group-item"><i class="fas fa-exclamation-circle"></i>metadatos</li>
                    </ol>
                </div>
                <div>
                    <h5 class="mt-5 text-center">Resultados de Validación de Datos</h5>
                    <h5 class="mt-3 text-center text-warning" id="percentResults">60%</h5>
                    <h6 class="text-center text-dark">Datos Correctos</h6>
                </div>
            </div>
        </div>

    </main>
    <script src="{{asset('js/app.js')}}"></script>
</body>

</html>