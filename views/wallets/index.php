<?php  ?>

<h4>Wallets:</h4>

<div class="wallets-index">
    
    <ul>
        <?php foreach($wallets as $wallet){ ?>

        <li><?= $wallet->accountKey ?>: <?= $wallet->description ?></li>

        <?php } ?>
        
    </ul>

</div>

