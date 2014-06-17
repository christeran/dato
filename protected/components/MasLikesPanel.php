<?php

class MasLikesPanel extends CWidget {

    public function run() {

        $criteria = new CDbCriteria();
        $criteria->group = 'dato_id';
        $criteria->order  = 'count(*) desc';
        $criteria->limit  = 3;
        $criteria->condition  = 'rate=1';
        $criteria->select='count(*) as rate ,dato_id';
        $model = LikeDato::model()->findAll($criteria);

        $this->render('MasLikesPanel', array(
            'model' => $model
        ));
    }

}
