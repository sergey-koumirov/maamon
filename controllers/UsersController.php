<?php
namespace app\controllers;

use app\models\User;
use yii\data\Pagination;

class UsersController extends BaseController{
    
    public function actionIndex(){
        $query = User::find();
        $countQuery = clone $query;
        
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('username')
            ->all();

        return $this->render('index', [
             'models' => $models,
             'pages' => $pages,
        ]);
    }
    
    public function actionNew(){
        $model = new User();
        return $this->render('new', [
             'model' => $model
        ]);
    }
    
    public function actionShow($id){
        $model = User::findOne($id);
        $model->password = '';
        return $this->render('show', [
             'model' => $model
        ]);
    }
    
    public function actionCreate(){
        $model = new User();
        $post = \Yii::$app->request->post();
        $model->username = $post['User']['username'];
        if($post['User']['password'] != ""){
            $hash = \Yii::$app->getSecurity()->generatePasswordHash($post['User']['password']);
            $model->password = $hash;
        }

        
        if ($model->validate() && $model->save()) {
            return $this->redirect( ['users/show', 'id' => $model->id ] );
        } else {
            return $this->render('new', ['model'=>$model]);
        }
    }
    
    public function actionUpdate($id){
        $model = User::findOne($id);
        $post = \Yii::$app->request->post();
        $model->username = $post['User']['username'];
        if($post['User']['password'] != ""){
            $hash = \Yii::$app->getSecurity()->generatePasswordHash($post['User']['password']);
            $model->password = $hash;
        }
        
        if ($model->save()) {
            return $this->redirect( ['users/show', 'id' => $model->id ] );
        } else {
            return $this->render('show', ['model'=>$model]);
        }
    }
    
    public function actionDelete($id){
        $model = User::findOne($id);
        $model->delete();
        return $this->redirect( ['users/index'] );
    }
    
    public function actionChangeApiKey(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $user = \Yii::$app->user->getIdentity();
        $post = \Yii::$app->request->post();

        $user->api_key_id = $post['api_key_id'];
        $user->save();

        return ['message'=>'ok'];
    }
    
    
}

