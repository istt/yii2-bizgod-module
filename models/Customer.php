<?php

namespace istt\bizgod\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "customer".
 *
 * @property integer $user_id
 * @property string $full_name
 * @property string $mobile
 * @property string $address
 * @property string $city
 * @property integer $status
 * @property integer $score
 * @property integer $customer_type
 *
 * @property Order[] $orders
 * @property Po[] $pos
 * @property Rating[] $ratings
 */
class Customer extends ActiveRecord
{
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
    public static function tableName()
    {
        return '{{%customer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['full_name', 'mobile', 'email', 'address', 'city', 'status', 'score', 'customer_type'], 'required'],
            [['status', 'score', 'customer_type'], 'integer'],
            [['address', 'city'], 'string', 'max' => 255],
            [['full_name'], 'string', 'max' => 80],
            [['mobile'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'full_name' => Yii::t('app', 'Full Name'),
            'mobile' => Yii::t('app', 'Mobile'),
            'email' => Yii::t('app', 'Email'),
            'address' => Yii::t('app', 'Address'),
            'city' => Yii::t('app', 'City'),
            'status' => Yii::t('app', 'Status'),
            'score' => Yii::t('app', 'Score'),
            'customer_type' => Yii::t('app', 'Customer Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['customer_id' => 'user_id']);
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
    public function getPos()
    {
        return $this->hasMany(Po::className(), ['customer_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRatings()
    {
        return $this->hasMany(Rating::className(), ['customer_id' => 'user_id']);
    }
}
