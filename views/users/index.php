<?php  
  use yii\widgets\LinkPager;
  use yii\helpers\Url;
?>

<h4>Users:</h4>

<a href="<?= Url::to(['users/new']) ?>" class="btn btn-primary">New</a>

<div class="users-index">
    <?php echo LinkPager::widget(['pagination' => $pages]); ?>
   
    <table class="table">
        
        <?php foreach($models as $model){ ?>

        <tr>
            <td><a href="<?= Url::to(['users/show','id'=>$model->id]) ?>"><?= $model->id ?></a></td>
            <td><a href="<?= Url::to(['users/show','id'=>$model->id]) ?>"><?= $model->username ?></a></td>
            <td><a href="<?= Url::to(['users/delete','id'=>$model->id]) ?>" class="btn btn-default btn-xs">X</td>
        </tr>

        <?php } ?>
        
    </table>
    
    
 
</div>

