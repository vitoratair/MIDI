<!-- Estrutura -->
<div class="container">
                
    <?php
        $atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'align' => 'right', 'method'=>'POST');
        echo form_open('analise/analiseModelo   ', $atributos); 
    ?>

    <input type="hidden" name="categoria" value="{categoria}">
    <input type="hidden" name="ano" value="{ano}">
    <input type="hidden" name="subcategorias" value="{postSubcategorias}">
    <input type="hidden" name="marca" value="{marca}">

    <button type="submit" class="btn"><i class="icon-arrow-left"></i> Voltar</button>
    </form>

    <div class="" id="participacao_de_mercadoPeca" style="min-width: 800px; height: 700px; margin: 0 auto"></div>    




<!--
    +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
-->

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