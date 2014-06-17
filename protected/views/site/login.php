
<div class="container" >
        <div style="margin: 50px auto;max-width: 350px;">
            <div class="center-block text-center"  >
                <img  height="75px" width="75px" src='<?php echo Yii::app()->theme->baseUrl?>/img/eldato-main.png' />
                <br />
         <h3 class="logon-brand text-center center-block" style="margin-top: 0px;padding-top: 0px;font-size: 33px;" >el dato</h3>
        </div>
            
        <div class="panel panel-default panel-logon">
              
           
            <div class="panel-body">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'login-form',
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
                    <?php echo $form->labelEx($model, 'username'); ?>
                    <?php echo $form->textField($model, 'username', array("class" => "form-control")); ?>
                    <?php echo $form->error($model, 'username'); ?>
                </div>
                <div class="form-group">          
                    <?php echo $form->labelEx($model, 'password'); ?>
                    <?php echo $form->passwordField($model, 'password', array("class" => "form-control")); ?>
                    <?php echo $form->error($model, 'password'); ?>
                </div>
                <div class=" rememberMe">
                    <?php echo $form->checkBox($model, 'rememberMe'); ?>
                    <?php echo $form->label($model, 'rememberMe'); ?>
                    <?php echo $form->error($model, 'rememberMe'); ?>
                    
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
                    <div class="pull-right">
                        <?php echo CHtml::link(Yii::t('login','(has olvidado tu contraseña?)'), array('usuarios/recuperar')); ?>
                    </div>
                <hr/>
                <?php echo CHtml::submitButton(Yii::t('login','Entrar'), array("class" => "btn btn-lg btn-block btn-black")); ?>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>
