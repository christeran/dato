<?php

class mainMenu extends CWidget {

    public function init() {
       
        $categorias = Categorias::model()->findAll("estado=?",array("ACTIVO"));
        foreach ($categorias as $row) {
           if ( Yii::app()->language =='en'){
                $categoriasMenu[] = array('label' => $row['name'], 'url' => array('categoria/'.$row['nombre']));
           }else{
               $categoriasMenu[] = array('label' => $row['nombre'], 'url' => array('categoria/'.$row['nombre']));
           }
        }     
         $this->render('mainMenu', array('categorias' => $categoriasMenu));     
    }
}
