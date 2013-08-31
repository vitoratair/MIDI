<!DOCTYPE html>
<!--[if IE 7]> <html lang="en" class="ie7"> <![endif]-->  
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title><?php echo TITLE;?></title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSS Global Compulsory-->
    <link rel="stylesheet"      href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"      href="<?php echo base_url();?>assets/css/style.css">
    <link rel="stylesheet"      href="<?php echo base_url();?>assets/css/headers/header1.css">
    <link rel="stylesheet"      href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap-responsive.min.css">
    <link rel="stylesheet"      href="<?php echo base_url();?>assets/css/style_responsive.css">
    <link rel="shortcut icon"   href="<?php echo base_url();?>assets/img/favicon.ico">        
    <!-- CSS Implementing Plugins -->    
    <link rel="stylesheet"      href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.css">
    <!-- CSS Theme -->    
    <link rel="stylesheet"      href="<?php echo base_url();?>assets/css/themes/default.css" id="style_color">
    <link rel="stylesheet"      href="<?php echo base_url();?>assets/css/themes/headers/default.css" id="style_color-header-1">    
</head> 

<body>
	         

<br><br><br><br>
<br><br><br><br>

<!--=== Content Part ===-->
<div class="container">		
	<div class="row-fluid">
    
        <?php
            $atributos = array('form class'=>'log-page', 'method'=>'POST');
            echo form_open('login/loginValidate', $atributos); 
        ?>              
            <h3>Login</h3>    
            <br>
            <div class="input-prepend">
                <span class="add-on"><i class="icon-user"></i></span>
                <input class="input-xlarge" type="text" name="login" placeholder="Usuário">
            </div>
            <div class="input-prepend">
                <span class="add-on"><i class="icon-lock"></i></span>
                <input class="input-xlarge" type="password" name="password" placeholder="Senha">
            </div>
            <div class="controls form-inline">
                <label></label>
                <br>
                <button class="btn-u pull-right" type="submit">Login</button>                        
                <br><br>
        </form>
        
        <?php 
            
            $msg = $this->session->userdata('msg');
            
            if (!empty($msg))
            {
                
                echo "
                    <br><br>
                    <div class='alert alert-error'>
                        $msg
                    </div>";
            }
            
            $this->session->unset_userdata('msg');
        ?>  
              
    </div>
</div>    
<br><br><br><br>

<!-- JS Global Compulsory -->           
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/modernizr.custom.js"></script>        
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
<!-- JS Implementing Plugins -->           
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/back-to-top.js"></script>
<!-- JS Page Level -->           
<script type="text/javascript" src="<?php echo base_url();?>assets/js/app.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        App.init();
    });
</script>

<!--[if lt IE 9]>
    <script src="assets/js/respond.js"></script>
<![endif]-->

</body>
</html> 