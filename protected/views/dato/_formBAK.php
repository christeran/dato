<?php
/* @var $this DatoController */
/* @var $model Dato */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'dato-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
    'clientOptions' => array(
                        'validateOnSubmit' => true,
                    ),
        'htmlOptions'=>array(
            'enctype'=>'multipart/form-data'
        )
)); ?>
                    
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">        
		<?php echo $form->labelEx($model,'categoria_id'); ?>
		<?php
                    $list = CHtml::listData(Categorias::model()->findAll(array("condition"=>"ESTADO = 'ACTIVO'","order"=>"nombre")), 'id', 'nombre');
                    echo $form->dropDownList($model, 'categoria_id', $list, array("class"=>"form-control")); 
                ?>
		<?php echo $form->error($model,'categoria_id'); ?>
	</div>
        
        <div class="form-group">   
		<?php echo $form->labelEx($model,'provincia_id'); ?>
		<?php
                    $list = CHtml::listData(Provincias::model()->findAll(array("condition"=>"ESTADO = 'ACTIVO'","order"=>"nombre")), 'id', 'nombre');
                    echo $form->dropDownList($model, 'provincia_id', $list, array('prompt'=>'---',"class"=>"form-control")); 
                ?>
		<?php echo $form->error($model,'provincia_id'); ?>
	</div>

	<div class="form-group">   
		<?php echo $form->labelEx($model,'titulo'); ?>
		<?php echo $form->textField($model,'titulo', array("class"=>"form-control"));  ?>
		<?php echo $form->error($model,'titulo'); ?>
	</div>

	<div class="form-group">   
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url', array("class"=>"form-control"));  ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="form-group">   
		<?php echo $form->labelEx($model,'direccion'); ?>
		<?php echo $form->textField($model,'direccion', array("class"=>"form-control"));  ?>
		<?php echo $form->error($model,'direccion'); ?>
	</div>

	<div class="form-group">   
		<?php echo $form->labelEx($model,'fecha_inicio'); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                'model'=>$model,
                                'attribute'=>'fecha_inicio',
                                'language'=>  Yii::app()->language,
                                'value'=>Yii::app()->dateFormatter->format("dd/mm/yy",strtotime($model->fecha_inicio)),
                                'options'=>array(
                                    'dateFormat'=>'dd/mm/yy',
                                    'showAnim'=>'fold',
                                    'minDate'=>'new Date()',
                                    'showButtonPanel'=>true,                                    
                                ),
                                'htmlOptions'=>array(
                                    'class'=>'form-control',
                                    'autocomplete'=>'off',
                                ),
                        )); 
                ?>
		<?php echo $form->error($model,'fecha_inicio'); ?>
	</div>
        
	<div class="form-group">   
		<?php echo $form->labelEx($model,'fecha_expedicion'); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                'model'=>$model,
                                'attribute'=>'fecha_expedicion',
                                'language'=>  Yii::app()->language,
                                'value'=>Yii::app()->dateFormatter->format("dd/mm/yy",strtotime($model->fecha_expedicion)),
                                'options'=>array(
                                    'dateFormat'=>'dd/mm/yy',
                                    //'altFormat' => 'mm-dd-yy',
                                    'showAnim'=>'fold',
                                    'minDate'=>'new Date()',
                                    'showButtonPanel'=>true,                                 
                                 ),
                                'htmlOptions'=>array(
                                    'class'=>'form-control',
                                    'autocomplete'=>'off',
                                ),
                        )); 
                ?>
		<?php echo $form->error($model,'fecha_expedicion'); ?>
	</div>
                        
	<div class="form-group">   
		<?php echo $form->labelEx($model,'gratis'); ?>
		<?php echo $form->checkBox($model,'gratis'); ?>
		<?php echo $form->error($model,'gratis'); ?>
	</div>

	<div class="form-group">   
		<?php echo $form->labelEx($model,'foto'); ?>
		<?php echo $form->fileField($model,'foto'); ?>
		<?php echo $form->error($model,'foto'); ?>
	</div>

	<div class="form-group">   
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php
                    $this->widget('ext.editMe.widgets.ExtEditMe', array(
                            'model'=>$model,
                            'autoLanguage'=>'false',
                            'attribute'=>'descripcion',
                            'name'=>'descripcion',
                            'resizeMode'=>'false',
                            'toolbar'=>array(
                        array(
                            'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat', 
                        ),
                        array(
                            'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote',
                            '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock',
                        ),
                        array(
                            'Image', 'HorizontalRule', 'Smiley', 'SpecialChar', 
                       ),
                    )
                ));?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>

	<div class=" buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Enviar' : 'Actualizar',array("class"=>"btn btn-primary")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<br/>
<br/>
<br/>