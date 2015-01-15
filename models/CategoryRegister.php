<?php

namespace istt\bizgod\models;

use Yii;

/**
 * This is the model class for table "category_register".
 *
 * @property integer $supplier_id
 * @property integer $category_id
 *
 * @property Supplier $supplier
 * @property Category $category
 */
class CategoryRegister extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_register';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['supplier_id', 'category_id'], 'required'],
            [['supplier_id', 'category_id'], 'integer'],
            [['supplier_id', 'category_id'], 'unique', 'targetAttribute' => ['supplier_id', 'category_id'], 'message' => 'The combination of Supplier ID and Category ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'supplier_id' => Yii::t('app', 'Supplier ID'),
            'category_id' => Yii::t('app', 'Category ID'),
        ];
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
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}
