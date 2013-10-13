<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
    <div class="container">
        <h1 class="pull-left">Análise<small> de marcas</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li><a href="#" onclick="enviar(7)">Análise</a> <span class="divider"> / </span></li>
            <li class="active">Análise por ano</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->


<div class="container">

  <?php
      $atributos = array('form class'=>' form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
      echo form_open('analyzeBrand/listAll', $atributos); 
  ?>
    <div align="right">
        <select id="marca"  name="marca" class="span3" onchange="this.form.submit()">                   
            
            <option value=""> Selecione uma Marca </option>                 
            {marcas}    
                <option value="{MAID}">{MANome}</option>
            {/marcas}
            
        </select>
    </div>  
  </form>


</div>
