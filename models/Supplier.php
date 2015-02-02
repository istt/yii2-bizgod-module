<?php

namespace istt\bizgod\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "supplier".
 *
 * @property integer $user_id
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $business_register
 * @property string $certify
 * @property integer $score
 * @property integer $supplier_type
 *
 * @property CategoryRegister[] $categoryRegisters
 * @property Category[] $categories
 * @property Invite[] $invites
 * @property Po[] $pos
 * @property Rating[] $ratings
 * @property Response[] $responses
 */
class Supplier extends ActiveRecord
{
	public $certifyFile;
	public $categoryIds = [];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%supplier}}';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
    	return Yii::$app->get('bizgodDb');
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone', 'address', 'business_register', 'certify', 'score', 'supplier_type'], 'required'],
            [['score', 'supplier_type'], 'integer'],
            [['phone'], 'string', 'max' => 40],
            [['address', 'business_register', 'certify'], 'string', 'max' => 255],
        		// Extra data
        		[['certifyFile'], 'file'],
        		[['categoryIds'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'address' => Yii::t('app', 'Address'),
            'business_register' => Yii::t('app', 'Business Register'),
            'certify' => Yii::t('app', 'Certify'),
            'score' => Yii::t('app', 'Score'),
            'supplier_type' => Yii::t('app', 'Supplier Type'),
        ];
    }
    /**
     * Populate all related fields
     * @see \yii\db\BaseActiveRecord::afterFind()
     */
    public function afterFind(){
//     	$this->categoryIds = array_values(ArrayHelper::map($this->getCategoryRegisters()->all(), 'category_id', 'category_id'));
    	parent::afterFind();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('{{%supplier_category}}', ['supplier_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvites()
    {
        return $this->hasMany(Invite::className(), ['supplier_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPos()
    {
        return $this->hasMany(Po::className(), ['supplier_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRatings()
    {
        return $this->hasMany(Rating::className(), ['supplier_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::className(), ['supplier_id' => 'id']);
    }

    const TYPE_NORMAL = 0;
    const TYPE_ONE = 1;
    const TYPE_TWO = 2;
    public static function typeOptions(){
    	return [
    			Yii::t('bizgod', 'Type 0'),
    			Yii::t('bizgod', 'Type 1'),
    			Yii::t('bizgod', 'Type 2'),
    	];
    }
}
