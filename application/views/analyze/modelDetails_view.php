<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
    <div class="container">
        <h1 class="pull-left">{modeloNome}  <small>importados no ano de {ano}</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li><a href="<?php echo base_url();?>index.php/analyze/listAll">Análise</a> <span class="divider"> / </span></li>
            <li class="active">Análise por ano</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->


<div class="container">

<!--     <?php
        $atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
        echo form_open('analise/analiseModelo', $atributos); 
    ?>

	    <input type="hidden" name="subcategorias" value="{postSubcategorias}">
	    <input type="hidden" name="categoria" value="{categoria}">
	    <input type="hidden" name="ano" value="{ano}">
	    <input type="hidden" name="marca" value="{marca}">    
	    <button type="submit" class="btn"><i class="icon-arrow-left"></i> Voltar</button>
    </form> -->


    <table class='table table-bordered table-hover' align="right">
    <thead>
            <tr>
                <td width="5%"><b>NCM</b></td>
                <td width="50%"><b>Descrição</b></td>
                <td width="7%"><b>FOB</b></td>
                <td width="5%"><b>Unidades</b></td>
                <td width="10%"><b>Marca</b></td>
                <td width="10%"><b>Modelo</b></td>
                <td width="5%"><b>Alterar</b></td>
            </tr>           
    </thead>

    {dados}    
            <tr class="table-condensed">
                <td>{ncm}</td>
                <td>{descricao}</td>
                <td>$ {fob}</td>
                <td>{unidades}</td>
                <td>{marca}</td>
                <td>{modelo}</td>
                <td width="5%"><a target="blank" href="<?php echo base_url();?>index.php/ncm/edit/{idn}/{ncm}/{ano}" class='icon-edit'> </a></td>                
            </tr>
    {/dados}

    </table>

</div>