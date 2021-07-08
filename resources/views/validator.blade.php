@extends('index')

@section('generalSumary')
@isset($data)
<div class="col ml-5 pl-5">
    <!-- verify the padding tho -->
    <div>
        <h4>Resultados</h4>
        @if (isset($connectionErrors))
        <ol class="list-group list-group-numbered">
            <li class="list-group-item"><i class="fas fa-check-circle text-success"></i>Conexión Extablecida</li>
            <li class="list-group-item"><i class="fas fa-exclamation-circle text-danger"></i>Comprobación de XML</li>
            <li class="list-group-item"><i class="fas fa-exclamation-circle text-danger"></i>Contenido del XML verificado</li>
            <li class="list-group-item"><i class="fas fa-exclamation-circle text-danger"></i>Metadatos Listados</li>
        </ol>
        @else
        <ol class="list-group list-group-numbered">
            <li class="list-group-item"><i class="fas fa-check-circle text-success"></i>Conexión Extablecida</li>
            <li class="list-group-item"><i class="fas fa-check-circle text-success"></i>Comprobación de XML</li>
            <li class="list-group-item"><i class="fas fa-check-circle text-success"></i>Contenido del XML verificado</li>
            <li class="list-group-item"><i class="fas fa-check-circle text-success"></i>Metadatos Listados</li>
        </ol>
        @endif
    </div>
    <div class="border-bottom border-warning">
        <h5 class="mt-5 text-center">Resultados de Validación de Datos</h5>
        <h5 class="mt-3 text-center text-warning" id="percentResults">{{ number_format($data->averageSuccess,2)}}%</h5>
        <h6 class="text-center text-dark">Datos Correctos</h6>
    </div>
    <div>
        <table class="table">
            @foreach ($data->statistics as $ruleKeyName => $qualityResult)
            @if($loop->iteration < 5) <tr>
                <td>{{$ruleKeyName}}</td>
                <td>
                    @if ($qualityResult->generalStatus)
                    <i class="fas fa-exclamation-circle text-danger"></i>Error
                    @else
                    <i class="fas fa-check-circle text-success"></i>Correcto
                    @endif
                </td>
                </tr>
                @endif
                @endforeach
        </table>
        <button type="button" class="btn btn-warning px-4 float-right" id="showBtton">Ver Detalles</button>
    </div>
</div>
@endisset

@section('tableResults')
<!-- table details section -->
@isset($data)
<div class="m-5" id="tableContainer">
    <h3 class="border-bottom border-warning">Más Detalles</h3>
    <table class="table">
        <thead class="text-center">
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Tag</th>
                <th scope="col">Tipo<i class="fas fa-info-circle" data-bs-toggle="tooltip"></i></th>
                <th scope="col">Reglas Cumplidas</th>
                <th scope="col">Ver Más</th>
            </tr>
        </thead>
        @foreach ($data->statistics as $ruleKeyName => $qualityResult)
        <tr>
            <td class="text-center">{{$ruleKeyName}}</td>
            <td class="text-center">{{$qualityResult->data['tag']}}</td>
            <td class="text-center">{{$qualityResult->data['ruleType']}}</td>
            <td class="text-center">{{$qualityResult->numValid ."/". $qualityResult->total}}</td>
            <td class="text-center"><i class="fab fa-get-pocket"></i></td>
        </tr>
        @endforeach
    </table>
</div>
@endisset
@endsection
<!-- table section -->
@endsection
<!-- complete results section -->