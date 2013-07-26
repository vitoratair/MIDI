<!-- Estrutura -->
<div class="container">
                
    <div class="">
        
    </div>
    <br>                                    

<table width="100%" class="table table-bordered">
    <tr>
        <td>
            
    <?php
        $atributos = array('form class'=>' form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
        echo form_open('analise/listAll', $atributos); 
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

</table>

<br>