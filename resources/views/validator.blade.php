@extends('index')
@include('modal')
@include('chart')

@section('generalSumary')
@php
    if(isset($data)){
        $percentResult = number_format($data->generalQualityStatistics->averageSuccess,2);
        $successNumber = $data->generalQualityStatistics->successNumber;
        $errorNumber = $data->generalQualityStatistics->errorNumber;
        $buttonType = "fas fa-check-circle text-success";
    }

    if(isset($error)){
        $percentResult = " -- ";
        $successNumber = "0";
        $errorNumber = "0";
        $buttonType = "fas fa-exclamation-circle text-danger";
    }
@endphp
<div class="col ml-5 pl-5">
    <!-- verify the padding tho -->
    <div>
        <h4>Resultados</h4>
        <ol class="list-group list-group-numbered">
            <li class="list-group-item"><i class="fas fa-check-circle text-success"></i>Conexión Establecida</li>
            <li class="list-group-item"><i class="{{$buttonType}}"></i>Comprobación de XML</li>
            <li class="list-group-item"><i class="{{$buttonType}}"></i>Contenido del XML Verificado</li>
            <li class="list-group-item"><i class="{{$buttonType}}"></i>Metadatos Listados</li>
        </ol>
    </div>
    <div class="border-bottom border-warning">
        <h5 class="mt-5 text-center">Resultados de Validación de Datos</h5>
        <h5 class="mt-3 text-center text-warning" id="percentResults">  
            {{$percentResult}}%
            <button type="button" class="btn btn-primary-outline" data-toggle="modal" data-target="#chartModal" @if(!isset($data)) disabled @endif>
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
                <th scope="col">Número de Metadatos Correctos</th>
                <th scope="col">Número de Metadatos Incorrectos</th>
            </tr>
        </thead>
        <tr>
            <td class="text-center">{{$successNumber}}</td>
            <td class="text-center">{{$errorNumber}}</td>
        </tr>
        </table>
        <button type="button" class="btn btn-warning px-4 float-right" id="showBtton" @if(!isset($data)) disabled @endif>Ver Detalles</button>
    </div>
</div>

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