    <!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
    <div class="container">
        <h1 class="pull-left">Análise <small>de importações</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li>Análise <span class="divider"> / </span></li>
            <li class="active">Pesquisa</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->


<div class="container"> 

    <!--  MENU -->
<?php
    $atributos = array('form class'=>' form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
    echo form_open('analyze/listAll', $atributos); 
?>
    <table width="100%" class="" border="0px">
        <tr>
            <td>                
                <div align="left">
                    <select id="categoria"  name="categoria" class="span3">                   
                        
                        <option value="{categoriaID}"> {categoriaNome} </option>                 
                        {categorias}    
                            <option value="{CID}">{CNome}</option>
                        {/categorias}
                        
                    </select>
                </div>
                
            </td>
            <!-- Form para data da pesquisa -->
            <td>
                <div align="right">
                    <select id="dataInicial"  name="dataInicial" class="span3">                   
                        
                        <option value="{dataInicial}"> {dataInicialName} </option>                 

                            <option value="1">Janeiro</option>
                            <option value="2">Fevereiro</option>
                            <option value="3">Março</option>
                            <option value="4">Abril</option>
                            <option value="5">Maio</option>
                            <option value="6">Junho</option>
                            <option value="7">Julho</option>
                            <option value="8">Agosto</option>
                            <option value="9">Setembro</option>
                            <option value="10">Outubro</option>
                            <option value="11">Novembro</option>
                            <option value="12">Dezembro</option>
                        
                    </select>
                </div>
            </td>

            <td>
                <div align="left">
                    <select id="dataFinal"  name="dataFinal" class="span3" onchange="this.form.submit()">                   
                        
                        <option value="{dataFinal}"> {dataFinalName} </option>                 

                            <option value="1">Janeiro</option>
                            <option value="2">Fevereiro</option>
                            <option value="3">Março</option>
                            <option value="4">Abril</option>
                            <option value="5">Maio</option>
                            <option value="6">Junho</option>
                            <option value="7">Julho</option>
                            <option value="8">Agosto</option>
                            <option value="9">Setembro</option>
                            <option value="10">Outubro</option>
                            <option value="11">Novembro</option>
                            <option value="12">Dezembro</option>
                        
                    </select>
                </div>
            </td>
        </tr>
</form>
        <tr>
            <td colspan="3">
                <hr>
            </td>
        </tr>

        <tr>
            <td colspan="3">
                <?php
                    $atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
                    echo form_open('analyze/listAll', $atributos); 
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
                    <input type="hidden" name="dataInicial" value="{dataInicial}">
                    <input type="hidden" name="dataFinal" value="{dataFinal}">
                    <button type="submit" class="btn btn-success"><i class=""></i> Pesquisa</button>
                </form>
            </td>
        </tr>
    </table>
    <!-- FIM DO MENU -->


    <table class="table table-bordered">
        <tr>
            <td>                
                <div class="row-fluid">
                    <div class="span12">
                        <div class="row-fluid"> 

                            <div class="span8">                        
                                <div id="analyze_1" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
                            </div>

                            <div class="span4">
                                <br>
                                <br>
                                <br>
                                <table class='table table-striped table-bordered' id="idTabela" align="right">
                                        
                                        <tr>
                                            <td width="10%"><b>Ano</b></td>
                                            <td width="10%"><b>Unidades</td>
                                            <td width="10%"><b>Valor</td>
                                            <td width="10%"><b>Detalhes</td>
                                        </tr>           

                                        {dados}
                                        
                                        <tr>    
                                            <td>{ano}</td>
                                            <td>{unidades}</td>
                                            <td>{volume}</td>
                                            <td><a onclick="enviar({categoriaID}, {ano});" href="#" class='icon-search'> <a/></td>
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
</div>


<!-- Java scrip para criação do gráfico -->
<script type="text/javascript">

    function enviar(categoria, ano)
    {    

        var url = '<?php echo base_url();?>index.php/analyze/yearAnalyze';
        var form = $('<form action="' + url + '" method="POST">' +
          '<input type="hidden" name="categoria" value="' + categoria + '" />' +
          '<input type="hidden" name="ano" value="' + ano + '" />' +

          '<input type="hidden" name="dataInicial" value="' + <?php echo $dataInicial;?> + '" />' +
          '<input type="hidden" name="dataFinal" value="' + <?php echo $dataFinal;?> + '" />' +

          '<input type="hidden" name="subcategorias" value="' + <?php echo $postSubcategorias;?> + '" />' +
          '</form>');
        $('body').append(form);
        $(form).submit();


    }

    $(function () {
        $('#analyze_1').highcharts({
            chart:
            {
                zoomType: 'xy'
            },
            title:
            {
                text: 'Análise de importações'
            },
            subtitle:
            {
                text: {categoria} + ' importados entre {dataInicialName} e {dataFinalName}'
            },
            xAxis:
            {
                categories:[ {categories} ]
            },            
            yAxis: [ // Primary yAxis
            { 
                labels:
                {
                    format: '{value} ',                
                    style:
                    {
                        color: '#89A54E'
                    }
                },
                opposite: true,
                title:
                {
                    text: 'Valor',
                    style:
                    {
                        color: '#89A54E'
                    }
                }
            }, 

            { // Secondary yAxis
                title: 
                {
                    text: 'Unidades',
                    style:
                    {
                        color: '#4572A7'
                    }
                },
                labels:
                {
                    style:
                    {
                        color: '#4572A7'
                    }
                },                
            }],
            tooltip:
            {
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
                
                data: [{dataUnidades}], 
                
                tooltip: {
                shared: false,
                valueDecimals: 0,
                valuePrefix: '',
                valueSuffix: '' 
                }
    
            }, {
                name: 'Valor',
                color: '#89A54E',
                // type: 'spline',
                type: 'column',
                
                data: [{dataCash}],

                tooltip:
                {
                    shared: true,
                    valueDecimals: 0,
                    valuePrefix: '$',
                    valueSuffix: ''                    
                }
            }]
        });
    });
</script>




