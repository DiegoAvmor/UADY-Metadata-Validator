@extends('index')
@include('modal')
@include('chart')

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
        <h5 class="mt-3 text-center text-warning" id="percentResults">
            {{ number_format($data->generalQualityStatistics->averageSuccess,2)}}%
            <button type="button" class="btn btn-primary-outline" data-toggle="modal" data-target="#chartModal">
                <i class="fas fa-chart-line"></i>
            </button>
        </h5>
        @yield('chart_modal')
        <h6 class="text-center text-dark">Datos Correctos</h6>
    </div>
    <div>
        <table class="table">
        <thead class="text-center">
            <tr>
                <th scope="col">Número de metadatos correctos</th>
                <th scope="col">Número de metadatos incorrectos</th>
            </tr>
        </thead>
        <tr>
            <td class="text-center">{{$data->generalQualityStatistics->successNumber}}</td>
            <td class="text-center">{{$data->generalQualityStatistics->errorNumber}}</td>
        </tr>
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
                <th scope="col">Estatus</th>
                <th scope="col">Tipo<i class="fas fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="
                    M (Obligatorio)<br>
                    MA (Obligatorio cuando aplique)<br>
                    R (Recomendado)<br>
                    O (Opcional)"></i></th>
                <th scope="col">Reglas Cumplidas</th>
                <th scope="col">Ver Más</th>
            </tr>
        </thead>
        @foreach ($data->statistics as $ruleKeyName => $qualityResult)
        <tr>
            <td class="text-center">{{$ruleKeyName}}</td>
            <td class="text-center">{{$qualityResult->data['tag']}}</td>
            <td class="text-center">{!! $qualityResult->generalStatus ? '<i class="fas fa-check-circle text-success"></i>' : '<i class="fas fa-exclamation-circle text-danger"></i>' !!}</td>
            <td class="text-center">{{$qualityResult->data['ruleType']}}</td>
            <td class="text-center">{{$qualityResult->numValid ."/". $qualityResult->total}}</td>
            <td class="text-center">
                <!-- Button trigger modal -->
                @php
                    $errorMessages = array();
                    $url_recursos = array();
                    foreach($qualityResult->rejectMessages as $key => $errorMessage){
                        array_push($errorMessages, $errorMessage->message);
                        array_push($url_recursos, $errorMessage->id);
                    }
                @endphp
                <button type="button" class="btn btn-primary-outline modalInformation" data-toggle="modal" data-target="#metadataModal"
                value='{    
                    "ruleKeyName" : "{{ $ruleKeyName }}", 
                    "description" : "{{ $qualityResult->data['description'] }}",
                    "rejectMessages" : "{{ !empty($qualityResult->rejectMessages) ? implode(",", $errorMessages)  : "" }}",
                    "url" : "{{ !empty($qualityResult->rejectMessages) ? implode(",", $url_recursos)  : ""  }}"
                }'>
                    <i class="fas fa-ellipsis-h" aria-hidden="true"></i>
                </button>
                @yield('modal_layout')
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endisset
@endsection
<!-- table section -->
@endsection
<!-- complete results section -->