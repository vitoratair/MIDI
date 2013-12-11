<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
	<div class="container">
        <h1 class="pull-left">Metodologia <small>de processamento</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li><a href="<?php echo base_url();?>index.php/model/listAll">Cadastro</a> <span class="divider"> / </span></li>
            <li class="active">Adicionar itens</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->

<!--=== Content Part ===-->
<div class="headline" align="center">
    <h2>Método de pesquisa</h2>
</div>

<div class="container-fluid one-page">

    <div class="one-page-inner one-blue">
        <div class="container">
            <!-- <h1>Busca de dados</h1> -->
            
            <div class="row-fluid">
                
                <div class="span6">
                    <img src="<?php echo base_url();?>assets/img/receita.png" class="margin-bottom-10" width="50%" alt="">
                </div>

                <div class="span6">
                    <p><br><br><br>
                        <h2>Mensalmente são disponibilizados pela <strong>Receita Federal</strong>
                        dados dos produtos importados, agrupados por <strong>NCM</strong>.</h2>
                    </p>
                </div>

            </div>
        </div>
    </div>
    
    <div align="center">
        <img src="<?php echo base_url();?>assets/img/seta1.png" class="margin-bottom-10" width="150px" alt="">
    </div>
    
    <div class="one-page-inner one-grey">
        <div class="container">
            <div class="row-fluid margin-bottom-42">
                <div class="span12">
                    <p><h2>Entre os dados fornecidos estão:
                        <strong>Descrição detalhada do produto</strong>
                        país de origem, preço FOB e quantidade comercializada.
                        </h2>
                    </p>
                </div>
            </div>
            <hr>
            <div class="row-fluid margin-bottom-42">
                <div class="span12">
                    <div class="alert alert-block">
                        <h3>A Receita não informa a <strong>marca</strong> e o <strong>modelo</strong>
                            dos produtos. Estas informações devem ser buscadas no texto da <strong>descrição
                            detalhada do produto</strong></h3>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div align="center">
        <img src="<?php echo base_url();?>assets/img/seta3.png" class="margin-bottom-10" width="100px" alt="">
    </div>

    <div class="one-page-inner one-red">
        <div class="container">
            <div class="row-fluid">
                <div class="span12">
                    <p>
                        <h1>
                            Essa descrição pode ser completa, contendo <strong>marca</strong> e <strong>modelo</strong>...
                        </h1>
                        
                        <div class="alert alert-danger">
                            REF.:TCF-2000 - APARELHOS TELEFONICOS, FIXO COM FIO, SEM FONTE
                            PROPRIA DE ENERGIA, MONOCANAL, MARCA <strong><i>ELGIN</i></strong>,
                            COD: HCD-81, MODELO <strong><i>TCF-2000</i></strong>,
                            COR PRETO

                        </div>  
                        <div align="center"><h2><code>OR</code></h2></div>
                    </p>    

                    <p>
                        <h1>
                            Incompleta, permitindo muitas vezes apenas a identificação da categoria...
                        </h1>
                        
                        <div class="alert alert-danger">
                            <strong><i>TELEFONE COM FIO</i></strong> - REF: RM-9047
                        </div>                        
                    </p> 

                </div>
            </div>
        </div>
    </div>

    <br><br>

    <div class="one-page-inner one-default">
        <div class="container">
            <div class="row-fluid">
                <div class="span6">
                    <p>
                        <h1>
                            O trabalho do <strong>MIDI</strong> é buscar nestas descrições
                            <strong>marcas</strong> e <strong>Modelos</strong>,
                            possiblitando o agrupamento dos dados em
                            <strong>categorias de produtos</strong>
                        </h1>
                    </p>
                    
                    <img src="<?php echo base_url();?>assets/img/seta3.png" class="margin-bottom-10" width="6%" alt="">
                    
                    <div class="alert alert-info">  
                        <h3>Telefone com fio, DVR, Switch, Terminal IP...</h3>
                    </div>                    

                </div>

                <div class="span6">
                    <img src="<?php echo base_url();?>assets/img/search.png" class="margin-bottom-10" width="70%" alt="">
                </div>
            </div>                    
        </div>
    </div> 

    <div class="one-page-inner one-blue">
        <div class="container">
            <div class="row-fluid margin-bottom-40">
                <div class="span6">
                    <p>
                        <h2>
                            Para que o <strong>MIDI</strong> realize essas buscas, é necessário
                            alimentá-lo com <strong>bases de marcas e modelos</strong>.
                            Você pode entender melhor como criar estas bases em<br><br>
                            <a class="btn-u btn-u-large btn-u-red one-page-btn"><i class="icon-briefcase"></i> Nova pesquisa</a>
                        </h2>
                    </p>
                </div>
                <div class="span6">
                    <img src="<?php echo base_url();?>assets/img/Folhas.png" class="margin-bottom-10" alt="">
                </div>
            </div>

            <div class="row-fluid">
                <div class="span6">
                    <img src="<?php echo base_url();?>assets/img/mao.png" class="margin-bottom-10" alt="">
                </div>
                <div class="span6">
                    <p>
                        <h2>
                            Depois da análise automática, é necessário <strong>analisar</strong>
                            manualmente as descrições que o <strong>MIDI</strong> não conseguiu
                            processar por estarem <strong>incompletas</strong>.
                        </h2>
                    </p>

                    <div class="span12">
                        <div class="span2">
                            <img src="<?php echo base_url();?>assets/img/seta3.png" class="" width="80px">
                        </div>
                        <div class="span10">
                            <br><br><br><h2><strong>Refinamento dos dados</strong></h2>
                        </div>                        

                    </div>
                </div>
            </div>


        </div>
    </div>


    <div class="one-page-inner one-green">
        <div class="container">
            <div class="row-fluid">
                <div class="span6">
                    <p><h2>
                        Como resultado o <strong>MIDI</strong> entrega
                        análises de importações por <strong>categoria</strong>,
                        <strong>marca</strong> e <strong>modelo</strong>.<br><br>
                        Gráficos e tabelas podem ser gerados com diferentes combinações
                        de variáveis, auxiliando no processo de <strong>tomada de desições</strong>
                    </h2></p>
                </div>
                <div class="span6">
                    <img src="<?php echo base_url();?>assets/img/grafico.png" class="margin-bottom-10" width="90%">
                </div>
            </div>
        </div>
    </div>

</div>

    <br><br><br>
        
        <p align="center">
            <img src="<?php echo base_url();?>assets/img/Logo_MIDI.jpg" class="margin-bottom-10" width="">
        </p>