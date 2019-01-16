
<h1>Questions</h1>
<?php foreach ($postdata as $posting): ?>
    <h2><a href="questions/q/<?= $posting['post']->id ?>"><?= $posting['post']->title ?></a></h2>
    <p>
        <?= $posting['post']->question ?>
    </p>
    <?php foreach ($posting['tags'] as $sptag): ?>
        <a href="tags/browse/<?= $sptag->TagName ?>">
            <span style="margin:5px;padding:3px;background:grey;border-radius:4px;font-weight:bold;color:#fff;">
                #<?= $sptag->TagName ?>
            </span>
        </a>
    <?php endforeach; ?>
    <hr>
<?php endforeach; ?>
