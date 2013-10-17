<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
    <div class="container">
        <h1 class="pull-left">Upoload<small> de arquivos</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li><a href="#" onclick="enviar(7)">Análise</a> <span class="divider"> / </span></li>
            <li class="active">Análise por ano</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->


<div class="container">

  <!-- START UPLOAD -->
  <br>

  <!-- IMPORTAR NCMs -->
  <div class="accordion acc-home" id="accordion3">
    <div class="accordion-group">
      <div class="accordion-heading">
        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapseOne1">
          <h3>Importar planilha de NCM</h3>
        </a>
      </div>
      <div id="collapseOne1" class="accordion-body collapse" style="height: 0px;">
        <div class="accordion-inner">
          <br><br>
          <blockquote>  
            <p>
            <div class="alert"><h4>Tenha certeza que a planilha de excel esteja no formato .xls
             seguindo o <a href="<?php echo base_url();?>index.php/app/documentation" >template correto</a></h4></div>
            </p>

            <form class="form-horizontal" enctype="multipart/form-data" action="../upload/do_upload" method="POST">            
              <div align="left">
                <div style="position:relative;">
                        <a class='btn' href='javascript:;'>
                            Selecione o arquivo
                            <input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="userfile" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
                        </a>
                        &nbsp;
                        <span class='label label-info' id="upload-file-info"></span>
                </div>                
              <br>
              <input type="hidden" name="id" value="ncmImport">
              <input type="submit" value="Enviar" class="btn-u">
              </div>  
            </form>
          </blockquote> 
          <br> 
        </div>
      </div>
    <!-- CLOSE IMPORTAR NCMs -->  

    </div><!--/accordion-group-->
    <div class="accordion-group">
      <div class="accordion-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapseTwo1">
          <h3>Atualizar planilha de NCM</h3>
        </a>
      </div>
      <div id="collapseTwo1" class="accordion-body collapse" style="height: 0px;">
        <div class="accordion-inner">
          
          <br><br>
          <blockquote>  
            <p>
            <div class="alert"><h4>Tenha certeza que a planilha de excel esteja no formato .xls
             seguindo o <a href="<?php echo base_url();?>index.php/app/documentation" >template correto</a></h4></div>
            </p>

            <form class="form-horizontal" enctype="multipart/form-data" action="../upload/do_upload" method="POST">            
              <div align="left">
                <div style="position:relative;">
                        <a class='btn' href='javascript:;'>
                            Selecione o arquivo
                            <input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="userfile" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
                        </a>
                        &nbsp;
                        <span class='label label-info' id="upload-file-info"></span>
                </div>                
              <br>
              <input type="hidden" name="id" value="ncmUpdate">
              <input type="submit" value="Enviar" class="btn-u">
              </div>  
            </form>
          </blockquote> 
          <br> 
        </div>
      </div>
    </div><!--/accordion-group-->

    <div class="accordion-group">
      <div class="accordion-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapseTwo2">
          <h3>Atualizar planilha de modelos</h3>
        </a>
      </div>
      <div id="collapseTwo2" class="accordion-body collapse" style="height: 0px;">
        <div class="accordion-inner">
          

        </div>
      </div>
    </div><!--/accordion-group-->    

    <div class="accordion-group">
      <div class="accordion-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapseTwo3">
          <h3>Atualizar planilha de marcas</h3>
        </a>
      </div>
      <div id="collapseTwo3" class="accordion-body collapse" style="height: 0px;">
        <div class="accordion-inner">
          

        </div>
      </div>
    </div><!--/accordion-group-->        
  
  </div> <!-- Categorias de análise -->

</div>
