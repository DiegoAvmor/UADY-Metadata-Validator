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

        <div class="container">
            <!-- Grid container-->
            <div class="row">
                <form class="col-6 needs-validation" id="fileForm" action="{{ action('ValidatorController@harvestURL') }}" method="get">
                    <h4 class="border-bottom border-warning">Validador de Metadatos</h4>
                    <div class="my-5 has-validation">
                        <label for="floatingInput">
                            <h5>OAI-PMH</h5>
                        </label>
                        <input type="url" class="form-control" name="urlXML" placeholder="Ejemplo: http://redi.uady.mx/oai/request" required>
                    </div>
                    <div class="mb-3">
                        <label for="xmlTextArea" class="form-label">
                            <h5>Validar XML</h5>
                        </label>
                        <textarea class="form-control" id="xmlTextArea" rows="7"></textarea>
                    </div>
                    <button type="submit" class="btn btn-warning offset-md-9 mt-3">Comprobar</button>
                </form>
                @isset($data)
                <div class="col-5 ml-5 pl-5">
                    <!-- verify the padding tho -->
                    <div>
                        <h4>Resultados</h4>
                        <ol class="list-group list-group-numbered">
                            <li class="list-group-item"><i class="fas fa-check-circle text-success"></i>Conexión Extablecida</li>
                            <li class="list-group-item"><i class="fas fa-exclamation-circle text-danger"></i>Comprobación de XML</li>
                            <li class="list-group-item"><i class="fas fa-exclamation-circle text-danger"></i>Contenido del XML verificado</li>
                            <li class="list-group-item"><i class="fas fa-exclamation-circle text-danger"></i>Metadatos Listados</li>
                        </ol>
                    </div>
                    <div class="border-bottom border-warning">
                        <h5 class="mt-5 text-center">Resultados de Validación de Datos</h5>
                        <h5 class="mt-3 text-center text-warning" id="percentResults">{{ number_format($data->averageSuccess,2)}}%</h5>
                        <h6 class="text-center text-dark">Datos Correctos</h6>
                    </div>
                    <table class="table">
                    @foreach ($data->statistics as $qualityResult)
                        <tr>
                            <td>{{$qualityResult->data['tag']}}</td>
                            <td>
                            @if ($qualityResult->generalStatus)
                            <i class="fas fa-exclamation-circle text-danger"></i>Error
                            @else
                            <i class="fas fa-check-circle text-success"></i>Correcto
                            @endif
                            </td>
                        </tr>
                    @endforeach
                    </table>
                </div>        
                @endisset
            </div>
            <div class="row">
                <button type="button" class="btn btn-warning offset-md-10 px-4">Ver más</button>
            </div>
        </div>
        @isset($data)
        <div class="m-5">
            <h3 class="border-bottom border-warning">Más Detalles</h3>
            <table class="table">
                <thead class="text-center">
                    <tr>
                        <th scope="col">Metadato</th>
                        <th scope="col">Tipo<i class="fas fa-info-circle"></i></th>
                        <th scope="col">Reglas Cumplidas</th>
                        <th scope="col">Ver Más</th>
                    </tr>
                </thead>
                @foreach ($data->statistics as $qualityResult)
                    <tr>
                        <td class="text-center">{{$qualityResult->data['tag']}}</td>
                        <td class="text-center">{{$qualityResult->data['ruleType']}}</td>
                        <td class="text-center">{{$qualityResult->numValid ."/". $qualityResult->total}}</td>
                        <td class="text-center"><i class="fab fa-get-pocket"></i></td>
                    </tr>
                @endforeach
            </table>
        </div>
        @endisset
    </main>
    <script src="{{asset('js/app.js')}}"></script>
</body>

</html>