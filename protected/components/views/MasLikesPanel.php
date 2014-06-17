<h4>Los datazos</h4>  
<div class="datazos">
     <ul class="list-group list-special " >

            <?php foreach ($model as $item) : ?>      
            <li class="list-group-item ">
                <div class="votes">
                    <span class=" label label-datazo" style="margin-right: 2px;"><?php echo ($item->rate) ?></span>                
                </div>
                <div class="item">
                    <div class="dato-titulo">
                        <div class="text" title="<?php echo $item->dato->titulo ?>" >
                            <?php echo CHtml::link(CHtml::encode($item->dato->titulo), array('dato/ver', 'id' => $item->dato->id)); ?> 
                        </div>
                     </div>   
                        <span class="entry-date"><img  class='calendar-icon' src='<?php echo Yii::app()->theme->baseUrl ?>/img/calendar.png'/><?php echo date('d F', strtotime($item->dato->creado)) ?>  </span>                    
                    
                </div>
                
                <div style="clear: both;"></div>
            </li>
           <?php endforeach; ?> 
   <ul>
 </div>      