<!-- Estrutura -->
<div class="container">
				
    <?php
        $atributos = array('form class'=>'well form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
        echo form_open('analise/listAll', $atributos); 
    ?>
    </form>


    <div class="" id="evolucao_marca" style="min-width: 400px; height: 400px; margin: 0 auto"></div>    






<script type="text/javascript">
    $(function () {
        $('#evolucao_marca').highcharts({
            chart: {
                zoomType: 'xy'
            },
            title: {
                text: 'Evolução Marca'
            },
            subtitle: {
                text: 'Arraste o mouse nos meses desejados'
            },
            xAxis: [{
                categories: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
                    'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro']
            }],
            yAxis: [{ // Primary yAxis
                labels: {
                    format: '{value} ',                
                    style: {
                        color: '#89A54E'
                    }
                },
                title: {
                    text: 'FOB',
                    style: {
                        color: '#89A54E'
                    }
                }
            }, { // Secondary yAxis
                title: {
                    text: 'Unidades',
                    style: {
                        color: '#4572A7'
                    }
                },
                labels: {
                    style: {
                        color: '#4572A7'
                    }
                },
                opposite: true
            }],
            tooltip: {
                shared: true,
                valueDecimals: 2,
                valuePrefix: '$',
                valueSuffix: ''                 
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                x: 120,
                verticalAlign: 'top',
                y: 100,
                floating: true,
                backgroundColor: '#FFFFFF'
            },
            series: [{
                name: 'Unidades',
                color: '#4572A7',
                type: 'column',
                yAxis: 1,
                
                data: [{unidades}], 
                
                tooltip: {
                shared: true,
                valueDecimals: 0,
                valuePrefix: '',
                valueSuffix: '' 
                }
    
            }, {
                name: 'FOB',
                color: '#89A54E',
                type: 'spline',
                
                data: [{fob}],


                tooltip: {
                    valueSuffix: ''
                }
            }]
        });
    });
</script>


