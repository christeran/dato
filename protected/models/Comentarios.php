<?php

/**
 * This is the model class for table "comentario".
 *
 * The followings are the available columns in table 'comentario':
 * @property integer $id
 * @property integer $usuario_id
 * @property integer $dato_id
 * @property string $descripcion
 * @property string $estado
 * @property string $creado
 *
 * The followings are the available model relations:
 * @property Dato $dato
 * @property Usuario $usuario
 */
class Comentarios extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'comentario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('usuario_id, dato_id, descripcion', 'required'),
			array('usuario_id, dato_id', 'numerical', 'integerOnly'=>true),
			array('descripcion', 'length', 'max'=>350),
			array('estado', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, usuario_id, dato_id, descripcion, estado, creado', 'safe', 'on'=>'search'),
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
			'dato' => array(self::BELONGS_TO, 'Dato', 'dato_id'),
			'usuario' => array(self::BELONGS_TO, 'Usuarios', 'usuario_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'usuario_id' => 'Usuario',
			'dato_id' => 'Dato',
			'descripcion' => 'Descripcion',
			'estado' => 'Estado',
			'creado' => 'Creado',
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
		$criteria->compare('usuario_id',$this->usuario_id);
		$criteria->compare('dato_id',$this->dato_id);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('creado',$this->creado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
         public function beforeSave() 
         {                
              $this->creado=date('Y-m-d H:i:s');
              return true; 
         }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Comentarios the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
