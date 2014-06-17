<!-- Start Category -->
<h4><?php echo Yii::t('menu','Categoría')?></h4>
<div class="categorias">
<ul class="list-group list-special" >  
    <?php foreach ($models as $model): ?>
         <li class="list-group-item">
        <a href="<?php echo Yii::app()->createUrl('categoria/' . $model->nombre); ?>">
            <?php if ( Yii::app()->language =='en'){?>
            <span class="glyphicon glyphicon-chevron-right pull-left"></span>&nbsp;<?php echo $model->name; ?> 
            <?php }else{?>
            <span class="glyphicon glyphicon-chevron-right pull-left"></span>&nbsp;<?php echo $model->nombre; ?> 
            <?php }?>
        </a>
       </li> 

        <?php endforeach; ?> 
</ul>
</div>