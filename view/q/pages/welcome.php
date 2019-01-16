<h1>Questionable <span style="font-size:20px">- where your questions is our questions</span> </h1>

<div class="welocme">
    <p>
        Välkommen till onlineforumet <i>Questionable!</i> Där du ställer frågorna,
        (och förhoppningsvis hälper till att svara på andras)
    </p>
    <br>
    <?php
        $session = $this->di->get("session");
        if ($session->has("login")) {
            echo '<a href="ask">Ställ fråga</a>';
        } else {
            echo '<a href="signup">Skapa konto</a> | <a href="login">Logga In</a>';
        }
     ?>

    <div class="top-posts">
        <h3>Latest questions</h3>
        <ul>
            <?php foreach ($posts as $post): ?>
                <li>
                    <a href="questions/q/<?= $post->id ?>">
                        <?= $post->title ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="trending-tags">
        <h3>Trending Tags</h3>
            <?php foreach ($trending as $tag): ?>
                    <a href="tags/browse/<?= $tag->TagName ?>">
                        <span style="margin:5px;padding:3px;background:grey;border-radius:4px;font-weight:bold;color:#fff;">
                            <?= $tag->TagName ?>
                        </span>
                    </a>
            <?php endforeach; ?>
    </div>
</div>
