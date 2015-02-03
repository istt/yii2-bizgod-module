<?php

namespace istt\bizgod\models;

use Yii;

/**
 * This is the model class for table "invite".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $invite_type
 * @property integer $supplier_id
 * @property string $date
 * @property integer $status
 * @property string $data_msg
 *
 * @property Order $order
 * @property Supplier $supplier
 * @property Po[] $pos
 * @property Response[] $responses
 */
class Invite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%invite}}';
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
            [['order_id', 'invite_type', 'supplier_id', 'date', 'status', 'data_msg'], 'required'],
            [['order_id', 'invite_type', 'supplier_id', 'status'], 'integer'],
            [['date'], 'safe'],
            [['data_msg'], 'string']
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
            'invite_type' => Yii::t('app', 'Invite Type'),
            'supplier_id' => Yii::t('app', 'Supplier ID'),
            'date' => Yii::t('app', 'Date'),
            'status' => Yii::t('app', 'Status'),
            'data_msg' => Yii::t('app', 'Data Msg'),
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
    public function getSupplier()
    {
        return $this->hasOne(Supplier::className(), ['id' => 'supplier_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPos()
    {
        return $this->hasMany(Po::className(), ['invite_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::className(), ['invite_id' => 'id']);
    }
}
