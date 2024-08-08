<div class="comment">
    <div class="comment__header">
        <h2>@<?= $comment["handle"] ?> | comment_id: <?= $comment["id"] ?></h2>
        <h3><?= $comment["created"] ?></h3>
    </div>
    <p><?= $comment["text"] ?></p>
    <h2><?= $comment["like_count"] ?></h2>
</div>