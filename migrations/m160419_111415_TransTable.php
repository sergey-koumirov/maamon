<?php

use yii\db\Migration;

class m160419_111415_TransTable extends Migration
{
    
    public function up(){
        $this->createTable('wtransactions', [
            'ref_id'      => $this->bigInteger(),
            'wallet_id'   => $this->integer(),
            'date'        => $this->dateTime(),
            'ref_type_id' => $this->integer(),
            'owner_name1' => $this->string(),
            'owner_id1'   => $this->bigInteger(),
            'owner_name2' => $this->string(),
            'owner_id2'   => $this->bigInteger(),
            'arg_name1'	  => $this->string(),
            'arg_id1'	  => $this->bigInteger(),
            'amount'	  => $this->decimal(18,2),
            'balance'	  => $this->decimal(18,2),
            'reason'	  => $this->string(),
            'PRIMARY KEY(ref_id)'
        ]);
        
        $this->createIndex('idx-wtransactions-ref_id', 'wtransactions', 'ref_id');
        $this->createIndex('idx-wtransactions-date', 'wtransactions', 'date');
        
    }

    public function down(){
        $this->dropTable('wtransactions');
    }
    
}
