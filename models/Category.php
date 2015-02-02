<?php

namespace istt\bizgod\models;

use creocoder\nestedsets\NestedSetsBehavior;
use creocoder\nestedsets\NestedSetsQueryBehavior;
use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property integer $name
 * @property integer $description
 * @property integer $status
 * @property integer $level
 * @property integer $belongto
 * @property integer $lft
 * @property integer $rgt
 * @property integer $root
 *
 * @property CategoryRegister[] $categoryRegisters
 * @property Supplier[] $suppliers
 */


class CategoryQuery extends \yii\db\ActiveQuery
{
	public function behaviors() {
		return [
				NestedSetsQueryBehavior::className(),
		];
	}
}
class Category extends \yii\db\ActiveRecord
{
	public function behaviors() {
		return [
				'NestedSetsBehavior' => [
						'class' => NestedSetsBehavior::className(),
						'depthAttribute' => 'level',
						'treeAttribute' => 'root'
				]
		];
	}

	/**
	 * @return \yii\db\Connection the database connection used by this AR class.
	 */
	public static function getDb()
	{
		return Yii::$app->get('bizgodDb');
	}

	public function transactions()
	{
		return [
				self::SCENARIO_DEFAULT => self::OP_ALL,
		];
	}

	public static function find()
	{
		return new CategoryQuery(get_called_class());
	}
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @override
     * @see \yii\db\BaseActiveRecord::init()
     */
    public function init(){
    	$this->status = true;
    	$this->description = '';
    	parent::init();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status'], 'required'],
            	[['status', 'level', 'belongto', 'lft', 'rgt', 'root'], 'integer'],
        		[['status'], 'boolean'],
            	[['name'], 'string', 'max' => 255],
	       		[['description'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'status' => Yii::t('app', 'Status'),
            'level' => Yii::t('app', 'Level'),
            'belongto' => Yii::t('app', 'Belongto'),
        		'lft' => Yii::t('app', 'Lft'),
        		'rgt' => Yii::t('app', 'Rgt'),
        		'root' => Yii::t('app', 'Root'),
        ];
    }
    /**
     * Attribute Aliases
     */
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;
    public static function statusOptions(){
    	return [
    			self::STATUS_DISABLE => Yii::t('app', 'Disable'),
    			self::STATUS_ENABLE => Yii::t('app', 'Enable'),
    	];
    }
    public static function statusLabel($s){
    	$tmp = self::statusOptions();
    	if (array_key_exists($s, $tmp)){
    		return $tmp[$s];
    	}
    	return null;
    }
    /**
     * Retrieve the list of available Categories as option list
     */
    public static function CategoryOptions($root = 0, $level = null){
    	$res = [];
    	if ($root instanceof self){
    		$res[$root->id] = str_repeat('-', $root->level) . ' ' . $root->name;
    		if ($level){
    			foreach ($root->children(1)->all() as $childRoot){
    				$res += self::CategoryOptions($childRoot, $level - 1);
    			}
    		} elseif (is_null($level)){
    			foreach ($root->children(1)->all() as $childRoot){
    				$res += self::CategoryOptions($childRoot, NULL);
    			}
    		}
    	} elseif (is_scalar($root)){
    		if ($root == 0){
    			foreach (self::find()->roots()->all() as $rootItem){
    				if ($level)
    					$res += self::CategoryOptions($rootItem, $level - 1);
    				elseif (is_null($level))
    				$res += self::CategoryOptions($rootItem, NULL);
    			}
    		} else {
    			$root = self::find($root)->one();
    			if ($root) 	$res += self::CategoryOptions($root, $level);
    		}
    	}
    	return $res;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuppliers()
    {
        return $this->hasMany(Supplier::className(), ['id' => 'supplier_id'])->viaTable('{{%supplier_category}}', ['category_id' => 'id']);
    }

    /**
     * Return all suppliers of current and child categories..
     */
    public function getAllSuppliers(){
    	return $query = Supplier::find(['in', 'id', array_keys(self::CategoryOptions($this->id))]);
    }
}
