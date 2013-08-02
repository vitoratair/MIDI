<!-- Estrutura -->
<div class="container">
                
    <?php
        $atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'align' => 'right', 'method'=>'POST');
        echo form_open('analise/analiseAno', $atributos); 
    ?>

    <input type="hidden" name="categoria" value="{categoria}">
    <input type="hidden" name="ano" value="{ano}">
    <input type="hidden" name="subcategorias" value="{postSubcategorias}">
    <button type="submit" class="btn"><i class="icon-arrow-left"></i> Voltar</button>

    </form>

    <!-- Range para escolha das peças mínimas por marca -->
    <?php
        $atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'align' => 'left', 'method'=>'POST');
        echo form_open('analise/analiseAnoParticipacao', $atributos); 
    ?>


    <table class=" table table-bordered">
        <tr>
                
            <td>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <input id="slider" class="slider slider-horizontal slider-track" type="range" min="1" max="{maximo}" step="1" value="{valor}" name="valor" onchange="updateSlider(this.value)" />
                
                <div id="chosen">
                    {valor}
                </div> 

            </td>

        </tr>


    </table>

    <input type="hidden" name="categoria" value="{categoria}">
    <input type="hidden" name="ano" value="{ano}">
    <input type="hidden" name="subcategorias" value="{postSubcategorias}">


    
    

    </form>

        
    <div class="" id="participacao_de_mercadoPeca" style="min-width: 700px; height: 600px; margin: 0 auto"></div>    


<!--
    +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
-->
   

<style type="text/css">
#chosen {
    padding-top:absolute;
    /*padding-bottom:px;*/
    text-align:left;
    /*color:red;*/
    font-weight:bold;
    margin-left:0px;
    margin-top:-20px;
}

</style>



<!-- Java scrip para criação do gráfico -->
<script type="text/javascript">	

    function updateSlider(slideAmount)
    {
        //get the element
        var display = document.getElementById("chosen");
        //show the amount
        display.innerHTML=slideAmount;
        //get the element
        var pic = document.getElementById("pic");
        //set the dimensions
        pic.style.width=slideAmount+"%";
        pic.style.height=slideAmount+"%";        
    }

$(function () {
		// Build the chart
        $('#participacao_de_mercadoPeca').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: true
            },
            title: {
                text: 'Análise de importação'
            },
            subtitle:{
	          text: '{categoriaNome}'  
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

                data:
                [
		              {dados}
                ]
            }]
        });
    });
</script>