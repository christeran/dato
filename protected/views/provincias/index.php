<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<h1 style="color:#821515;"><i><?php echo $provincia ?></i></h1>

<div class="row" >

    <!-- start posts -->
    <div class="col-lg-9 col-md-9 col-sm-12 feature">    

        <!-- start UNI post-->
        <div class="row">    
            <div class="col-md-12 col-sm-12" >                
                <?php               
                   
                $this->widget('ext.listview.HeaderListView', array(
                    'dataProvider' => $dataProvider,
                    'itemView' => '/dato/_avisoItem',
                    'summaryText' => "viendo {start} - {end} de {count}",
   
        'ajaxUpdate' => false,
                ));
                ?>
                <!-- dato -->

                <!-- dato -->
            </div>
        </div>                        
        <!-- end UNI post-->                     
        <br/>  
    </div>
    <!-- end posts -->
    <!-- end posts -->

    <!-- start right options -->
    <div class="col-lg-3  col-md-3  feature visible-lg visible-md">                  
        <?php $this->widget('CategoriasPanel') ?>
        <?php $this->widget('MasLikesPanel') ?>


    </div><!-- end feature -->
    <!-- end right options -->

</div><!-- end features -->
</div>
</div>


