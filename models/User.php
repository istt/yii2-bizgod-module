<?php

namespace istt\bizgod\models;

use Yii;
use dektrium\user\models\User as BaseUser;

/**
 * User ActiveRecord model.
 *
 * Database fields:
 * @property integer $id
 * @property string  $username
 * @property string  $email
 * @property string  $unconfirmed_email
 * @property string  $password_hash
 * @property string  $auth_key
 * @property integer $registration_ip
 * @property integer $confirmed_at
 * @property integer $blocked_at
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $flags
 *
 * Defined relations:
 * @property Account[] $accounts
 * @property Profile   $profile
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class User extends BaseUser {

// 	const CUSTOMER = 'customer';
// 	const SUPPLIER = 'supplier';
// 	public function rules(){
// 		return parent::rules() + [
// 				'type' => [['type'], 'in', 'range' => self::CUSTOMER, self::SUPPLIER],
// 		];
// 	}
// 	/** @inheritdoc */
// 	public function afterSave($insert, $changedAttributes)
// 	{
// 		if ($insert) {
// 			if ($this->type == self::CUSTOMER){
// 				$customerProfile = \Yii::createObject([
// 						'class' => Customer::className(),
// 				]);
// 				// FIXME: Set customer profile attributes
// 				$customerProfile->save(false);
// 			}
// 			elseif ($this->type == self::SUPPLIER){
// 				$supplierProfile = \Yii::createObject([
// 						'class' => Supplier::className(),
// 				]);
// 				// FIXME: Set customer profile attributes
// 				$supplierProfile->save(false);
// 			}
// 		}
// 		parent::afterSave($insert, $changedAttributes);
// 	}

// 	public function getProfiles(){
// 		if (Yii::$app->authManager->checkAccess($this->id, "/bizgod/customer/*")){
// 			$this->profiles[] = self::CUSTOMER;
// 		}
// 		if (Yii::$app->authManager->checkAccess($this->id, "/bizgod/supplier/*")){
// 			$this->profiles[] = self::SUPPLIER;
// 		}
// 		return $this->profiles;
// 	}
	public function getCustomer(){
		return $this->hasOne(Customer::className(), ['user_id' => 'id']);
	}
	public function getSupplier(){
		return $this->hasOne(Supplier::className(), ['user_id' => 'id']);
	}
}