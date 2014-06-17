<?php

/**
 * This is the model class for table "usuario".
 *
 * The followings are the available columns in table 'usuario':
 * @property integer $id
 * @property string $nombre
 * @property string $apellido
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $estado
 */
class Usuarios extends CActiveRecord
{
    public $confirmPassword;
	/**
	 * @return string the associated database table name
	 */
    
	public function tableName()
	{
		return 'usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
                $regularExpressionPattern = '/.*(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#]).*/';
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, username, password, confirmPassword, email', 'required'),
			array('nombre, apellido', 'length', 'max'=>150),
                        array('nombre, apellido', 'filter', 'filter'=>'strtolower'),                    
			array('username, estado', 'length', 'max'=>100),                        
			//array('username', 'allowSpaces'=>'flase'),                        
                    
                        array("username","unique", "attributeName"=>"username","className"=>"Usuarios"),//unique in database
                        array('password', 'length', 'max'=>250,'min'=>5),
                        array('password', 'match', 'pattern'=>$regularExpressionPattern, 
                                'skipOnError'=>true, 
                                'message'=>'Must have at least one letter, number and one special character out of set [!@#]!'),			
                        array('confirmPassword','length','max'=>50, 'min'=>8),
                        array('password', 'compare', 'compareAttribute'=>'confirmPassword','on'=>'registrar, cambiar'),
                        array('confirmPassword', 'safe'),
                        
                       // array('password', 'compare', 'compareAttribute'=>'password2'), 
			array('email', 'length', 'max'=>200),
                        array('email','email'),
                        array("email","unique", "attributeName"=>"email","className"=>"Usuarios"),//unique in database
                        
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, apellido, username, password, email, estado', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => Yii::t('usuarios','Nombre'),
			'apellido' => Yii::t('usuarios','Apellido') ,
			'username' => Yii::t('usuarios','Usuario') ,
			'password' => Yii::t('usuarios','Contraseña') ,
                        'confirmPassword'=>  Yii::t('usuarios','Confirmar Contraseña'),
			'email' => 'Email',
			'estado' => 'Estado',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('apellido',$this->apellido,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('estado',$this->estado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

         public function beforeSave() 
         { 
               //if ($this->confirmPassword){
                if ($this->isNewRecord){
                    $this->creado=date('Y-m-d H:i:s');
                }
                $pass = md5(md5($this->password).Yii::app()->params["salt"]);  
                $this->password = $pass; 
                return true; 
         }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usuarios the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
