<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
    <div class="container">
        <h1 class="pull-left">Exibição <small>de {valor} modelos de {categoriaNome}, marca {marcaNome}</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li><a href="<?php echo base_url();?>index.php/analyze/listAll">Análise</a> <span class="divider"> / </span></li>
            <li class="active">Análise por ano</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->

<!-- Estrutura -->
<div class="container">

    <!-- BOTÃO VOLTAR -->
 <!--    <div class="" align="right">
        <?php
            $atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'align' => 'right', 'method'=>'POST');
            echo form_open('analyze/analyzeModel   ', $atributos); 
        ?>
            <input type="hidden" name="categoria" value="{categoria}">
            <input type="hidden" name="ano" value="{ano}">
            <input type="hidden" name="subcategorias" value="{postSubcategorias}">
            <input type="hidden" name="marca" value="{marca}">

            <button type="submit" class="btn-u"><i class="icon-arrow-left"></i> Voltar</button>
        </form>
    </div>

    <hr> 
    -->

    <!-- Range para escolha das peças mínimas por marca -->
<!--     <?php
        $atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'align' => 'left', 'method'=>'POST');
        echo form_open('analyze/yearAnalyzeShareModel', $atributos); 
    ?>

<br>
    
	    <input id="slider" onchange="this.form.submit()" class="slider slider-horizontal slider-track" type="range" min="1" max="{maximo}" step="1" value="{valor}" name="valor" onchange="updateSlider(this.value)">
	    <input type="hidden" name="categoria" value="{categoria}">
	    <input type="hidden" name="ano" value="{ano}">
	    <input type="hidden" name="subcategorias" value="{postSubcategorias}">
	    <input type="hidden" name="marca" value="{marca}">
    </form>
    <br>
     -->
    <div id="participacao_de_mercadoPeca" style="min-width: 800px; height: 700px; margin: 0 auto"></div>    
</div>
	<!-- Java scrip para criação do gráfico -->
<script type="text/javascript">			
$(function () {
		// Build the chart
        $('#participacao_de_mercadoPeca').highcharts(
        {
            chart:
            {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title:
            {
                text: 'Análise de importação'
            },
            subtitle:
            {
	          text: {marcaNome}  
            },
            tooltip:
            {
	            pointFormat: "Value: {point.y:,.0f}"	         
            },
            plotOptions:
            {
                pie:
                {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    showInLegend: true,
                    dataLabels:
                    {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2) +'%';
                        }
                    }
                }                
            },
            series:[
            {
                type: 'pie',
                name: 'Unidades importadas',
                data: [ ['RE024',2095355],['RE040',388935],['RE037',123495],['RE027',122000],['RE046',23880],['RE047',4637],['Outros',234] ]                    
            }],
        });
    });
</script>