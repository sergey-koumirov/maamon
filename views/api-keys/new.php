<?php  
  use yii\helpers\Url;
  use yii\helpers\Html;
  use yii\widgets\ActiveForm;
?>

<h4><a href="<?= Url::to(['api-keys/index']) ?>">API Keys</a> > New</h4>

<div class="col-md-6">
<?php $form = ActiveForm::begin(['action' => Url::to(['api-keys/create']) ]) ?>
    
    <?= $this->render('_form', ['form' => $form, 'model' => $model]) ?>
    
    <div class="form-group">
        <div class="col-md-11">
            <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>


