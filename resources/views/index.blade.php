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

<body class="bg-light text-primary">
    <header class="d-flex w-100 mx-0">
        <div class="uady-logo-container bg-light">
            <img class="rounded mx-auto d-block mt-2" width="100px" src="{{URL::asset('assets/logouady.png')}}">
        </div>
        <div class="top-bar container-lg d-flex mw-100 mx-0 justify-content-between align-items-center bg-primary text-light">
            <h5 class="pt-2 hdln-5">Universidad Autónoma de Yucatán</h5>
        </div>
    </header>

    <main>
        <div class="container mb-3">
            <!-- Grid container-->
            <div class="row">
                <div class="col">
                    <form class="col needs-validation" id="fileForm" action="{{ route('harvest_url') }}" method="get">
                        <h4 class="border-bottom border-warning">Validador de Metadatos</h4>
                        <div class="mb-5 has-validation">
                            <label for="floatingInput">
                                <h5>OAI-PMH</h5>
                            </label>
                            <input type="url" class="form-control" name="urlXML" placeholder="Ejemplo: http://redi.uady.mx/oai/request" required>
                            <button type="submit" class="btn btn-warning float-right mt-3">Comprobar</button>
                        </div>
                    </form>
                    <form class="col needs-validation" id="urlXMLValidator" action="{{ route('validate_xml') }}" method="post">
                        @csrf
                        <div class="mb-5">
                            <label for="xmlTextArea" class="form-label">
                                <h5>Validar XML</h5>
                            </label>
                            <textarea name="xmlInput" class="form-control" id="xmlTextArea" rows="7"></textarea>
                            <button type="submit" class="btn btn-warning float-right mt-3">Comprobar</button>
                        </div>
                    </form>
                </div>
                @yield('generalSumary')
            </div>
        </div>
        @yield('tableResults')
    </main>
    <script src="{{asset('js/app.js')}}"></script>
</body>

</html>