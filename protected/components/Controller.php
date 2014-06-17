<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
        
        public function __construct($id,$module=NULL) {
            parent::__construct($id,$module);
            if (isset($_GET['lg'])){
                Yii::app()->session['lg'] =$_GET['lg']; 
                Yii::app()->language=$_GET['lg'];
            }
             else if (isset(Yii::app()->session['lg'])){
                Yii::app()->language=Yii::app()->session['lg'];
             }
            else{
                Yii::app()->session['lg'] ='en'; 
                Yii::app()->language='en';
            }
            
        }
        
        public $users_online = null;
        public $visitorTableName = 'visitor';

        protected function beforeAction($action)
        {
                if(isset(Yii::app()->user->id)) {
                $user_id = Yii::app()->user->id;
                
                //TODO: Don't do this every time the app runs??
                
                $sql = "SELECT usuario_id FROM {$this->visitorTableName} WHERE usuario_id=:user_id";
                if (Yii::app()->db->createCommand($sql)->bindValue(':user_id', $user_id)->queryScalar() === false)
                        $sql = "INSERT INTO {$this->visitorTableName} (usuario_id, last_activity) VALUES (:user_id, :last_activity)";
                else
                        $sql = "UPDATE {$this->visitorTableName} SET last_activity=:last_activity WHERE usuario_id=:user_id";
                Yii::app()->db->createCommand($sql)->bindValue(':user_id', $user_id)->bindValue(':last_activity', date('Y-m-d H:i:s'))->execute();
                }
                
                
                
                return true;
        }
//        public function  createMultilanguageReturnUrl($lang='pt'){
//            $arr=array('lg'=>$lang);            
//            if (count($_GET)>0){
//                $arr=$_GET;
//                $arr['lg']=$lang;
//            }
//        }
}