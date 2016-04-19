<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface{

    public static function tableName(){
        return 'users';
    }

    public static function findIdentity($id){
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null){
        return static::findOne(['access_token' => $token]);
    }
    
    public static function findByUsername($name){
        return static::find()->where(['username' => $name])->one();
    }

    public function getId(){
        return $this->id;
    }

    public function getAuthKey(){
        return $this->auth_key;
    }

    public function validateAuthKey($authKey){
        return $this->getAuthKey() === $authKey;
    }
    
    public function validatePassword($password){
        echo "[".$password."]\n";
        echo "[".\Yii::$app->getSecurity()->generatePasswordHash($password)."]\n";
        echo "[".$this->password."]\n";
        
        return \Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }
    

}
