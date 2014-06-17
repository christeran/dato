<?php
/* @var $this DatoController */
/* @var $model Dato */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'enviar-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
        'clientOptions' => array(
                        'validateOnSubmit' => true,
                    'validateOnChange' => false,
                    ),
        'htmlOptions'=>array(
            'enctype'=>'multipart/form-data'
        )
)); ?>
    <p class="nota" ><?php echo Yii::t('app','Los campos con <span class="required">*</span> son requeridos.')?></p>
        <div class="panel panel-default">
              <div class="panel-heading">
                Detalles de tu aviso
              </div>
            <div class="panel-body">
                <div class="form-group">   
                        <?php echo $form->labelEx($model,'titulo'); ?>
                        <?php echo $form->textField($model,'titulo', array("class"=>"form-control"));  ?>
                        <?php echo $form->error($model,'titulo'); ?>
                </div>

                <div class="form-group">        
                        <?php echo $form->labelEx($model,'categoria_id'); ?>
                        <?php
                            if ( Yii::app()->language =='en'){
                                $list = CHtml::listData(Categorias::model()->findAll(array("condition"=>"ESTADO = 'ACTIVO'","order"=>"name")), 'id', 'name');
                            }else{
                                $list = CHtml::listData(Categorias::model()->findAll(array("condition"=>"ESTADO = 'ACTIVO'","order"=>"nombre")), 'id', 'nombre');
                            }
                            echo $form->dropDownList($model, 'categoria_id', $list, array("class"=>"form-control")); 
                        ?>
                        <?php echo $form->error($model,'categoria_id'); ?>
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
                            'autoLanguage'=>'true',
                            'attribute'=>'descripcion',
                            'name'=>'descripcion',
                            'resizeMode'=>'false',
                            'htmlOptions' => array('class' => 'form-control','style'=>'min-height:100px'),
                            'height'=>'250',
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
        </div>
        </div>
        
      <div class="alert alert-dismissable alert-extras">                    
            <span class="enviar-extras"><?php echo Yii::t('app','Information Extras')?>:</span>
            <br/>
            <br/>
            <p/>

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
        </div>               


	<div class="well">
<!--              <p>Publicar un anuncio en el dato es completamente gratuito y los cazadores de la comunidad te lo agradeceran.</p>
              <p>Este anuncion debe seguir <a href="#">las reglas de uso </a> de nuestra comunidad.</p>-->
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Postear' : 'Actualizar',array("class"=>"btn btn-black")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<br/>
<br/>
<br/>