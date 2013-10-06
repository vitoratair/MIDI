	<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
    <div class="container">
        <h1 class="pull-left">Processamento  <small>de dados</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li>Administração <span class="divider"> / </span></li>
            <li class="active">Processamento</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->


<div class="container"> 

    <!--  SELEÇÃO DE CATEGORIA -->
<?php
    $atributos = array('form class'=>' form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
    echo form_open('analyze/listAll', $atributos); 
?>    
        <table width="100%" class="">
            <tr>
                <td>                
                    <div align="left">
                        <select id="categoria"  name="categoria" class="span3">                   
                            
                            <option value=""> Selecione uma categoria </option>                 
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
                            
                            <option value="1"> Data inicial </option>                 

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
                            
                            <option value="12"> Data Final </option>                 

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
        </table><!--  FIM DA SELEÇÃO DE CATEGORIA -->
    </form>

</div>