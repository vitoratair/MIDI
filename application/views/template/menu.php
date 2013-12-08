<?php 

    $usuario = $this->session->userdata('usuarioLogin');
    $tipo    = $this->session->userdata('usuarioTipo');

?>

<!--=== Header ===-->
<div class="header">               
    <div class="container"> 
                                    
        <!-- Logo -->       
        <div class="logo">                                             
            <a href="<?php echo base_url();?>index.php/app/home"><img id="logo-header" width="300px" src="<?php echo base_url();?>assets/img/Logo_MIDI.jpg" alt="Logo"></a>
        </div><!-- /logo -->        
        <!-- Menu -->       
        <div class="navbar">                                
            <div class="navbar-inner">                                  
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a><!-- /nav-collapse -->                                  
                
                <div class="nav-collapse collapse">                                     
                    <ul class="nav top-2">
                        
                        <li class="active"><?php echo anchor('app/home','Home');?></li>                        
                        
                        <li>
                            <a href="" class="dropdown-toggle" data-toggle="dropdown">Administração
                                <b class="caret"></b>                            
                            </a>
                            
                            <ul class="dropdown-menu">

                                <li><?php echo anchor('administration/processing','Processamento');?></li>

                                <li><?php echo anchor('administration/statistic','Estatísticas - NCM');?></li>

                                <!-- <li><?php echo anchor('administration/statisticCategory','Estatísticas - Categoria');?></li> -->

                                <li><?php echo anchor('upload/fileUpload','Importar arquivos');?></li>

                                <!-- <li><?php echo anchor('app/home','Upload Marcas');?></li> -->

                                <!-- <li><?php echo anchor('app/home','Upload Modelos');?></li> -->
                            </ul>
                            
                            <b class="caret-out"></b>                        
                        </li>

                        <li>
                            <a href="" class="dropdown-toggle" data-toggle="dropdown">Cadastro
                                <b class="caret"></b>                            
                            </a>
                            
                            <ul class="dropdown-menu">
                                <li><?php echo anchor('category/listAll','Categoria');?></li>                      

                                <li><?php echo anchor('ncm/listAll','NCM');?></li>

                                <li><?php echo anchor('model/addModel','Modelo');?></li>                                

                                <li><?php echo anchor('user/listAll','Usuário');?></li>                                
                                
                            </ul>
                            
                            <b class="caret-out"></b>                        
                        </li>

                        <li>
                            <a href="" class="dropdown-toggle" data-toggle="dropdown">Pesquisas
                                <b class="caret"></b>                            
                            </a>
                            
                            <ul class="dropdown-menu">
                                <li><?php echo anchor('search/ncm','Importações');?></li>                                                                       

                                <li><?php echo anchor('brand/listAll','Marca');?></li>
                                
                                <li><?php echo anchor('model/listAll','Modelo');?></li>
                                
                            </ul>
                            
                            <b class="caret-out"></b>                        
                        </li>                        

                        <li>
                            <a href="" class="dropdown-toggle" data-toggle="dropdown">Análise
                                <b class="caret"></b>                            
                            </a>
                            <ul class="dropdown-menu">

                                <li><?php echo anchor('analyze/listAll','Análise por ano');?></li>

                                <li><?php echo anchor('analyzeBrand/listAll','Análise por marca');?></li>

                                <!-- <li><?php echo anchor('analise/listAll','Comparativo');?></li> -->

                            </ul>
                            <b class="caret-out"></b>                        
                        </li>

                        <li>
                            <a href="" class="dropdown-toggle" data-toggle="dropdown" href="#">
                            
                            <i class="icon-user"> </i> <?php echo $usuario ?> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><?php echo anchor("user/perfil/$usuario",'Perfil');?></li>
                                <li><?php echo anchor("request/listAll",'Requisições');?></li>
                                <li><?php echo anchor("request/brandAndModel",'Marcas e modelos');?></li>
                                <li><?php echo anchor('login/logout','Logout');?></li>
                            </ul>
                            <b class="caret-out"></b>                        
                        </li>  

                    </ul>
                </div><!-- /nav-collapse -->                                
            </div><!-- /navbar-inner -->
        </div><!-- /navbar -->                          
    </div><!-- /container -->               
</div><!--/header -->      
<!--=== End Header ===-->
