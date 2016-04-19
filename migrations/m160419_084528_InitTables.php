<?php

use yii\db\Migration;

class m160419_084528_InitTables extends Migration
{
    public function up(){
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'username' => $this->string(),
            'password' => $this->string(),
            'auth_key' => $this->string(),
            'access_token' => $this->string(),
        ]);
        
        $hash = \Yii::$app->getSecurity()->generatePasswordHash('admin');
        
        $this->execute("insert into users(username, password, auth_key, access_token) values('admin', '$hash', null, null)");
    }

    public function down(){
        $this->dropTable('users');
    }
   
}
