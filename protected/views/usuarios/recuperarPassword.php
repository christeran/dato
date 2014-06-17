
<div class="container" >
        <div style="margin: 50px auto;max-width: 350px;">
            <div class="center-block text-center"  >
                <img  height="75px" width="75px"  src='<?php echo Yii::app()->theme->baseUrl?>/img/eldato-main.png' />
                <br />
         <h3 class="logon-brand text-center center-block" style="margin-top: 0px;padding-top: 0px;font-size: 35px;" >el dato</h3>
        </div>            
        <div class="panel panel-default panel-logon">         
            <div class="panel-body">
                <label><?php echo Yii::t('login','Recuperar Contraseña')?></label> 
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
                    'focus'=>array($model,'username'),
                ));
                ?>
               	<div class="form-group">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('style'=>'max-width:300px','size'=>60,'maxlength'=>150,"class"=>"form-control")); ?>
		<?php echo $form->error($model,'email'); ?>
                </div>
                    <?php if ($model->scenario == 'withCaptcha' && CCaptcha::checkRequirements()): ?>
                    <hr/>
                    <div class="form-group">
                            <?php echo $form->labelEx($model, 'verifyCode'); ?>
                        <div>
                        <?php $this->widget('CCaptcha'); ?></br>
                        <?php echo $form->textField($model, 'verifyCode'); ?>
                        </div>
                    <?php echo $form->error($model, 'verifyCode'); ?>
                    </div>
                <?php endif; ?>
                <?php echo CHtml::submitButton(Yii::t('login','Enviar'), array("class" => "btn btn-lg btn-block btn-black")); ?>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>
