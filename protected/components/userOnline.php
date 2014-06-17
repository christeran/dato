<?php

class userOnline extends CWidget {

    public function run() {

//        $criteria = new CDbCriteria();
//        $criteria->group = 'dato_id';
//        $criteria->order  = 'count(*) desc';
//        $criteria->limit  = 3;
//        $criteria->condition  = 'rate=1';
//        $criteria->select='count(*) as rate ,dato_id';
//        $model = LikeDato::model()->findAll($criteria);
        
        echo "<h2>Users Online</h2>";
                 
        $users = Yii::app()->db->createCommand()
                ->select("u.id, username, TIMESTAMPDIFF(MINUTE, last_activity, DATE_SUB(UTC_TIMESTAMP(),INTERVAL 5 HOUR))")
                ->from('usuario u')
                ->join("visitor v", 'u.id=v.usuario_id')
                ->where('TIMESTAMPDIFF(MINUTE, last_activity, DATE_SUB(UTC_TIMESTAMP(),INTERVAL 5 HOUR)) < 5')
                ->queryAll();
                if (isset($users)) {
                    
                foreach ($users as $user)
                        if (isset($user)) { 
                        echo '<b>' . ucfirst($user['username']) . '</b> <small>(';
                        echo 'Last activity ' . $user['TIMESTAMPDIFF(MINUTE, last_activity, DATE_SUB(UTC_TIMESTAMP(),INTERVAL 5 HOUR))'] . ' minutes ago)</small><br/>';
                        }
                } else {
                echo 'none';
                }

//        $this->render('MasLikesPanel', array(
//            'model' => $model
//        ));
    }

}
