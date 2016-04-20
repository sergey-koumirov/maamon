<?php

use yii\db\Migration;

class m160420_084918_AddApiKeyIdToUsers extends Migration
{
    public function up(){
        $this->addColumn('users', 'api_key_id', $this->integer() );
        $this->addColumn('wtransactions', 'api_key_id', $this->integer() );
        $this->createIndex('idx-wtransactions-api_key_id', 'wtransactions', 'api_key_id');
        
    }

    public function down(){
        $this->dropColumn('wtransactions', 'api_key_id');
        $this->dropColumn('users', 'api_key_id');
    }

}
