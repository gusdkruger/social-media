<div class="post">
    <div class="post__header">
        <h2>@<?= $handle ?> | post_id: <?= $id ?></h2>
        <h3><?= $created ?></h3>
    </div>
    <p><?= $text ?><p>
    <div class="post__footer">
        <h2><?= $likeCount ?> Likes</h2>
        <h3 hx-post="/getPost" hx-vals='{"id": "<?= $id ?>"}' hx-trigger="click" hx-target="#postOverlay"><?= $commentCount ?> Comments</h3>
    </div>
</div>