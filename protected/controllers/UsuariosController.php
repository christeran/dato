<?php

class UsuariosController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
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
    public function accessRules() {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('registrar', 'activar','email','Recuperar','cambiar'),
                'users' => array('*'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('CambiarPassword', 'actualizar'),
                'users' => array('@'),
            ),
            array('allow', // allow specific user to perform 'update' actions
                'actions' => array('update'),
                //'users'=>array('@'),
                'users' => array(Yii::app()->user->name),
                'expression' => '(Yii::app()->user->id == ($_GET["id"]))',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {

        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Usuarios;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Usuarios'])) {

            $model->attributes = $_POST['Usuarios'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionActualizar() {
        $id=Yii::app()->user->getId();
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Usuarios'])) {
            $model->attributes = $_POST['Usuarios'];
            if ($model->SaveAttributes(array('nombre','apellido')))
                Yii::app()->user->setFlash("success","Su perfil ha sido actualizado");
        }

        $this->render('actualizar', array(
            'model' => $model,
        ));
    }



    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Usuarios');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionRegistrar() {

        $model = new Usuarios;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Usuarios'])) {
            $model->attributes = $_POST['Usuarios'];
            $model->activation_key = sha1(mt_rand(10000, 99999) . time() . $model->email);

            //----------------------------------------------------------
            // ENVIAR EMAIL A USUARIO DEL POST
            //----------------------------------------------------------
            
            if ($model->validate()) {
                $email = new Email();
                $email = $email->create();
                $email->Subject = "El dato.pe - Confirmacion de usuario";            
                $email->AddAddress($model->email);           
                $email->Body = $this->renderPartial('/templateEmail/confirmacion', array('usuario' => $model), true);            
                $email->Send();
                $model->save();
                Yii::app()->user->setFlash("success", "Acabamos de enviar un email a '" . $model->email . "' para confirmar su registracion");
                $this->redirect(array('site/index'));
            }
        }
        $this->render('registrar', array(
            'model' => $model,
        ));
    }

    public function  actionEmail(){
        $model = new Usuarios;
        $this->renderPartial('/templateEmail/confirmacion', array('usuario' => $model));
    }

    /**
     * activa codigo enviador por email
     */
    public function actionActivar() {
        $key = Yii::app()->request->getQuery('key');
        $model = Usuarios::model()->findByAttributes(array(
            'activation_key' => $key
        ));
        if ($model === null)
            throw new CHttpException(404, 'Key no valida');
       elseif ($model->estado=="ELIMINADO") {
            Yii::app()->user->setFlash("danger","Este usuario no existe");
        }
        else{
            $model->estado = 'ACTIVO';
            $model->activation_key = '';
            $model->SaveAttributes(array('estado','activation_key'));
            Yii::app()->user->setFlash("success","Usuario Activado");
        }        
        $this->redirect(array('site/login'));
    }

    public function actionCambiarPassword() {
        $model = new ChangePasswordForm;
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'CambiarPassword-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        
        // collect user input data
        if (isset($_POST['ChangePasswordForm'])) {
            $model->attributes = $_POST['ChangePasswordForm'];
            // Validar input del usuario y cambiar contraseña.
            if ($model->validate() && $model->changePassword()) {
                Yii::app()->user->setFlash('success', '<strong>Éxito!</strong> Su contraseña fue cambiada.');
                $this->redirect($this->action->id);
            }
        }
       
        // Mostrar formulario de cambio de contraseña.
        $this->render('cambiarPassword', array('model' => $model));
    }
    public function actionRecuperar() {
        $model = new Usuarios;
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'recuperar-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        
         if (isset($_POST['Usuarios'])) {
                $model->attributes = $_POST['Usuarios'];
                $usuario_model = Usuarios::model()->findByAttributes(array(
                                                'email' => $model->email
                                                             ));

            if ($usuario_model === null)
                throw new CHttpException(404, 'Este email no se encuentra registrado');
            $recuperarEmail = new RecuperarEmails;
            $recuperarEmail->usuario_id=$usuario_model->id;
            $recuperarEmail->key=sha1(mt_rand(10000, 99999) . time() . $usuario_model->email);
            $startDate = time();            
            $recuperarEmail->exp_date=date('Y-m-d H:i:s', strtotime('+1 day', $startDate));
            //------------------------------------------------------------------
            //SEND EMAIL
            //------------------------------------------------------------------
            $email = new Email();
            $email = $email->create();
            $email->Subject = "El dato.pe - Recuperar contraseña";            
            $email->AddAddress($usuario_model->email);           
            $email->Body = $this->renderPartial('/templateEmail/recuperar', array('recuperar' => $recuperarEmail), true);            
            $email->Send();
            $recuperarEmail->save();
            Yii::app()->user->setFlash("success", "Acabamos de enviar un email a '" . $model->email . "' para cambiar su contraseña");    
         }
        // Mostrar formulario de cambio de contraseña.
        $this->render('recuperarPassword', array('model' => $model));
    }

     
    public function actionCambiar() {
        $key = Yii::app()->request->getQuery('key');
        $recuperar_model = RecuperarEmails::model()->findByAttributes(array(
            'key' => $key
        ));
        
        if ($recuperar_model === null)
            throw new CHttpException(404, 'Key no valida');
        if ($recuperar_model->exp_date < date('Y-m-d H:i:s'))
            throw new CHttpException(404, 'Lo sentimos, el link se encuentra vencido');
        
       $model = $this->loadModel($recuperar_model->usuario_id);

        // Uncomment the following line if AJAX validation is needed
        if (isset($_POST["ajax"]) and  $_POST["ajax"]==="recuperar-form")
        {
                echo CActiveForm::validate($model);
                Yii::app()->end();
        }

        if (isset($_POST['Usuarios'])) {
            $model->attributes = $_POST['Usuarios'];
            if ($model->validate()) {
                 //delete records from recuperar table
                $dbc = new CDbcriteria();
                $dbc->condition = 'usuario_id = :usuario_id';
                $dbc->params = array(':usuario_id'=>$recuperar_model->usuario_id);
                RecuperarEmails::model()->deleteAll($dbc);               
                $model->password = md5(md5($model->password).Yii::app()->params["salt"]); 
                if ($model->SaveAttributes(array('password'))){                    
                    Yii::app()->user->setFlash("success","contraseña ha sido cambiada");
                    $this->redirect(array('site/login'));
               }    
            }
        }

        $this->render('recuperar', array(
            'model' => $model,
        ));
        

        
       
    }
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Usuarios the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Usuarios::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Usuarios $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'usuarios-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
