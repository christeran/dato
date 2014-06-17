<?php

class LikeDatoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('like'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


        	/**
	 * Gustar post
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionLike()
	{
            $dato_id=$_POST["dato_id"];
            $usuario_id=Yii::app()->user->getId();            
            extract($_POST);
            
            $criteria = new CDbCriteria;
            $criteria->condition = "dato_id = $dato_id and usuario_id = $usuario_id  and rate= 1";
            $likes = CActiveRecord::model("LikeDato")->findAll($criteria);
            $likes = count($likes);
            
            $criteria = new CDbCriteria;
            $criteria->condition = "dato_id = $dato_id and usuario_id = $usuario_id and rate= 2";
            $dislikes = CActiveRecord::model("LikeDato")->findAll($criteria);
            $dislikes = count($dislikes);
            
            if($act == 'like'): //if the user click on "like"
                
                if (($likes==0)&& ($dislikes == 0)):
                   $model=new LikeDato;
                   $model->dato_id=$dato_id;
                   $model->usuario_id = $usuario_id; 
                   $model->rate = 1; 
                   $model->Save();                   
               endif;
               if ($dislikes==1):
                   $model=  LikeDato::model()->find("dato_id=$dato_id and usuario_id=$usuario_id");
                   $model->dato_id=$dato_id;
                   $model->usuario_id = $usuario_id; 
                   $model->rate = 1; 
                   $model->Save();
               endif;
               
            endif;
            if($act == 'dislike'): //if the user click on "like"
                if (($likes==0)&& ($dislikes == 0)):         
                    $model=new LikeDato;               
                    $model->dato_id=$dato_id;
                    $model->usuario_id = $usuario_id; 
                    $model->rate = 2; 
                    $model->Save();
               endif; 
               if ($likes==1):
                   $model=  LikeDato::model()->find("dato_id=$dato_id and usuario_id=$usuario_id");
                   $model->dato_id=$dato_id;
                   $model->usuario_id = $usuario_id; 
                   $model->rate = 2; 
                   $model->Save();
               endif;
               
            endif;
        }

}
