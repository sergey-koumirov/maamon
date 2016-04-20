<?php

use yii\db\Migration;

class m160420_070718_ApiKeyTable extends Migration{
    
    public function up(){
        $this->createTable('api_keys', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'key_id' => $this->integer(),
            'v_code' => $this->string(),
        ]);
        
    }

    public function down(){
        $this->dropTable('api_keys');
    }
    
}
