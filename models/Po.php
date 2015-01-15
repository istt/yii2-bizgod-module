<?php

namespace istt\bizgod\models;

use Yii;

/**
 * This is the model class for table "po".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $customer_id
 * @property integer $supplier_id
 * @property string $unit
 * @property double $quantity
 * @property double $price
 * @property integer $po_status
 * @property integer $billing_type
 * @property integer $delivery_type
 * @property integer $invite_id
 * @property string $delivery_date
 *
 * @property Order $order
 * @property Customer $customer
 * @property Supplier $supplier
 * @property Invite $invite
 */
class Po extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'po';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_id', 'customer_id', 'supplier_id', 'unit', 'quantity', 'price', 'po_status', 'billing_type', 'delivery_type', 'invite_id', 'delivery_date'], 'required'],
            [['id', 'order_id', 'customer_id', 'supplier_id', 'po_status', 'billing_type', 'delivery_type', 'invite_id'], 'integer'],
            [['quantity', 'price'], 'number'],
            [['delivery_date'], 'safe'],
            [['unit'], 'string', 'max' => 40]
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
            'customer_id' => Yii::t('app', 'Customer ID'),
            'supplier_id' => Yii::t('app', 'Supplier ID'),
            'unit' => Yii::t('app', 'Unit'),
            'quantity' => Yii::t('app', 'Quantity'),
            'price' => Yii::t('app', 'Price'),
            'po_status' => Yii::t('app', 'Po Status'),
            'billing_type' => Yii::t('app', 'Billing Type'),
            'delivery_type' => Yii::t('app', 'Delivery Type'),
            'invite_id' => Yii::t('app', 'Invite ID'),
            'delivery_date' => Yii::t('app', 'Delivery Date'),
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
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
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
    public function getInvite()
    {
        return $this->hasOne(Invite::className(), ['id' => 'invite_id']);
    }
}
