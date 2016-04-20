<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use app\models\ApiKey;
use app\models\API;

class TransController extends Controller{
    public function actionIndex(){
        foreach(ApiKey::find()->all() as $api){
            API::NewWTransactions($api->id);
        }
    }
}
