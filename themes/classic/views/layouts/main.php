<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <link rel="SHORTCUT ICON" href="<?php echo Yii::app()->theme->baseUrl?>/img/eldato-ico.png"/>
        <link rel="apple-touch-icon" href="<?php echo Yii::app()->theme->baseUrl?>/img/eldato-ico.png"/>

        <!-- blueprint CSS framework -->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet" />
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-dialog.min.css" rel="stylesheet" />
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/dato.css" rel="stylesheet"/>
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->
        
        
            <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>
    <body>

        <header>
            <div id="navbar-main" class="navbar-main  navbar navbar-inverse  navbar-static-top" role="navigation">
                <!--start searchbar -->
                <div class="container">
                    <div class="navbar-header pull-left" style="margin-left: 15px;">
                        <a class="navbar-brand" href="<?php echo Yii::app()->createUrl('site/') ?>"   >
                            <img  src='<?php echo Yii::app()->theme->baseUrl?>/img/eldato-bar-logo.png' />
                            <span style="margin-top: 5px;padding-top: 5px" ><?php  echo CHtml::encode(Yii::app()->name); ?></span>
                        </a>
                    </div>
                    <div class="col-xs-7 col-sm-7 col-md-5 col-lg-4 pull-right">
                        <!-- start SEARCH navbar-form 
                        <form style="margin-top: 10px">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term" style="height: 28px;line-height: 28px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-black" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                    </div>
                            </div>
                        </form>
                         end navbar-form -->
                    </div>
                </div>
                <!--end container-->
                <!--end searchbar -->
            </div><!--end navbar -->


            <div id="navbar-search" class="navbar navbar-default  navbar-static-top ">
                <div class="container">
                    <div class="navbar-header">
                        <button  type="button" class="navbar-toggle" data-target=".navbar-responsive-collapse" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span> 
                        </button>
                    </div>

                    <div class="navbar-collapse collapse navbar-responsive-collapse">                        
                        <?php $this->widget('mainMenu')?>

                        <!-- start user registration -->                        
                        <?php
                        $this->widget('zii.widgets.CMenu', array(
                            'encodeLabel' => false,
                            'htmlOptions' => array('class' => 'nav navbar-nav pull-dynamic'),
                            'items' => array(
                                array('label' => Yii::t('menu','Regístrate'), 'url' => array('/usuarios/registrar'), 'visible' => Yii::app()->user->isGuest),
                                array('label' => Yii::t('menu','Ingresar') , 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                                array('label' => Yii::t('menu','Hola ,  ')  . strtoupper(Yii::app()->user->name) . '<strong class="caret"></strong>',
                                    'url' => '#',
                                    'visible' => !Yii::app()->user->isGuest,
                                    'submenuOptions' => array('class' => 'dropdown-menu'),
                                    'items' => array(
                                        array('label' => '<span class="glyphicon glyphicon-wrench"></span> '.Yii::t('menu','Perfil'), 'url' => array('/usuarios/actualizar'),),
                                        array('label' => '<span class="glyphicon glyphicon-refresh"></span> '.Yii::t('menu','Contraseña'), 'url' => array('/usuarios/CambiarPassword'),),
                                        array('label' => '<span class="glyphicon glyphicon-off"></span> '.Yii::t('menu','Salir'), 'url' => array('/site/logout'))
                                    ),
                                    'itemOptions' => array('class' => 'dropdown'),
                                    'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'),
                                ),
                            ),
                        ));
                        ?>
                        <!-- end user registration -->

                    </div><!-- end div collapse-->                    

                </div><!--end container-->
            </div>
            
        </header>

        <?php if(($msgs=  Yii::app()->user->getFlashes())!==null):?>
        <br/>
        <div class="container">
            <div class="row">
                <div class="span12">
                    <?php foreach ($msgs as $type=>$message):?>      
                      <div class="alert alert-<?php echo $type ?>">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                          <?php echo $message ?>
                      </div>
                    <?php endforeach;?>
                </div>
            </div> 
          </div>
        <?php endif;?>
        
        <div class="container">
            <?php echo $content; ?>
        </div>
        <footer>
            <div class="container">
                <p class="footer-content">El dato.pe</p>
                <div class="pull-right">
                <?php echo Chtml::link('English',$this->createUrl('',array('lg'=>'en')))?>
                <?php echo Chtml::link('Español',$this->createUrl('',array('lg'=>'es')))?>
                </div>        
            </div>
        </footer>

        <div class="clear"></div>

        <!-- All Javascript at the bottom of the page for faster page loading -->
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        <!-- First try for the online version of jQuery-->
<!--        <script src="http://code.jquery.com/jquery.js"></script>-->

        <!-- If no online access, fallback to our hardcoded version of jQuery -->
<!--        <script>window.jQuery || document.write('<script src="includes/js/jquery-1.8.2.min.js"><\/script>')</script>
         <script>
           $.noConflict();
        </script>-->
        <!-- Bootstrap JS -->
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.js"></script>
       
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap-dialog.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/dato.js"></script>

        <!-- Custom JS 
        <script src="includes/js/script.js"></script>
        -->
        <?php
            Yii::app()->clientScript->registerScript('helpers', '
                    baseUrl = '.CJSON::encode(Yii::app()->baseUrl).';
            ');

//            Yii::app()->clientScript->registerScriptFile(
//            Yii::app()->theme->baseUrl.'/js/dato.js',
//            CClientScript::POS_END);
        ?>
    </body>
</html>
