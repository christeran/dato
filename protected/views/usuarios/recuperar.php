
<div class="container" >
        <div style="margin: 50px auto;max-width: 350px;">
            <div class="center-block text-center"  >
                <img  height="75px" width="75px"  src='<?php echo Yii::app()->theme->baseUrl?>/img/eldato-main.png' />
                <br />
         <h3 class="logon-brand text-center center-block" style="margin-top: 0px;padding-top: 0px;font-size: 35px;" >el dato</h3>
        </div>            
        <div class="panel panel-default panel-logon">         
            <div class="panel-body">
                <label>Recuperar Contraseña</label> 
                <br/><p/>
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'recuperar-form',
                    'enableClientValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit'=>true,
                        'validateOnChange'=>false,
                        'validateOnType'=>false,
                    ),
                    'focus'=>array($model,'password'),
                ));
                ?>
                <div class="form-group">
                        <?php echo $form->labelEx($model,'password'); ?>
                        <?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>250,"class"=>"form-control")); ?>
                        <?php echo $form->error($model,'password'); ?>
                </div>
                <div class="form-group">
                        <?php echo $form->labelEx($model,'confirmPassword'); ?>
                        <?php echo $form->passwordField($model,'confirmPassword',array('size'=>60,'maxlength'=>250,"class"=>"form-control")); ?>
                        <?php echo $form->error($model,'confirmPassword'); ?>
                </div>
                <?php echo CHtml::submitButton('Enviar', array("class" => "btn btn-lg btn-block btn-black")); ?>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>
