<?php  
  use yii\helpers\Url;
?>

<script>
    $(function () {
        $('#icont').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: { text: 'Income: <?= $month ?>' },
            tooltip: { pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'},
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.y:.2f}',
                        style: {color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'}
                    }
                }
            },
            series: [{
                name: 'Income',
                colorByPoint: true,
                data: [
                    <?php foreach($income as $key => $value){ ?>
                        {name: '<?= $key ?>', y: <?= $value ?>},
                    <?php } ?>                        
                ]
            }]
        });
        
        $('#econt').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: { text: 'Expense: <?= $month ?>' },
            tooltip: { pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'},
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.y:.2f}',
                        style: {color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'}
                    }
                }
            },
            series: [{
                name: 'Expense',
                colorByPoint: true,
                data: [
                    <?php foreach($expense as $key => $value){ ?>
                        {name: '<?= $key ?>', y: <?= $value ?>},
                    <?php } ?>                        
                ]
            }]
        });
    });
</script>

<h4>Wallets:</h4>

<div class="row text-center">
    <h4>
        &lt;&lt;&lt;
        <a href="<?= Url::to(['wallets/index', 'm'=>$pmonth]) ?>"><?= $pmonth ?></a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="<?= Url::to(['wallets/index', 'm'=>$nmonth]) ?>"><?= $nmonth ?></a>
        &gt;&gt;&gt;
    </h4>
</div>

<div class="row">
    <div id="icont" class="col-md-6"></div>
    <div id="econt" class="col-md-6"></div>
</div>

<div class="wallets-index row">
    
    <div class="col-md-6">
        <table class="table">
            <?php foreach($income as $key => $value){ ?>
            <tr>
                <td><?= $key ?></td>
                <td class="text-right"><?= number_format($value,2) ?></td>
            </tr>    
            <?php } ?>
            <tr>
                <td class="text-right">Total:</td>
                <td class="text-right"><?= number_format($itotal,2) ?></td>
            </tr>
        </table>    
    </div>
    <div class="col-md-6">
        <table class="table">
            <?php foreach($expense as $key => $value){ ?>
            <tr>
                <td><?= $key ?></td>
                <td class="text-right"><?= number_format($value,2) ?></td>
            </tr>    
            <?php } ?>
            <tr>
                <td class="text-right">Total:</td>
                <td class="text-right"><?= number_format($etotal,2) ?></td>
            </tr>
        </table>  
    </div>
    
</div>

