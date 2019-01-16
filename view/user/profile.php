<h1><?= $username ?> <span style="font-size:20px; font-style:italic">(<?= $id ?>)</span></h1>
<?php
if (isset($settingsForm)) {
    echo $settingsForm;
}
?>

<h2>Questions Posted:</h2>
<?php
if (is_string($madePosts)) {
    echo $madePosts;
} else {
    foreach ($madePosts as $post) {
        echo '<a href="../questions/q/' . $post->id . '">' . $post->title . '</a><br>';
    }
}
?>

<h2>Replied to:</h2>
<?php
if (is_string($madeReplies)) {
    echo $madeReplies;
} else {
    foreach ($madeReplies as $reply) {
        echo '<a href="../questions/q/' . $reply->responseTo . '#' . $reply->id . '">' . $reply->username . '</a>: ' . $reply->reply . '<br><br>';
    }
}
?>
