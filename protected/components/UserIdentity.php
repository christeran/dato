<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    // Define your Constant(s)
    const ERROR_USERNAME_NOT_ACTIVE = 3;
    private $_id;
    
    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        $user = Usuarios::model()->find("LOWER(username)=? ", array(strtolower($this->username)));
       
        if ($user === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;        
        elseif (md5(md5($this->password).Yii::app()->params["salt"]) !== $user->password)
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        elseif ($user->estado=="PENDIENTE")
            $this->errorCode = self::ERROR_USERNAME_NOT_ACTIVE;
        else {
            $this->_id = $user->id;
            $this->setState("email",$user->email);
            $this->errorCode = self::ERROR_NONE;
        }
        return $this->errorCode;
    }
    
    public function getId()
    {
        return $this->_id;
    }

}