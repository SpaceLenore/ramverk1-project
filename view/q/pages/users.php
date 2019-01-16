<div class="users">
    <?php foreach ($users as $user): ?>
        <a href="profile/<?= $user->id ?>" style="color:#000;text-decoration:none;">
            <div class="user-card" style="display:flex; align-items:center; border: 1px solid; margin: 1rem;">
                <span>
                    <img src="<?= "https://www.gravatar.com/avatar/" . md5(strtolower(trim($user->picture))) . "?d=mp" ?>" alt="Profile Picture" style="height:100px;">
                </span>
                <h2 style="border:none;"><?= $user->username ?></h2>
            </div>
        </a>
    <?php endforeach; ?>
</div>
