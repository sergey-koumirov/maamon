<?php

namespace app\models;

use yii\db\ActiveRecord;

class WTransaction extends ActiveRecord{
    public static function tableName(){
        return 'wtransactions';
    }
    
    public function wallet(){
        return API::Wallets()[$this->wallet_id];
        
    }
    
    public function ref_type(){
        switch($this->ref_type_id){
            case 1:
                return 'Player Trading';
            case 2:
                return 'Market Transaction';
            case 10:
                return 'Player Donation';
            case 17:	
                return 'Bounty Prize';
            case 19:	
                return 'Insurance';
            case 35:	
                return 'CONCORD Spam Prevention Act (CSPA)';
            case 37:	
                return 'Corp Account Withdrawal';
            case 46:	
                return 'Broker Fee';
            case 56:	
                return 'Manufacturing';
            case 63: 
            case 64: 
            case 71: 
            case 72: 
            case 73: 
            case 74: 
            case 79: 
            case 80: 
            case 81: 
            case 82:	
                return 'Various contract types';
            case 85:	
                return 'Bounty Prizes';
            case 97:	
                return 'Customs Office Export Duty';
            default:
                return '---';
        }
        
    }
    
    
    public static function createFromRecord($wallet_id, $record){
        $model = static::findOne($record->refID);
        if($model == null){
            
            $model = new static;
            $model->ref_id      = $record->refID;
            $model->wallet_id   = $wallet_id;
            $model->date        = $record->date;
            $model->ref_type_id = $record->refTypeID;
            $model->owner_name1 = $record->ownerName1;
            $model->owner_id1   = $record->ownerID1;
            $model->owner_name2 = $record->ownerName2;
            $model->owner_id2   = $record->ownerID2;
            $model->arg_name1   = $record->argName1;
            $model->arg_id1     = $record->argID1;
            $model->amount      = $record->amount;
            $model->balance     = $record->balance;
            $model->reason      = $record->reason;
            $model->save();
            
            return false;
        }else{
            return true;
        }
        
    }
}
