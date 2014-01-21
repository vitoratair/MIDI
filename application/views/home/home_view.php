
<br><br>

<body onload="reload()">
    
    <div class="row-fluid purchase margin-bottom-30">
        <div class="container">
            <div class="span12">
        
        <p align="center">
            <h1 align="center">Consulte análises realizadas</h1>
        </p>
        <p align="center">            
            <a href="<?php echo base_url();?>index.php/analyze/listAll" class="btn-buy hover-effect"> Inicie aqui </a>
            </p>
            </div>
            
        </div>
    </div>

    <br><br>

    <!--=== Content Part ===-->
    <div class="container"> 
        <!-- Service Blocks -->    
        <div class="row-fluid">
            <a href="<?php echo base_url();?>index.php/app/methodology">
            <div class="span4">
                <div class="service clearfix">
                    <i class="icon-cogs"></i>
                    <div class="desc">
                        <h4>Método</h4>
                        <p>
                            Como os dados são obtidos e processados   
                            <!-- Detalhamento de como são obtidos e processados os dados -->
                        </p>
                    </div>
                </div>  
            </div>
            </a>

            <a href="<?php echo base_url();?>index.php/app/newSearch">
            <div class="span4">
                <div class="service clearfix">
                    <i class="icon-question-sign"></i>
                    <div class="desc">
                        <h4>Nova pesquisa</h4>
                        <p>
                          O que é necessário para adicionar uma nova pesquisa? 
                        </p>
                    </div>
                </div>  
            </div>
            </a>

            <a href="<?php echo base_url();?>index.php/app/documentation">
            <div class="span4">
                <div class="service clearfix">
                    <i class="icon-book"></i>
                    <div class="desc">
                        <h4>Documentação</h4>
                        <p>                        
                            Principais funções passo-a-passo
                        </p>
                    </div>
                </div>  
            </div>              
            </a>
        </div> <!-- End Purchase Block -->
    </div>

</body>

<script type="text/javascript">
    
    function reload()
    {
       var url = window.location.href;
       
       if (url.indexOf("?") > -1 )
       {
            newUrl = url.substr(0,url.indexOf("?"));
       }
       
       if (url != newUrl)
       {
            window.location = newUrl;
       }
    }

</script>