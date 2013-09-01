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
    <table width="100%" class="table table-bordered">
        <tr>
            <td>                
                <?php
                    $atributos = array('form class'=>' form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
                    echo form_open('analyze/listAll', $atributos); 
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
            </td>
        </tr>
    </table><!--  FIM DA SELEÇÃO DE CATEGORIA -->
   
</div>