@section('chart_modal')
<!-- Modal for Charts -->
    <div class="modal fade" id="chartModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-100 w-75">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Desglose del Porcentaje Obtenido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="tabpanel">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="line-tab" href="#line" aria-selected="true" data-toggle="tab">
                                    <small>Gráfico Acumulativo</small>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="bar-tab" href="#bar" aria-selected="false" data-toggle="tab">
                                    <small>Gráfico de Barras</small>
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="line" role="tabpanel" aria-labelledby="line-tab">
                            <canvas id='lineCanvas'></canvas>
                        </div>
                        <div class="tab-pane fade" id="bar" role="tabpanel" aria-labelledby="bar-tab">
                            <canvas id='barCanvas'></canvas>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('chart_script')
    <!-- Scripts for Charts -->
    <script>
        @isset($data)
        const info = @json($data);
        
        var tagNames = [];
        var obtainedQuality = [], perfectQuality = [], barQuality = [];
        var validValue = [], tagValue = [];
        var reachValue = 0, perfectValue = 0;

        for( const tagName in info.statistics) {
            tagNames.push(tagName);

            var totalValue = info.statistics[tagName].total;
            validValue[tagName] = info.statistics[tagName].numValid;
            tagValue[tagName] = info.statistics[tagName].data.qualityTagValue;

            reachValue += tagValue[tagName] * validValue[tagName];
            perfectValue += tagValue[tagName] * totalValue;
            
            barQuality.push(validValue[tagName] * tagValue[tagName]);
            obtainedQuality.push(reachValue);
            perfectQuality.push(perfectValue);
        };

        var obtainedChart = {
            type: 'line',
            label: "Puntaje Acumulado",
            data: obtainedQuality,
            borderColor: 'rgba(0, 99, 132, 1)',
            backgroundColor: 'rgba(0, 99, 132, 0.5)',
            fill:true
        };

        var perfectChart = {
            type: 'line',
            label: "Puntaje Esperado",
            data: perfectQuality,
            borderColor: 'gray',
            fill: true
        };

        Chart.defaults.font.family = 'uadyFont';
        Chart.defaults.font.size = 12;

        var linectx = document.getElementById('lineCanvas');
        var lineChart = new Chart(linectx, {
            data: {
                labels: tagNames,
                datasets: [obtainedChart, perfectChart]
            }
        });
        
        const tooltipBar = (tooltipItems) => {
            let tagName;

            tooltipItems.forEach(function(tooltipItem) {
                tagName = tooltipItem.label;
            });

            return (
                'Valor del Tag: ' + tagValue[tagName] + '\n' +
                'Número de Tags Correctos: ' + validValue[tagName]
            );
        };

        var barctx = document.getElementById('barCanvas');
        var barChart = new Chart(barctx, {
            type: 'bar',
            data: {
                labels: tagNames,
                datasets: [{
                    label: 'Puntaje Obtenido',
                    data: barQuality,
                    backgroundColor: 'rgba(199,147,22,.5)',
                    borderColor: 'rgba(199,147,22,1)',
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    tooltip: {
                        callbacks: {
                            beforeBody: tooltipBar
                        }
                    }
                }
            }
        });

        @endisset
    </script>
@endsection
    