<?php

class CategoriasController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('VerPorCategoria'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	
        /**
	 * Muestra los avisos por orden de categoria
	 * @param nombre de la categoria
	 */
	public function actionVerPorCategoria()
	{
		//echo $nombre;
                $nombreCategorya= $_GET['nombre'];
                $categoria = CActiveRecord::model("Categorias")->find("estado=? and nombre=?",array("ACTIVO",$nombreCategorya));
                if ($categoria==null)
                    throw new CHttpException(404,'The requested page does not exist.');
                
                $dataProvider=new CActiveDataProvider('Dato', array(
                            'criteria'=>array(
                                'condition'=>'estado=:estado and categoria_id=:categoria_id',
                                'params' => array(':estado' =>'ACTIVO',':categoria_id' =>$categoria->id), //array'
                                'order'=>'creado DESC',                                
                            ),
                            'pagination'=>array(
                                'pageSize'=>10,
                            ),
                ));
                $categoriaName=$categoria->nombre;
                 if ( Yii::app()->language =='en'){
                     $categoriaName=$categoria->name;
                 }
		$this->render('index', array(
                        'dataProvider'=>$dataProvider,
                        'categoria'=>$categoriaName,
                    ));
	}

}
