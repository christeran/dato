<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */
/* @var $form CActiveForm */
?>

<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuarios-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        )); ?>
    <div class="panel panel-default" style="max-width: 700px;">        
        <div class="panel-heading">
            Información básica de su perfil
        </div>
        <div class="panel-body">
            <div class="form-group">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('style'=>'max-width:450px','size'=>60,'maxlength'=>150,"class"=>"form-control")); ?>
		<?php echo $form->error($model,'nombre'); ?>
            </div>
            <div class="form-group">
		<?php echo $form->labelEx($model,'apellido'); ?>
		<?php echo $form->textField($model,'apellido',array('style'=>'max-width:450px','size'=>60,'maxlength'=>150,"class"=>"form-control")); ?>
		<?php echo $form->error($model,'apellido'); ?>
            </div>
            <?php echo CHtml::submitButton(Yii::t('menu','Actualizar'), array("class" => "btn  btn-black")); ?>        
        </div>        
     </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->