<?php
$employs = BLEmployment::init();
$employs->getAvailByDate(date('Y-m-d'),date('Y-m-d',time() + 3600 * 24 * 11),10);
$step = $employs->step();

?>
<div class="diagram-list">
    <?php if(is_array($employs->data)): foreach ($employs->data as $employ): ?>
        <div class="diagram-item">
            <span class="diagram-day"><?php echo $employ->date?></span>
            <div class="diagram-value <?php echo $employs->getTypeClass($employ->avail)?>" style="height: <?php echo ($step > 0) ? ($employ->cost/$step) : 0 ?>px;"></div>
            <span class="diagram-cost"><?php echo round($employ->cost,0) ?> грн</span>
        </div>
    <?php endforeach; endif;?>
</div>


