<?php

namespace istt\bizgod\models;

use Yii;

/**
 * This is the model class for table "supplier".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
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
class Supplier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'supplier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'email', 'phone', 'address', 'business_register', 'certify', 'score', 'supplier_type'], 'required'],
            [['score', 'supplier_type'], 'integer'],
            [['username', 'email', 'phone'], 'string', 'max' => 40],
            [['password', 'address', 'business_register', 'certify'], 'string', 'max' => 255],
            [['username', 'email'], 'unique', 'targetAttribute' => ['username', 'email'], 'message' => 'The combination of Username and Email has already been taken.']
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
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryRegisters()
    {
        return $this->hasMany(CategoryRegister::className(), ['supplier_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('category_register', ['supplier_id' => 'id']);
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
}
