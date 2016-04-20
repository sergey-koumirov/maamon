<?php

namespace app\models;

use Pheal\Pheal;
use Pheal\Core\Config;


class API{
    
    private static $wallets = [];
    
    private static function init(){
        Config::getInstance()->cache = new \Pheal\Cache\FileStorage('/tmp/');
    }
        
    public static function Wallets($api_key_id){
        if($api_key_id != null){
            if( count(static::$wallets) == 0 ){
            static::init();
            $api = ApiKey::findOne($api_key_id);
            $pheal = new Pheal($api->key_id, $api->v_code, "corp");
            $info = $pheal->CorporationSheet();
            foreach($info->walletDivisions as $wallet){
                static::$wallets[$wallet->accountKey] = $wallet->description;
            } 
            }
            return static::$wallets;
        }else{
            return [];
        }
        
        
    }
    
    public static function NewWTransactions($api_key_id){
        static::init();
        
        $api = ApiKey::findOne($api_key_id);
        
        $pheal = new Pheal($api->key_id, $api->v_code, "corp");
        $info = $pheal->CorporationSheet();        
        
        foreach($info->walletDivisions as $wallet){
            if($wallet->accountKey != 10000){
                $params = [
                    'keyID' => $api->key_id,
                    'vCode' => $api->v_code,
                    'accountKey' => $wallet->accountKey,
                    //'fromID' => ,
                    'rowCount' => 1000
                ];
                        
                do {
                  $batch = $pheal->WalletJournal($params)->entries;
                  usleep(100000);
                  $oldCount = 0;
                  $lastId = -1;
                  foreach($batch as $record){
                      echo $record;
                      $isOld = WTransaction::createFromRecord($wallet->accountKey, $record);
                      if($isOld){$oldCount = $oldCount + 1;}
                      if($lastId==-1 || $lastId < $record->refID){$lastId = $record->refID;}
                  }
                  $noOldRecords = count($batch)>0 && $oldCount/count($batch) < 0.5;
                  $params['fromID'] = $lastId;
                }while( count($batch)>0 && $noOldRecords );        

            }
        }
    }
    
}

