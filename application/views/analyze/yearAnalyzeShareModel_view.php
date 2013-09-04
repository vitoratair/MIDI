<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
    <div class="container">
        <h1 class="pull-left">Exibição <small>de {valor} modelos de {categoriaNome}, marca {marcaNome}</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li><a href="#" onclick="enviar(1)" >Análise</a> <span class="divider"> / </span></li>
            <li class="active">Análise por ano</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->

<!-- Estrutura -->
<div class="container">

    <div id="participacao_de_mercadoPeca" style="min-width: 700px; height: 600px; margin: 0 auto"></div>    

</div>


	<!-- Java scrip para criação do gráfico -->
		
<script type="text/javascript">         
$(function () {
        // Build the chart
        $('#participacao_de_mercadoPeca').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Análise de importação'
            },
            subtitle:{
              text: '{marcaNome}'  
            },
            tooltip: {
                pointFormat: "Value: {point.y:,.0f}"             
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    showInLegend: true,
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2) +'%';
                        }
                    }
                }
                
            },
            series: [{
                type: 'pie',
                name: 'Unidades importadas',

                data: [

                      {dados}
                ]
            }]
        });
    });
</script>


<script type="text/javascript">
    function enviar(id)
    {              
        if (id == 1)
        {
            var url = '<?php echo base_url();?>index.php/analyze/analyzeModel';
            var form = $('<form action="' + url + '" method="POST">' +                              
                '<input type="hidden" name="categoria" value="' + {categoria} + '" />' +
                '<input type="hidden" name="ano" value="' + {ano} + '" />' +    
                '<input type="hidden" name="marca" value="' + {marca} + '" />' +
                '<input type="hidden" name="subcategorias" value="' + {postSubcategorias} + '"/>' +
              '</form>');
            $('body').append(form);
            $(form).submit();
        }      

    }
</script>