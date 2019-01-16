<h1>Browse by tags</h1>
<?php foreach ($tags as $tag) : ?>
    <a href="tags/browse/<?= $tag->TagName ?>">
        <span style="margin:5px;padding:3px;background:grey;border-radius:4px;font-weight:bold;color:#fff;">
            <?= $tag->TagName ?>
        </span>
    </a>
<?php endforeach; ?>
