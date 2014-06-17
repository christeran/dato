<?php

class DatoController extends Controller
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
				'actions'=>array('index','ver','link','Image','confirmacion'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('enviar','update','email'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','view'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	/**
	 * Ver dato  particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionVer($id)
	{
            $this->layout='//layouts/column1';
            $model_comentario=new Comentarios;
            $model_dato=$this->loadModel($id);
            $model_comentario->dato_id=$model_dato->id;
            $model_comentario->usuario_id = Yii::app()->user->getId(); 
         
            
            if (isset($_POST["ajax"]) and  $_POST["ajax"]==="comentarios-form")
            {
                echo CActiveForm::validate($model_comentario);
                Yii::app()->end();
            }
            if (isset($_POST["Comentarios"]))
            {
                
               // echo $model_dato->id;
                $model_comentario->attributes=$_POST["Comentarios"];
                if($model_comentario->validate())
                {
                    $model_comentario->save(); 
                    //----------------------------------------------------------
                    // ENVIAR EMAIL A USUARIOS QUE COMENTARON
                    //----------------------------------------------------------                    
                    $criteria = new CDbCriteria();
                    $criteria->group = 'usuario_id';
                    $criteria->condition  = "estado='ACTIVO' and 
                                             dato_id=$model_comentario->dato_id and 
                                             usuario_id<>$model_comentario->usuario_id and
                                             usuario_id<>$model_dato->usuario_id ";
                    $model = Comentarios::model()->findAll($criteria);
                   
                    if (! empty ($model)):
                        $email = new Email();
                        $email =$email->create();
                        $email->Subject= ucfirst($model_comentario->usuario->username).' comento en el dato "'.$model_comentario->dato->titulo.'"';

                        foreach ($model as $comentario):                            
                                if ($comentario->usuario->estado=='ACTIVO'):                                                    
                                    $email->AddCC  ($comentario->usuario->email);        
                                endif;                            
                        endforeach;
                        $email->Body= $this->renderPartial('/templateEmail/comentarioUsuarios',array('comentario'=>$model_comentario,'dato'=>$model_dato),true);
                       $email->Send();                     
                   endif;
                   //----------------------------------------------------------
                   // ENVIAR EMAIL A USUARIO DEL POST
                   //----------------------------------------------------------
                   if ($model_comentario->usuario_id!=$model_dato->usuario_id):
                       $email = new Email();
                       $email =$email->create();
                       $email->Subject= ucfirst($model_comentario->usuario->username).' comento en tu dato "'.$model_comentario->dato->titulo.'"';  
                       $email->AddCC  ($model_dato->Usuarios->email);                         
                       $email->Body= $this->renderPartial('/templateEmail/comentarioCreador',array('comentario'=>$model_comentario,'dato'=>$model_dato),true);
                       $email->Send();
                   endif;
                   Yii::app()->end();
                   //-----------------------------------------------------------
                }
            }
            $this->render('ver',array(
			'model'=>$model_dato,
			'model_comentario'=>$model_comentario,
            ));
	}
        
	public function actionImage($id)
	{
            $model_dato=$this->loadModel($id);
            

            header('Content-Type: image/jpg');
            header('Content-Disposition: inline; filename="eldato.jpg"');
            echo ($model_dato->foto); 
                
	}
	public function actionEmail($id)
	{
            $this->layout='//layouts/column1';
            $model_comentario=new Comentarios;
            $model_dato=$this->loadModel($id);
            $model_comentario->dato_id=$model_dato->id;
            $model_comentario->usuario_id = Yii::app()->user->getId();           
            
               // echo $model_dato->id;
                $model_comentario->attributes="asdasd";
                
                    
                    //----------------------------------------------------------
                    // ENVIAR EMAIL A USUARIOS QUE COMENTARON
                    //----------------------------------------------------------
                    $criteria = new CDbCriteria();
                    $criteria->group = 'usuario_id';
                    $criteria->condition  = "estado='ACTIVO' and dato_id=$model_comentario->dato_id and usuario_id<>$model_comentario->usuario_id and usuario_id<>$model_dato->usuario_id ";
                    $model = Comentarios::model()->findAll($criteria);
                   
                    
                     //$this->renderPartial('/templateEmail/comentarioCreador',array('comentario'=>$model_comentario,'dato'=>$model_dato),false);
                     $this->renderPartial('/templateEmail/comentarioUsuarios',array('comentario'=>$model_comentario,'dato'=>$model_dato),false);
                   //-----------------------------------------------------------
                
	}
        
          
    
	/**
	 * Abrir link dato  particular.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionLink($id)
	{
            $model=$this->loadModel($id);
            $model->click=$model->click+1;
            $model->SaveAttributes(array('click'));
            $this->redirect($model->url);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionEnviar()
	{
               $this->layout='//layouts/column1';
		$model=new Dato;

		
                // if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='enviar-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
                
		if(isset($_POST['Dato']))
		{
			$model->attributes=$_POST['Dato'];
                        
                        if(!empty($_FILES['Dato']['tmp_name']['foto']))
                        {
                            
                             
                            $file = CUploadedFile::getInstance($model,'foto');
                            //$model->fileName = $file->name;
                            $model->foto_tipo = $file->type;
                            $model->foto_size=$file->size;
                            //$model->foto=file_get_contents($file->tempName);
//                            $fp = fopen($file->tempName, 'r');
//                            $content = fread($fp, filesize($file->tempName));
//                            fclose($fp);
                            
                             $src_img = imagecreatefromstring(file_get_contents($file->tempName));
                             $dst_img = imagecreatetruecolor(200, 200);
                                //resize image 100x100
                             imagecopyresampled($dst_img, $src_img, 0,0,0,0, 200,200, imagesx($src_img), imagesy($src_img));
                             //imagejpeg($dst_img);                                
                             ob_start();
                                imagejpeg($dst_img);
                                imagedestroy($dst_img);
                                $image_string = ob_get_contents();
                             ob_end_clean ();
                                //end resize image
                            $model->foto = $image_string;
                        }
			if($model->save()){ 
                            Yii::app()->user->setFlash("success","Gracias por su Dato");
                            $this->redirect(array('site/index'));
                        }
		}

		$this->render('enviar',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Dato']))
		{
			$model->attributes=$_POST['Dato'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}



	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Dato the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Dato::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Dato $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='dato-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
