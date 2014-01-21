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
                        <option value="">Selecione uma subcategoria</option>
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
                            <option value="1">Data Inicial</option>
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
                            <option value="12">Data Final</option>
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
</table>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>






