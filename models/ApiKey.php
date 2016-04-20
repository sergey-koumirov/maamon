<?php

namespace app\models;

use yii\db\ActiveRecord;

class ApiKey extends ActiveRecord{
    public static function tableName(){
        return 'api_keys';
    }
    
    public function rules(){
        return [
            [['name', 'key_id', 'v_code'], 'required']
        ];
    }
}
