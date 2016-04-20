<?php

namespace app\controllers;

use app\models\ApiKey;
use yii\data\Pagination;

class ApiKeysController extends BaseController{
    
    public function actionIndex(){
        $query = ApiKey::find();
        $countQuery = clone $query;
        
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('name')
            ->all();

        return $this->render('index', [
             'models' => $models,
             'pages' => $pages,
        ]);
    }
    
    public function actionNew(){
        $model = new ApiKey();
        return $this->render('new', [
             'model' => $model
        ]);
    }
    
    public function actionShow($id){
        $model = ApiKey::findOne($id);
        return $this->render('show', [
             'model' => $model
        ]);
    }
    
    public function actionCreate(){
        $model = new ApiKey();
        $model->load(\Yii::$app->request->post());
        
        if ($model->validate() && $model->save()) {
            return $this->redirect( ['api-keys/show', 'id' => $model->id ] );
        } else {
            return $this->render('new', ['model'=>$model]);
        }
        
        return $this->render('new', [
             'model' => $model
        ]);
    }
    
    public function actionUpdate($id){
        $model = ApiKey::findOne($id);
        $model->load(\Yii::$app->request->post());
        
        if ($model->validate() && $model->save()) {
            return $this->redirect( ['api-keys/show', 'id' => $model->id ] );
        } else {
            return $this->render('show', ['model'=>$model]);
        }
        
        return $this->render('new', [
             'model' => $model
        ]);
    }
    
    public function actionDelete($id){
        $model = ApiKey::findOne($id);
        $model->delete();
        return $this->redirect( ['api-keys/index'] );
    }
    
    
}