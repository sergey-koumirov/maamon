<?php

namespace app\controllers;

use app\models\WTransaction;
use yii\data\Pagination;
use app\models\API;

class WTransactionsController extends BaseController{
    
    public function actionIndex(){
        $query = WTransaction::find()->where(['api_key_id' => \Yii::$app->user->getIdentity()->api_key_id]);
        $countQuery = clone $query;
        
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>100 ]);
        
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('date desc')
            ->all();

        return $this->render('index', [
             'models' => $models,
             'pages' => $pages,
        ]);
    }
    
    public function actionDownloadNew(){
        if(\Yii::$app->user->getIdentity()->api_key_id!=null){
            API::NewWTransactions(\Yii::$app->user->getIdentity()->api_key_id);
        }
        return $this->redirect( ['w-transactions/index'] );
    }
}

