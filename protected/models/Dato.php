<?php

/**
 * This is the model class for table "dato".
 *
 * The followings are the available columns in table 'dato':
 * @property integer $id
 * @property integer $usuario_id
 * @property integer $categoria_id
 * @property integer $provincia_id
 * @property string $titulo
 * @property string $url
 * @property string $direccion
 * @property string $fecha_inicio
 * @property string $fecha_expedicion
 * @property integer $gratis
 * @property string $foto
 * @property string $descripcion
 * @property string $estado
 * @property string $creado
 *
 * The followings are the available model relations:
 * @property Comentario[] $comentarios
 * @property Usuario $usuario
 * @property Categoria $categoria
 * @property Provincia $provincia
 * @property LikeDato[] $likeDatos
 */
class Dato extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'dato';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('categoria_id, titulo, descripcion', 'required'),
			array(' categoria_id, provincia_id, gratis', 'numerical', 'integerOnly'=>true),
			array('titulo', 'length', 'max'=>90),
			array('url, direccion', 'length', 'max'=>150),
                        array('url', 'url', 'defaultScheme' => 'http'),
			array('descripcion', 'length', 'max'=>650),
			array('estado', 'length', 'max'=>10),
			array('foto', 'file', 
                            'types'=>'jpg, gif, png, bmp, jpeg',
                            'maxSize'=>1024 * 1024 * 5, // 10MB
                            'tooLarge'=>'The file was larger than 10MB. Please upload a smaller file.',
                            'allowEmpty' => true
                        ),
			array('fecha_inicio, fecha_expedicion, foto', 'safe'),
                        array('fecha_inicio, fecha_expedicion', 'date', 'format'=>'dd/mm/yyyy', 'allowEmpty' => true),
                        array( 'fecha_inicio, fecha_expedicion', 'default', 'setOnEmpty'=>true, 'value'=>null ),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, usuario_id, categoria_id, provincia_id, titulo, url, direccion, fecha_inicio, fecha_expedicion, gratis, foto, descripcion, estado, creado', 'safe', 'on'=>'search'),
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
			'comentarios' => array(self::HAS_MANY, 'Comentarios', 'dato_id', 'condition'=>'estado="ACTIVO"','order'=>'creado ASC',),
			'Usuarios' => array(self::BELONGS_TO, 'Usuarios', 'usuario_id'),
			'Categorias' => array(self::BELONGS_TO, 'Categorias', 'categoria_id'),
			'provincia' => array(self::BELONGS_TO, 'Provincias', 'provincia_id'),
			'likes' => array(self::HAS_MANY, 'LikeDato', 'dato_id', 'condition'=>'rate="1"'),
			'dislikes' => array(self::HAS_MANY, 'LikeDato', 'dato_id', 'condition'=>'rate="2"'),
			'user_like' => array(self::HAS_ONE, 'LikeDato', 'dato_id', 'condition'=>'usuario_id="'.Yii::app()->user->id.'"'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'usuario_id' => Yii::t('dato','Usuario'),
			'categoria_id' => Yii::t('dato','Categoria'),
			'provincia_id' => 'Departamento',
			'titulo' => Yii::t('dato','Titulo'),
			'url' => Yii::t('dato','Url'),
			'direccion' => Yii::t('dato','Direccion'),
			'fecha_inicio' => Yii::t('dato','Fecha Inicio'),
			'fecha_expedicion' => Yii::t('dato','Fecha Expedicion'),
			'gratis' => Yii::t('dato','Gratis'),
			'foto' => Yii::t('dato','Foto'),
			'descripcion' => Yii::t('dato','Descripcion'),
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
		$criteria->compare('categoria_id',$this->categoria_id);
		$criteria->compare('provincia_id',$this->provincia_id);
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('fecha_inicio',$this->fecha_inicio,true);
		$criteria->compare('fecha_expedicion',$this->fecha_expedicion,true);
		$criteria->compare('gratis',$this->gratis);
		$criteria->compare('foto',$this->foto,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('creado',$this->creado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

          public function beforeSave() 
         {                
              
              $this->fecha_inicio= ($this->fecha_inicio===null)? null:date('Y-m-d', strtotime(str_replace('/', '-', $this->fecha_inicio)));
              $this->fecha_expedicion=($this->fecha_expedicion===null)? null:date('Y-m-d', strtotime(str_replace('/', '-', $this->fecha_expedicion)));
              $this->creado=date('Y-m-d H:i:s');
              $this->usuario_id = Yii::app()->user->getId(); 
              return true; 
         }
         
         protected function beforeFind()
        {
              $this->fecha_inicio=date('Y-m-d', strtotime(str_replace('/', '-', $this->fecha_inicio)));
              $this->fecha_expedicion=date('Y-m-d', strtotime(str_replace('/', '-', $this->fecha_expedicion)));
            parent::beforeFind();
        }
         protected function afterFind ()
        {
              $this->fecha_inicio=($this->fecha_inicio===null)? null:date('d/m/Y', strtotime( $this->fecha_inicio));
              $this->fecha_expedicion=($this->fecha_expedicion===null)? null:date('d/m/Y', strtotime($this->fecha_expedicion));
            parent::beforeFind();
        }
        
          

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Dato the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
