<?php

namespace app\models;

use Pheal\Pheal;
use Pheal\Core\Config;


class API{
    
    private static $wallets = [];
    
    private static function init(){
        Config::getInstance()->cache = new \Pheal\Cache\FileStorage('/tmp/');
    }
    
    private static function keyID(){
        return 3571701;
    }
    
    private static function vCode(){
        return "pQrzK46fJ4efOOaySPKBlhGllJepWobgH4xjMhpJXVeQ1biHf6T1QXG5eRmnb4DF";
    }
    
    
    public static function Wallets(){
        if( count(static::$wallets) == 0 ){
            static::init();
            $pheal = new Pheal(static::keyID(), static::vCode(), "corp");
            $info = $pheal->CorporationSheet();
            foreach($info->walletDivisions as $wallet){
                static::$wallets[$wallet->accountKey] = $wallet->description;
            } 
        }
        return static::$wallets;
    }
    
    public static function NewWTransactions(){
        static::init();
        
        //$corporationID = 357642502;
        
        $pheal = new Pheal(static::keyID(), static::vCode(), "corp");
        $info = $pheal->CorporationSheet();        
        
        foreach($info->walletDivisions as $wallet){
            if($wallet->accountKey != 10000){
                $params = [
                    'keyID' => static::keyID(),
                    'vCode' => static::vCode(),
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

