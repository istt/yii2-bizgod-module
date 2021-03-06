<?php

namespace istt\bizgod\models;

use Yii;

/**
 * This is the model class for table "rating".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property integer $supplier_id
 * @property string $date
 * @property integer $rating_type
 * @property integer $score
 * @property string $comment
 *
 * @property Customer $customer
 * @property Supplier $supplier
 */
class Rating extends \yii\db\ActiveRecord
{
	const TYPE_CUSTOMER = 0;	// Customer rating
	const TYPE_SUPPLIER = 1;	// Supplier rating
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{rating}}';
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
            [['rating_type', 'customer_id', 'supplier_id', 'score', 'comment', 'date'], 'required'],
            [['rating_type', 'customer_id', 'supplier_id', 'score'], 'integer'],
            [['comment'], 'string'],
            [['date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'rating_type' => Yii::t('app', 'Rating Type'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'supplier_id' => Yii::t('app', 'Supplier ID'),
            'score' => Yii::t('app', 'Score'),
            'comment' => Yii::t('app', 'Comment'),
            'date' => Yii::t('app', 'Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['user_id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Supplier::className(), ['user_id' => 'supplier_id']);
    }
}
