<?php

namespace istt\bizgod\models;

use Yii;

/**
 * This is the model class for table "response".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $invite_id
 * @property integer $supplier_id
 * @property string $response_date
 * @property string $response_data
 * @property integer $response_type
 *
 * @property Order $order
 * @property Invite $invite
 * @property Supplier $supplier
 */
class Response extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'response';
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
            [['order_id', 'invite_id', 'supplier_id', 'response_date', 'response_data', 'response_type'], 'required'],
            [['order_id', 'invite_id', 'supplier_id', 'response_type'], 'integer'],
            [['response_date'], 'safe'],
            [['response_data'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'invite_id' => Yii::t('app', 'Invite ID'),
            'supplier_id' => Yii::t('app', 'Supplier ID'),
            'response_date' => Yii::t('app', 'Response Date'),
            'response_data' => Yii::t('app', 'Response Data'),
            'response_type' => Yii::t('app', 'Response Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvite()
    {
        return $this->hasOne(Invite::className(), ['id' => 'invite_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Supplier::className(), ['id' => 'supplier_id']);
    }
}
