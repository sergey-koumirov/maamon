<?php  
  use yii\widgets\LinkPager;
  use yii\helpers\Url;
?>

<h4>Wallets Transactions:</h4>

<a href="<?= Url::to(['w-transactions/download-new']) ?>" class="btn btn-primary">Download New</a>

<div class="wallets-transactions-index">
    <?php echo LinkPager::widget(['pagination' => $pages]); ?>
    
    <table class="table">
        
        <?php foreach($models as $model){ ?>

        <tr>
            <td><?= $model->wallet(\Yii::$app->user->getIdentity()->api_key_id) ?></td>
            <td><?= $model->ref_id ?></td>
            <td><?= $model->date ?></td>
            <td><?= $model->ref_type() ?></td>
            <td><?= $model->owner_name1 ?></td>
            <td><?= $model->owner_name2 ?></td>
            <td class="text-right"><?= number_format($model->amount,2) ?></td>
            <td><?= $model->reason ?></td>
        </tr>

        <?php } ?>
        
    </table>
    
    

</div>

