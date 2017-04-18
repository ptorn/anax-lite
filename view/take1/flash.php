<?php

$image = isset($img) ? $img : "img/laptop.jpg";
?>

<!-- flash -->
<div class="outer-wrap outer-wrap-flash">
    <div class="inner-wrap inner-wrap-flash">
        <div class="row">
            <div class="flash-wrap">
                <img class="img-responsive" src="<?= $app->url->asset($image); ?>">
            </div>
        </div>
    </div>
</div>
