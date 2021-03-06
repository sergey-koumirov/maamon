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
            title: { text: 'Income: <?= $month ?>', style: {"color": "#00A000"} },
            tooltip: { pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'},
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.y:,.2f}',
                        style: {color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'}
                    },
                    size: "75%",
                    animation: false
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
            title: { text: 'Expense: <?= $month ?>', style: {"color": "#cc0000"} },
            tooltip: { pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'},
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.y:,.2f}',
                        style: {color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'}
                    },
                    size: "75%",
                    animation: false
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
    <div class="col-md-6 text-left">
        <h4>&lt;&lt;&nbsp;&nbsp;<a href="<?= Url::to(['wallets/index', 'm'=>$pmonth]) ?>"><?= $pmonth ?></a></h4>
    </div>
    <div class="col-md-6 text-right">
        <h4><a href="<?= Url::to(['wallets/index', 'm'=>$nmonth]) ?>"><?= $nmonth ?></a>&nbsp;&nbsp;&gt;&gt;</h4>
    </div>
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
                <th class="text-right">Total:</th>
                <th class="text-right"><?= number_format($itotal,2) ?></th>
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
                <th class="text-right">Total:</th>
                <th class="text-right"><?= number_format($etotal,2) ?></th>
            </tr>
        </table>  
    </div>
    
</div>

