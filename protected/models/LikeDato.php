<?php

/**
 * This is the model class for table "like_dato".
 *
 * The followings are the available columns in table 'like_dato':
 * @property integer $id
 * @property integer $dato_id
 * @property integer $usuario_id
 * @property string $estado
 * @property string $creado
 *
 * The followings are the available model relations:
 * @property Dato $dato
 * @property Usuario $usuario
 */
class LikeDato extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'like_dato';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dato_id, usuario_id', 'required'),
			array('dato_id, usuario_id', 'numerical', 'integerOnly'=>true),
			array('estado', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, dato_id, usuario_id, rate, estado, creado', 'safe', 'on'=>'search'),
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
			'usuario' => array(self::BELONGS_TO, 'Usuario', 'usuario_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'dato_id' => 'Dato',
			'usuario_id' => 'Usuario',
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
		$criteria->compare('dato_id',$this->dato_id);
		$criteria->compare('usuario_id',$this->usuario_id);
		$criteria->compare('rate',$this->rate);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('creado',$this->creado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LikeDato the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
