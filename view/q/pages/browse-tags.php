<h1>Browse by tags</h1>
<?php foreach ($tags as $tag) : ?>
    <a href="<?= $tag->TagName ?>">
        <span style="margin:5px;padding:3px;background:grey;border-radius:4px;font-weight:bold;color:#fff;">
            <?= $tag->TagName ?>
        </span>
    </a>
<?php endforeach; ?>
<hr>
<?php foreach ($posts as $post) : ?>
    <a href="../../questions/q/<?= $post->id ?>"><h3 style="padding:0;margin:0;"><?= $post->title ?></h3></a>
    <br>
<?php endforeach; ?>
