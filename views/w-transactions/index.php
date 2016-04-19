<?php  
  use yii\widgets\LinkPager;
  use yii\helpers\Url;
?>

<h4>Wallets Transactions:</h4>

<a href="<?= Url::to(['w-transactions/download-new']) ?>" class="btn btn-primary">Download New</a>

<div class="wallets-transactions-index">
    
    <table class="table">
        
        <?php foreach($models as $model){ ?>

        <tr>
            <td><?= $model->wallet() ?></td>
            <td><?= $model->ref_id ?></td>
            <td><?= $model->date ?></td>
            <td><?= $model->ref_type() ?></td>
            <td><?= $model->owner_name1 ?></td>
            <td><?= $model->owner_name2 ?></td>
            <td><?= $model->amount ?></td>
            <td><?= $model->reason ?></td>
        </tr>

        <?php } ?>
        
    </table>
    
    
    <?php echo LinkPager::widget(['pagination' => $pages]); ?>

</div>

