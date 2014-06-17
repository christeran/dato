
<div class="col-lg-12 col-md-12 col-sm-12 titulo-main-body" > 

</div>
<br/>
<div class=" col-lg-8 col-md-8 col-sm-12  " >      
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuarios-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

        <div class="formulario-titulo"><?php echo  Yii::t('usuarios','Registrate en')?> <span class="formulario-brand">el dato</span></div>
        <div class="formulario-descripcion"><?php echo  Yii::t('usuarios','Ser parte de esta comunidad es totalmente GRATIS. Solo es necesario llenar el siguiente formulario.')?> </div>
	<p class="nota"><?php echo  Yii::t('app','Los campos con <span class="required">*</span> son requeridos.')?> </p>
        
        <div class="formulario-borde" >
            
	<div class="form-group">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>60,"class"=>"form-control")); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>
        
	<div class="form-group">
		<?php echo $form->labelEx($model,'apellido'); ?>
		<?php echo $form->textField($model,'apellido',array('size'=>60,'maxlength'=>90, "class"=>"form-control")); ?>
		<?php echo $form->error($model,'apellido'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>90,"class"=>"form-control")); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>200,"class"=>"form-control")); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	<div class="form-group">
                <?php echo $form->labelEx($model,'confirmPassword'); ?>
		<?php echo $form->passwordField($model,'confirmPassword',array('size'=>60,'maxlength'=>250,"class"=>"form-control")); ?>
		<?php echo $form->error($model,'confirmPassword'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>200,"class"=>"form-control")); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

        <?php echo CHtml::submitButton( Yii::t('usuarios','Unirse'), array("class"=>"btn btn-black")); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->




    <!-- start right options -->
    <div class="col-lg-4  col-md-4  feature visible-lg visible-md">                  

    </div><!-- end feature -->
    <!-- end right options -->