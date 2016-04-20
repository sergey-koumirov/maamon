<?php

namespace app\controllers;

use Yii;
use app\models\WTransaction;


class WalletsController extends BaseController{
    public function actionIndex(){
        
        $month = \Yii::$app->getRequest()->getQueryParam('m');
        if(empty($month)){ $month = date("Y-m"); }  
         
//        echo('---');
//        print_r(\Yii::$app->getRequest()->getQueryParams());
//        exit;
        
        $connection = \Yii::$app->getDb();
        $command = $connection->createCommand(
            "select DATE_FORMAT(date,'%Y-%m'), ref_type_id, sum(amount) as amount 
                from maamon_dev.wtransactions
                where DATE_FORMAT(date,'%Y-%m') = :month
                group by DATE_FORMAT(date,'%Y-%m'), ref_type_id
                order by sum(amount)", 
            [':month' => $month ]
        );
        $result = $command->queryAll();
        
        $income = [];
        $expense = [];
        $itotal = 0;
        $etotal = 0;
        
        foreach($result as $r){
            if ($r['amount']>0){
                $income[ WTransaction::ref_type_by_id($r['ref_type_id']) ] = $r['amount'];
                $itotal = $itotal + $r['amount'];
            }else{
                $expense[ WTransaction::ref_type_by_id($r['ref_type_id']) ] = -1*$r['amount'];
                $etotal = $etotal - $r['amount'];
            }
        }
        arsort($income);
        
        
        return $this->render('index', [
            'income'=>$income, 
            'expense'=>$expense,
            'month' => $month,
            'pmonth' => date('Y-m', strtotime('-1 month', strtotime($month))),
            'nmonth' => date('Y-m', strtotime('+1 month', strtotime($month))),
            'itotal'=>$itotal,
            'etotal'=>$etotal,
        ]);
    }
}

