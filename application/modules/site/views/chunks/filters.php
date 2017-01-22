<?php
use app\components\Filter;
?>
<div class="column-left">
    <?=
        Filter::widget([
            'model' => $filter
        ])
    ?>
</div>
