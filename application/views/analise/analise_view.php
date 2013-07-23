<!-- Estrutura -->
<div class="container">
				
	<div class="">
		
	</div>
	<br>									

<table width="100%" class="table table-bordered">
    <tr>
        <td>
            
    <?php
        $atributos = array('form class'=>' form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
        echo form_open('analise/listAll', $atributos); 
    ?>

        <div align="left">
            <select id="categoria"  name="categoria" class="span3" onchange="this.form.submit()">                   
                
                <option value=""> Selecione uma categoria </option>                 
                {categorias}    
                    <option value="{CID}">{CNome}</option>
                {/categorias}
                
            </select>
        </div>
    </form>


    <?php
        $atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
        echo form_open('analise/listAll', $atributos); 
    ?>

{subcategorias}

        <select id="subcategoria"  name="{name}" class="span2">                   
            
            <option value=""> {titulo} </option>                 
            {subc}    
                <option value="{SCID}">{SCNome}</option>
            {/subc}
            
        </select>

 {/subcategorias}   

    <input type="hidden" name="categoria" value="{categoriaID}">
    <button type="submit" class="btn btn-success"><i class=""></i> Pesquisa</button>
    </form>

        </td>

    </tr>

</table>	
<hr>

<table class="table table-bordered">
    <tr>
        <td>
            
<div class="row-fluid">
  <div class="span12">
    <div class="row-fluid">
      
      <div class="span8">
        
            <div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>

      </div>

      <div class="span4">
            <br><br><br>
            <table class='table table-striped table-bordered' id="idTabela" align="right">
                    
                    <tr>
                        <td width="10%"><b>Ano</b></td>
                        <td width="10%"><b>Unidades</td>
                        <td width="10%"><b>Volume</td>
                        <td width="10%"><b>Detalhes</td>
                    </tr>           

                    {dados}
                    
                    <tr>    
                        <td>{ano}</td>
                        <td>{unidades}</td>
                        <td>{volume}</td>
                        <td><a href="<?php echo base_url();?>index.php/analise/analiseAno" class='icon-search'> <a/></td>
                    </tr>

                    {/dados}
            
            </table>
      </div>
    </div>
  </div>
</div>

        </td>
    </tr>
</table>


<br><br><br>



<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {

            text: 'Análise de importações'
        },
        subtitle: {
            text: {categoria}
        },
        xAxis: {

            categories:
            [
            	{categories}
            ]
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total de peças importadas'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }                
        },
        legend: {
            align: 'center',
            x: 0,
            verticalAlign: 'bottom',
            y: 10,
            floating: false,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },           
        tooltip: {
            shared: true,
            valueDecimals: 0,
            valuePrefix: '',
            valueSuffix: ''                 
        },
        plotOptions: {
            column: {
                
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },
        series: [{
            name: 'Unidades',
            data: [{dataUnidades}]

        }]
    });
});
</script>	
 