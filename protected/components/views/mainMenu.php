
<?php

$this->widget('zii.widgets.CMenu', array(
    'encodeLabel' => false,
    'htmlOptions' => array('class' => 'nav navbar-nav'),
    'items' => array(
        array('label' => Yii::t('menu','Publicar'), 'url' => array('/dato/enviar')),
        array('label' => Yii::t('menu','Categoría'),
            'url' => '#',
            'submenuOptions' => array('class' => 'dropdown-menu'),
            'items' => $categorias,
            'itemOptions' => array('class' => 'dropdown'),
            'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'),
        ),
    ),
));
?>

