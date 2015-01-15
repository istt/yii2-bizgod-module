<?php

namespace istt\bizgod\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property integer $category_id
 * @property string $order_name
 * @property string $order_description
 * @property integer $order_status
 * @property string $unit
 * @property double $quantity
 * @property integer $order_type
 * @property string $rfp_attach
 * @property string $product_image
 * @property double $budget
 * @property string $order_date
 * @property string $due_date
 * @property integer $billing_type
 * @property integer $delivery_type
 * @property string $delivery_address
 *
 * @property Invite[] $invites
 * @property Customer $customer
 * @property Po[] $pos
 * @property Response[] $responses
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'category_id', 'order_name', 'order_description', 'order_status', 'unit', 'quantity', 'order_type', 'rfp_attach', 'product_image', 'budget', 'order_date', 'due_date', 'billing_type', 'delivery_type', 'delivery_address'], 'required'],
            [['customer_id', 'category_id', 'order_status', 'order_type', 'billing_type', 'delivery_type'], 'integer'],
            [['order_description'], 'string'],
            [['quantity', 'budget'], 'number'],
            [['order_date', 'due_date'], 'safe'],
            [['order_name', 'unit', 'rfp_attach', 'product_image', 'delivery_address'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'order_name' => Yii::t('app', 'Order Name'),
            'order_description' => Yii::t('app', 'Order Description'),
            'order_status' => Yii::t('app', 'Order Status'),
            'unit' => Yii::t('app', 'Unit'),
            'quantity' => Yii::t('app', 'Quantity'),
            'order_type' => Yii::t('app', 'Order Type'),
            'rfp_attach' => Yii::t('app', 'Rfp Attach'),
            'product_image' => Yii::t('app', 'Product Image'),
            'budget' => Yii::t('app', 'Budget'),
            'order_date' => Yii::t('app', 'Order Date'),
            'due_date' => Yii::t('app', 'Due Date'),
            'billing_type' => Yii::t('app', 'Billing Type'),
            'delivery_type' => Yii::t('app', 'Delivery Type'),
            'delivery_address' => Yii::t('app', 'Delivery Address'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvites()
    {
        return $this->hasMany(Invite::className(), ['order_id' => 'id']);
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
    public function getPos()
    {
        return $this->hasMany(Po::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::className(), ['order_id' => 'id']);
    }
}
