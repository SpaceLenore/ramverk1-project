<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

$items = $navbarConfig["items"] ?? [];
$special = $navbarConfig["special"] ?? [];
?>

<div class="my-header" width="100%">
    <?php foreach ($items as $item) : ?>
        <a href="<?= url($item["url"]) ?>" title="<?= $item["title"] ?>"><?= $item["text"] ?></a>
    <?php endforeach; ?>
    <!-- <a href="index.php">Hem</a> &bull;
    <a href="ask">ställ fråga</a> &bull;
    <a href="questions">Senaste Frågorna</a> &bull;
    <a href="tags">Taggar</a> &bull;
    <a href="users">Användare</a> -->
    <span style="float:right;">
        <?php
        $session = $this->di->get("session");
        if ($session->has("login")) {
            echo '<a href="'. $special['profile'] . '">Profil</a> | <a href="' . $special['logout'] . '">Logga ut</a>';
        } else {
            echo '<a href="' . $special['signup'] . '">Skapa konto</a> | <a href="'. $special['login'] . '">Logga in</a>';
        }
        ?>
    </span>
</div>
