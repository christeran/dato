<?php
/* @var $this SiteController */
$this->pageTitle = Yii::app()->name;
?>
<div class="col-lg-12 col-md-12 col-sm-12 titulo-main-body" > 
    <div class="formulario-titulo"><?php echo Yii::t('app','Categoria')?> : <?php echo $categoria ?></div>
</div>

    <!-- start UNI post-->
   <div class="col-lg-9 col-md-9 col-sm-12 body-page" >     
            <div class="datos-lista">
            <?php
            $this->widget('ext.listview.HeaderListView', array(
                'dataProvider' => $dataProvider,
                'itemView' => '/dato/_avisoItem',
                'summaryText' => "",
                'ajaxUpdate' => false,
            ));
            ?>            
            </div>    
        </div>                       
    <!-- end UNI post-->        
</div>
<!-- end posts -->
<!-- end posts -->

<!-- start right options -->
<div class="col-lg-3  col-md-3  feature visible-lg visible-md widget-page"  >  
<?php $this->widget('CategoriasPanel') ?>
    <?php $this->widget('MasLikesPanel') ?>

</div><!-- end feature -->
<!-- end right options -->


