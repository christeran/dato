<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>
<div class="col-lg-12 col-md-12 col-sm-12 titulo-main-body" > 
    <div class="formulario-titulo"><?php echo Yii::t('app','Descuentos, ofertas y articulos <span class="formulario-brand">gratis!!</span>')?></div>
</div>
<!-- start posts -->
<div class="col-lg-9 col-md-9 col-sm-12 body-page" >   
    <!-- start UNI post-->
            <div class="datos-lista">
            <?php
            $this->widget('ext.listview.HeaderListView', array(
                'dataProvider' => $dataProvider,
                'itemView' => '/dato/_avisoItem',
                'enablePagination' => true,
                'summaryText'=>'',
                'ajaxUpdate' => false,
                'pager' => array(
                    'header' => '',
                    'cssFile' => false,
                    'maxButtonCount' => 25,
                    'selectedPageCssClass' => 'active',
                    'firstPageCssClass' => 'hidden',
                    'lastPageCssClass' => 'hidden',
                    'firstPageLabel' => 'Primero',
                    'lastPageLabel' => 'Ultimo',
                    'prevPageLabel' => '<',
                    'nextPageLabel' => '>',
                    "htmlOptions" => array("class" => "pagination pagination-sm"),
                ),
            ));
            ?>
    </div>                        
    <!-- end UNI post-->   
</div>
<!-- end posts -->
<!-- start right options -->
<div class="col-lg-3  col-md-3  feature visible-lg visible-md widget-page"  >  
    <!--<div  data-spy="affix" data-offset-top="50">-->    
    <?php //$this->renderPartial("M_suscribete") ?>
<!--    <div id="nav-wrapper">
        <div id="nav" class="navbar"  data-spy="affix">-->
    <?php $this->widget('CategoriasPanel') ?>   
    <?php $this->widget('MasLikesPanel') ?>
    <?php $this->widget('userOnline') ?>
<!--            </div>    </div>-->     
    <!--</div>-->
</div><!-- end feature -->
<!-- end right options -->


