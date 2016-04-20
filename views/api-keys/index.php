<?php  
  use yii\widgets\LinkPager;
  use yii\helpers\Url;
?>

<h4>API Keys:</h4>

<a href="<?= Url::to(['api-keys/new']) ?>" class="btn btn-primary">New</a>

<div class="api-keys-index">
    <?php echo LinkPager::widget(['pagination' => $pages]); ?>
   
    <table class="table">
        
        <?php foreach($models as $model){ ?>

        <tr>
            <td><a href="<?= Url::to(['api-keys/show','id'=>$model->id]) ?>"><?= $model->id ?></a></td>
            <td><a href="<?= Url::to(['api-keys/show','id'=>$model->id]) ?>"><?= $model->name ?></a></td>
            <td><?= $model->key_id ?></td>
            <td><?= $model->v_code ?></td>
            <td><a href="<?= Url::to(['api-keys/delete','id'=>$model->id]) ?>" class="btn btn-default btn-xs">X</td>
        </tr>

        <?php } ?>
        
    </table>
    
    
 
</div>

