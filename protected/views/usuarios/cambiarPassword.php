<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Cambiar contraseña.';
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
            <a href="#" ><i style="color: #e84d3b" class="glyphicon glyphicon-off"></i><?php echo Yii::t('menu','Salir')?> </a>
        </li>
      </ul>           
      <hr>     
  </div>     
    <div class="col-sm-12 col-md-10 " >
            <div class="formulario-titulo">Cambio de  contraseña </div>
            <div class="formulario-descripcion">Recomendamos cambiar su contraseña cada 6 meses</div>
            <p class="nota">Los campos con <span class="required">*</span> son necesarios.</p>
                    <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'CambiarPassword-form',
                    'enableAjaxValidation'=>true,
                    'clientOptions' => array(
                        'validateOnSubmit'=>true,
                        'validateOnChange'=>false,
                        'validateOnType'=>false,
                     ),
            )); ?>
            <div class="panel panel-default" style="max-width: 700px;">
              <div class="panel-heading">
                Seguridad de su perfil
              </div>
               <div class="panel-body">
                    <div class="form-group">
                        <?php echo $form->labelEx($model,'currentPassword'); ?>
                        <?php echo $form->passwordField($model,'currentPassword',array('style'=>'max-width:250px','size'=>60,'maxlength'=>20,"class"=>"form-control")); ?>
                        <?php echo $form->error($model,'currentPassword'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($model,'newPassword'); ?>
                        <?php echo $form->passwordField($model,'newPassword',array('style'=>'max-width:250px','size'=>60,'maxlength'=>20,"class"=>"form-control")); ?>
                        <?php echo $form->error($model,'newPassword'); ?>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model,'newPassword_repeat'); ?>
                        <?php echo $form->passwordField($model,'newPassword_repeat',array('style'=>'max-width:250px','size'=>60,'maxlength'=>250,"class"=>"form-control")); ?>
                        <?php echo $form->error($model,'newPassword_repeat'); ?>
                    </div>
                    <?php echo CHtml::submitButton('Aceptar', array("class" => "btn  btn-black")); ?>
                    <?php $this->endWidget(); ?>
              
        </div>
        </div>
</div>