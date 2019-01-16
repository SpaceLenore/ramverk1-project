<h1><?= $post[0]->title ?></h1>
<i>
<img src="https://www.gravatar.com/avatar/<?= $user[0]->picture ?>?d=mp" /><b><?= $user[0]->username ?></b>
</i>
<p>
    <?= $post[0]->question ?>
</p>
<span>
    <?php foreach ($tags as $sptag): ?>
        <a href="../../tags/browse/<?= $sptag->TagName ?>">
            <span style="margin:5px;padding:3px;background:grey;border-radius:4px;font-weight:bold;color:#fff;">
                #<?= $sptag->TagName ?>
            </span>
        </a>
    <?php endforeach; ?>
</span>
<br><br>
<?php for($i=0; $i < count($responses); $i++) {?>
    <i>
    <img id="<?= $responses[$i]->id ?>" src="https://www.gravatar.com/avatar/<?= $responses[$i]->picture ?>?d=mp" /><b><?= $responses[$i]->username ?></b>
    </i>
    <p><?= $responses[$i]->reply ?></p>
<?php } ?>

<hr>
<?= $form ?>
