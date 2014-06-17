<?php
/* @var $this DatoController */
/* @var $model Dato */
?>
<div class="col-lg-12 col-md-12 col-sm-12 titulo-main-body" > 
     <div class="formulario-titulo">Postear en <span class="formulario-brand">el dato</span></div>
     <div class="formulario-descripcion">Esta es una cominudad de cazadores de las mejores rebajas, descuentos y promociones en todo el Peru.</div>
</div>

    <!-- start posts -->
    <div class="col-lg-9 col-md-9 col-sm-12 body-page" >   
        <?php $this->renderPartial('_enviar', array('model'=>$model)); ?>
        <br/>  
    </div>
    <!-- end posts -->
    <!-- start right options -->
    <div class="col-lg-3  col-md-3  feature visible-lg visible-md widget-page"  >                  
       
    </div><!-- end feature -->
    <!-- end right options -->