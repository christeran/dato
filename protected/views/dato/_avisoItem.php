<?php
/* @var $this DatoController */
/* @var $data Dato */
?>
<?php
$creado = strtotime($data->creado);
$now = strtotime(date('Y-m-d H:i:s'));
$dif = $now - $creado;
$publicado = null;
if ($dif <= 60) {
    $publicado = "hace " . $dif . " seg";
} else if (($dif = floor($dif / 60)) <= 60) {
    $publicado = "hace " . $dif . " min";
} else if (($dif = floor($dif / 60)) <= 24) {
    $publicado = "hace " . $dif . "hora(s)";
} else {
    $publicado = date('d M y', strtotime($data->creado));
}

$like_class = "label-like";
$dislike_class = "label-dislike";
if (isset($data->user_like)) {
    if ($data->user_like->rate == 1)
        $like_class = "label-success";
    if ($data->user_like->rate == 2)
        $dislike_class = "label-danger";
}
?>



<div class="dato" style="<?php echo (isset($data->foto)) ? "min-height: 150px;" : "height: auto" ?>">
   
    <?php if (isset($data->foto)){ ?>
        <img style="margin-top: 5px;" src="data:image/jpeg;base64,<?php echo base64_encode($data->foto) ?>" class="dato-imagen" />
    
    <?php }    ?>
       
    	
        <h2 class="dato-titulo" >
        <?php echo  CHtml::link(CHtml::encode(ucfirst($data->titulo)), array('dato/ver', 'id' => $data->id),array('class' => 'dato-titulo')); ?>
    </h2>
    <div class="cabezera">
        <span class="autor">
            <a style="" href="#" ><?php echo strtoupper($data->Usuarios->username) ?></a>
        </span>  
        <span class="fecha"><?php echo strtoupper($publicado) ?></span>
        <?php if (!empty($data->url)): ?>
            <span class="glyphicon glyphicon-link"><?php echo CHtml::link(CHtml::encode('URL'), array('dato/link', 'id' => $data->id), array("target"=>"_blank")); ?>
            </span>
<!--            (<?php //echo $data->click ?> visitas)-->
        <?php endif; ?>
       
   
        - <?php echo Yii::t('app','EN'); ?> : <b><?php echo strtoupper($data->Categorias->nombre) ?></b>        
            <?php echo ($data->gratis == "1") ? " |<span class='label label-gratis'>".Yii::t('app','GRATIS')."</span>" : "" ?>        
   
    </div>     
    <div class="descripcion">
        <?php
        $descripcion = preg_replace('/\s+/', ' ', strip_tags($data->descripcion));
        echo (mb_strlen($descripcion) < 220) ? $descripcion : substr($descripcion, 0, 220) . "..."
        ?>		
    </div><!-- .entry-excerpt -->	
    <div class="footer" style="margin-top: 10px">
        <ul class="list-inline pull-left img-ad">                            
            <li>
                <a class="top" title="" data-placement="top" data-toggle="tooltip" href="#" data-original-title="Me Gusta" style="text-decoration:none">
                    <span  class="like-button label <?php echo $like_class ?> like<?php echo ($data->id) ?>" rel="<?php echo $data->id ?>">
                        <span class="  glyphicon glyphicon-thumbs-up" style="margin-right: 4px;" ></span><?php echo count($data->likes) ?>

                    </span>
                </a>
                &nbsp;
                <a class="top" title="" data-placement="top" data-toggle="tooltip" href="#" data-original-title="No me gusta" style="text-decoration:none">
                    <span class="dislike-button label <?php echo $dislike_class ?> dislike<?php echo ($data->id) ?>" rel="<?php echo $data->id ?>">
                        <span class=" glyphicon glyphicon-thumbs-down" style="margin-right: 4px;" ></span><?php echo count($data->dislikes) ?>
                    </span>
                </a>    
            </li>
        </ul>
        
        <a class="comentarios" href="<?php echo Yii::app()->createUrl('dato/ver/' . $data->id . '#comentarios') ?>">
            <img src='<?php echo Yii::app()->theme->baseUrl?>/img/comment.png'/><?php echo count($data->comentarios) . " ".Yii::t('app','Comentario(s)') ?>
       </a> 
        
        <?php echo (isset($data->fecha_expedicion)) ? " <img  class='calendar-icon' src='". Yii::app()->theme->baseUrl."/img/calendar.png'/> ".Yii::t('app','HASTA')." ". $data->fecha_expedicion : "" ?> 
        
    </div>
    <div class="clear"></div>	
</div>



