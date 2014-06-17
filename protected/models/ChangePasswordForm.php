<?php

class ChangePasswordForm extends CFormModel
{
  public $currentPassword;
  public $newPassword;
  public $newPassword_repeat;
  private $_user;
  
  public function rules()
  {
    $regularExpressionPattern = '/.*(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#]).*/';  
    return array(
        array('currentPassword', 'compareCurrentPassword' ),
	array('currentPassword, newPassword, newPassword_repeat', 'required'),
        array('newPassword', 'length', 'max'=>250,'min'=>8),
        array('newPassword', 'match', 'pattern'=>$regularExpressionPattern, 
                                'skipOnError'=>true, 
                                'message'=>'Must have at least one letter, number and one special character out of set [!@#]!'),
        array('newPassword', 'compare', 'compareAttribute'=>'newPassword_repeat'),
		);
  }
  
  		
  
  public function compareCurrentPassword($attribute,$params)
  {
    //if( md5($this->currentPassword) !== $this->_user->password )
    if    (md5(md5($this->currentPassword).Yii::app()->params["salt"]) !== $this->_user->password)
    {
      $this->addError($attribute,'La contraseña actual es incorrecta');
    }
  }
  
  public function init()
  {
    $this->_user = Usuarios ::model()->findByPk(Yii::app()->user->id);
    //print_r($this->_user);
  }
  
  public function attributeLabels()
  {
    return array(
      'currentPassword'=>Yii::t('cambiarPassword','Contraseña actual'),
      'newPassword'=>Yii::t('cambiarPassword','Nueva contraseña'),
      'newPassword_repeat'=>Yii::t('cambiarPassword','Repetir contraseña'),
    );
  }
  
  public function changePassword()
  {
    $this->_user->password = $this->newPassword;
    if( $this->_user->save() )
      return true;
    return false;
  }
}


