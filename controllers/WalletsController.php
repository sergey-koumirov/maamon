<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use Pheal\Pheal;
use Pheal\Core\Config;

class WalletsController extends BaseController{
    public function actionIndex(){
        
        $keyID = 3571701;
        $vCode = "pQrzK46fJ4efOOaySPKBlhGllJepWobgH4xjMhpJXVeQ1biHf6T1QXG5eRmnb4DF";
        //$corporationID = 357642502;
        
        
        Config::getInstance()->cache = new \Pheal\Cache\FileStorage('/tmp/');
        
        $pheal = new Pheal($keyID, $vCode, "corp");
        
        $info = $pheal->CorporationSheet();
        
        return $this->render('index', ['wallets'=>$info->walletDivisions]);
    }
}

