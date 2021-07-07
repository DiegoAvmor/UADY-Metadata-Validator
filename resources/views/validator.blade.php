@extends('index')
@section('generalSumary')

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
        <h5 class="mt-3 text-center text-warning" id="percentResults">60%</h5>
        <h6 class="text-center text-dark">Datos Correctos</h6>
    </div>
    <table class="table">
        <tr>
            <td>dc:title</td>
            <td><i class="fas fa-check-circle text-success"></i>Correcto</td>
        </tr>
        <tr>
            <td>Creator</td>
            <td><i class="fas fa-check-circle text-success"></i>Correcto</td>
        </tr>
        <tr>
            <td>info:eu-repo</td>
            <td><i class="fas fa-exclamation-circle text-danger"></i>Error</td>
        </tr>
    </table>
    <div class="row">
        <button type="button" class="btn btn-warning offset-md-10 px-4">Ver más</button>
    </div>
</div>

@section('tableResults')
<!-- More details section -->
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
        <tr>
            <td>dc:title</td>
            <td></td>
            <td></td>
            <td class="text-center"><i class="fab fa-get-pocket"></i></td>
        </tr>
        <tr>
            <td>Creator</td>
            <td></td>
            <td></td>
            <td class="text-center"><i class="fab fa-get-pocket"></i></i></td>
        </tr>
        <tr>
            <td>info:eu-repo</td>
            <td></td>
            <td></td>
            <td class="text-center"><i class="fab fa-get-pocket"></i></i></td>
        </tr>
    </table>
</div>
@endsection

@endsection