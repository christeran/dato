<?php

class CategoriasPanel extends CWidget {

    public function run() {
        $models = Categorias::model()->findAll("estado=?",array("ACTIVO"));

        $this->render('CategoriasPanel', array(
            'models'=>$models   
        ));
    }
}
