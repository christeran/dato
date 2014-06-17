
<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Actualizar Perfil';
?>
<br/>
<div class="col-md-2 visible-lg visible-md " style="border-right: 1px #000 solid" >    
     <strong>Configuraciones</strong>      
      <hr>      
      <ul class="list-unstyled" >
        <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#userMenu">
          <h5>Generales
              <i class="glyphicon glyphicon-chevron-down"></i></h5>
          </a>
            <ul class="list-unstyled collapse in" id="userMenu">
                <li class="active"> <a href="<?php echo Yii::app()->createUrl('usuarios/actualizar' ); ?>"><i class="glyphicon glyphicon-wrench"></i> <?php echo Yii::t('menu','Perfil') ?></a></li>
                <li><a href="<?php echo Yii::app()->createUrl('usuarios/cambiarpassword' ); ?>"><i class="glyphicon glyphicon-refresh"></i> <?php echo Yii::t('menu','Contraseña')?></a></li>
            </ul>
        </li>    
        <hr/>
        <li class="nav-header">
            <a href="#" ><i style="color: #e84d3b" class="glyphicon glyphicon-off"></i> <?php echo Yii::t('menu','Salir')?></a>
        </li>
      </ul>
           
      <hr>     
  </div>
  <div class="col-sm-12 col-md-10 " >
          <div class="formulario-titulo">Actualizar Perfil </div>          
          <p class="nota"><?php echo  Yii::t('app','Los campos con <span class="required">*</span> son requeridos.')?> </p>
           <?php $this->renderPartial('_form', array('model'=>$model)); ?>
      </div> 