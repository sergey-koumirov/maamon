<?php

namespace app\controllers;

use app\models\WTransaction;
use yii\data\Pagination;
use app\models\API;

class WTransactionsController extends BaseController{
    
    public function actionIndex(){
        $query = WTransaction::find();
        $countQuery = clone $query;
        
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
             'models' => $models,
             'pages' => $pages,
        ]);
    }
    
    public function actionDownloadNew(){
        API::NewWTransactions();
        return $this->redirect( ['w-transactions/index'] );
    }
}

