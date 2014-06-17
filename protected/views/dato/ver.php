<meta name="title" 
      content="<?php echo ucfirst ($model->titulo)?>">
<meta name="description" 
      content="<?php
        $descripcion = preg_replace('/\s+/', ' ', strip_tags($model->descripcion));
        echo (mb_strlen($descripcion) < 220) ? $descripcion : substr($descripcion, 0, 220) . "..."
        ?>" />
<?php if (isset($model->foto)){?>
    <link rel="image_src" href="<?php echo Yii::app()->getBaseUrl(true) ?>/dato/image/<?php echo $model->id?>" />
<?php }else {?> 
    <link rel="image_src" href="<?php echo Yii::app()->theme->baseUrl?>/img/eldato-main.png" />
<?php } ?>
 
<?php
/* @var $this DatoController */
/* @var $model Dato */
$this->pageTitle= ucfirst ($model->titulo);
?>
    <div class="container">
            <div class="col-lg-9 ">
                <div class="ver-dato">
                <!-- the actual blog post: title/author/date/content -->
                    <div class="titulo"><?php echo ucfirst ($model->titulo) ?></div>
                    <p  style="color: #888888;font-size: 16px"><?php echo Yii::t('app','Por')?> <a  style="color: #3b7dc1;font-style: italic" href="#"><?php echo ucfirst ($model->Usuarios->username); ?></a>
                        <br/>
                        <span class="glyphicon glyphicon-time"></span> <?php echo date('d F Y', strtotime( $model->creado))." ". Yii::t('app','a las')." ".date('h:i a', strtotime( $model->creado)) ?>
                    </p>
                    <div class="ver-detalles">
                        <div class="informacion" >
                            <div class="imagen" >
                                <?php if (!empty($model->foto)){?>
                                    <img  class="img-thumbnail img-responsive center-block"  src="data:image/jpeg;base64,<?php echo base64_encode( $model->foto ) ?>" >                         
                                <?php }else{?>
                                    <img style="float:left; width:100px;height:100px;"  class="img-thumbnail img-responsive center-block "  src="<?php echo Yii::app()->theme->baseUrl; ?>/img/eldato-main.png" >                         

                                <?php } ?>
                            </div>  
                            <div class="descripcion">
                            <p><?php echo $model->descripcion?></p>    
                            </div>                        
                        </div>
                    </div>  
                  </div>   
                    <!--table-->
                    <br/>
                    <table class="table table-hover  table-border-bottom  " >
                            <thead>
                                <tr>
                                    <th colspan="4">
                                        <?php echo Yii::t('app','Detalles')?>
                                    </th>
                                    
                                </tr>
                            </thead>
                            <tr >
                                <td style="width:25%">
                                    <?php echo Yii::t('app','Categoria')?>
                                </td>
                                <td style="width: 25%">                                    
                                    <?php 
                                     if ( Yii::app()->language =='en'){
                                        echo ucfirst ($model->Categorias->name); 
                                     }else{
                                         echo ucfirst ($model->Categorias->nombre); 
                                     }
                                    ?>
                                </td>
                                <td style="width:135px;">
                                    Link
                                </td>
                                <td style="color:#888888 ">
                                    <?php if (!empty($model->url)){ 
                                        echo CHtml::link(CHtml::encode(parse_url($model->url, PHP_URL_HOST)), array('dato/link', 'id'=>$model->id), array("target"=>"_blank")).' ('.($model->click).") clicks";
                                    }else{
                                        echo "No Link";
                                    }?>   
                                </td>
                            </tr>
                            <tr >
                                <td style="width:110px;">
                                    <span class="text-success" style="font-weight: bold"> <?php echo Yii::t('app','Me gustan')?></span>
                                </td>
                                <td
                                    <span class="text-success" style="font-size: 15px;font-weight: bold"><?php echo count($model->likes) ?></span>
                                </td>
                                <td>
                                    <span class="text-danger" style="font-size: 15px;font-weight: bold"> <?php echo Yii::t('app','No me gustan')?> </span>
                                </td>
                                <td>
                                    <span class="text-danger" style="font-size: 15px;font-weight: bold"><?php echo count($model->dislikes) ?></span>
                                </td>
                            </tr>
                        </table> 
                    <!--end-table-->
                  
                <br/>
                <div class="alert alert-dismissable alert-extras">
<!--                <a href="#" class="alert-link">alert needs your attention</a>-->                    
                        <strong><?php echo Yii::t('app','Information Extras')?> :</strong>                    
                    <ul>
                        <?php if (!empty($model->direccion)):?>
                        <li>
                            <?php echo Yii::t('app','Direccion')?>  : <span style="color:#008ab1"><?php echo ucfirst( $model->direccion) ?></span>
                        </li>
                        <?php endif;?>

                        <?php if (!empty($model->gratis)):?>
                        <li>
                            <span class="label label-gratis"><?php echo ($model->gratis=="1")? Yii::t('app','GRATIS'):"" ?></span> 
                        </li>
                        <?php endif;?>
                        <?php if (!empty($model->fecha_expedicion)):?>
                        <li>
                            <img class="calendar-icon" src='<?php echo Yii::app()->theme->baseUrl ?>/img/calendar.png'/> <?php echo Yii::t('app','HASTA')." ". ($model->fecha_expedicion)?>
                        </li>
                        <?php endif;?>
                    </ul>
                 </div>
                <h3 class="comentario"><?php echo count($model->comentarios)?> <?php echo Yii::t('app','Comentario(s)')?></h3>
                <div class="comentario-space"></div>
                <?php 
                foreach ($model->comentarios as $comentario):
                ?>                    
                <div style="margin:0px;padding: 0px;" >
                        <span style="color:#888888;"><?php echo Yii::t('app','Por')?> :<strong><?php echo ucfirst ($comentario->usuario->username)?></strong></span>
                        <br/>
                        <div style="padding-top: 0px;margin-left: 10px;margin-right: 10px">
                         <?php echo ucfirst($comentario->descripcion)?>
                         </div>   
                        <div class="pull-right">
                            <span style="color:#888888 "><?php echo Yii::t('app','Enviado')?>  : <strong><?php echo  date('d F Y h:i a', strtotime( $comentario->creado)) ?></strong></span>                            
                        </div>
                        
                    </div>
                <hr/>
                <?php
                endforeach;
                ?>
                <a name="comentarios"></a>
                <!-- the comment box -->
                <div class="well">
                    <?php if (!Yii::app()->user->isGuest):?>
                        <h4><?php echo Yii::t('app','Deja un comentario')?>:</h4>
                        <?php $form=$this->beginWidget('CActiveForm', array(
                                'id'=>'comentarios-form',
                                // Please note: When you enable ajax validation, make sure the corresponding
                                // controller action is handling ajax validation correctly.
                                // There is a call to performAjaxValidation() commented in generated controller code.
                                // See class documentation of CActiveForm for details on this.
                                'enableAjaxValidation'=>true,
                                'clientOptions' => array(
                                    'validateOnSubmit'=>true,
                                    'validateOnChange'=>false,
                                    'validateOnType'=>false,
                                ),
                        )); ?>
                        <?php echo $form->hiddenField($model_comentario,'dato_id',array('type'=>"hidden")); ?>
                       <div class="form-group">
                                <?php echo $form->textArea($model_comentario,'descripcion',array('class'=>'form-control' ,'size'=>60,'maxlength'=>350)); ?>
                                <?php echo $form->error($model_comentario,'descripcion'); ?>
                       </div>
                       <?php
                       $btnSend=Yii::t('app','Enviar');
                       $lblWait=Yii::t('app','Por favor espere');
                        echo CHtml::ajaxSubmitButton($btnSend,Yii::app()->request->url,  
                                      array('success'=>'function(data){location.reload();}','beforeSend' => "function(){
                                     
                                     $('#btn_comentario').attr('disabled', true).val('".$lblWait."...');
                                        }"),   
                                      array('class'=>'btn btn-black','id' => 'btn_comentario' )                           
                                          
                                );
                                          
                       
                        ?>
                        <?php $this->endWidget(); ?>
                     <?php else:?>
                        <strong>Recuerde que debe estar 
                            <?php  echo  CHtml::link("Logeado", array('site/login'));?> o
                            <?php  echo  CHtml::link("Registrado", array('usuarios/registrar'));?>
                            para poder comentar</strong>
                        
                        
                     <?php endif;?>
                </div>
            </div>
            <div class="col-lg-3     visible-lg visible-md">                  
                <br/>
            <?php $this->widget('CategoriasPanel') ?>
            </div>
        </div>

