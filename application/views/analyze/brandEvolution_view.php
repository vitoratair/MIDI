<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
    <div class="container">
        <h1 class="pull-left"><small></small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li><a href="#" onclick="enviar()" >Análise</a> <span class="divider"> / </span></li>
            <li class="active">Análise por ano</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->


<!-- Estrutura -->
<div class="container">	

	<div class="" id="evolucao_marca" style="min-width: 400px; height: 400px; margin: 0 auto"></div>

</div>
		

<!-- Java script para botão voltar -->
<script type="text/javascript">
    
    function enviar()
    {
        var url = '<?php echo base_url();?>index.php/analyze/yearAnalyze';
        var form = $('<form action="' + url + '" method="POST">' +
            '<input type="hidden" name="categoria" value="' + {categoria} + '" />' +
            '<input type="hidden" name="ano" value="' + {ano} + '" />' +
              '<input type="hidden" name="dataInicial" value="' + <?php echo $dataInicial;?> + '" />' +
              '<input type="hidden" name="dataFinal" value="' + <?php echo $dataFinal;?> + '" />' +              
            '<input type="hidden" name="subcategorias" value="' + {sc} + '" />' +
            '</form>'); 
        $('body').append(form);
        $(form).submit();
    }      
</script>

<!-- Java scrip para criação do gráfico -->
<script type="text/javascript">
    $(function () {
        $('#evolucao_marca').highcharts({
            chart: {
                zoomType: 'xy'
            },
            title: {
                text: 'Análise de importações'
            },
            subtitle: {
                text: '{marcaNome} - {ano}'
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

<br><br>



