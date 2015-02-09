<?php
namespace istt\bizgod\models;

use yii\mongodb\ActiveRecord;
use Yii;

class OrderAttributes extends ActiveRecord
{
	public static $fields = [];
	/**
	 * @override
	 * @return yii\mongodb\Connection <object, NULL, multitype:, \Closure, mixed>
	 */
	public static function getDb(){
		return Yii::$app->get('bizgodMongoDb');
	}
	/**
	 * @return string the name of the index associated with this ActiveRecord class.
	 */
	public static function collectionName()
	{
		return '{{order}}';
	}

	/**
	 * @return array list of attribute names.
	 */
	public function attributes()
	{
		return ['_id', 'order_id', 'note', 'comment'] + self::$fields;
	}

	public function rules(){
		return [
				[['order_id'], 'integer'],
				[['note', 'comment'], 'safe'],// Example
				[self::$fields, 'safe'],						// A way to inject extra attributes into the core...
		];
	}
}