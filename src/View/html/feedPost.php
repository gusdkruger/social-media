<div class="post">
    <div class="post__header">
        <h2>@<?= $post["handle"] ?></h2>
        <h3><?= $post["created"] ?></h3>
    </div>
    <p><?= $post["text"] ?></p>
    <div class="post__footer">
        <h2><?= $post["like_count"] ?> Likes</h2>
        <h3 hx-post="/getPost" hx-vals='{"id": "<?= $post["id"] ?>"}' hx-trigger="click" hx-target="#postOverlay" onclick="showOverlay();"><?= $post["comment_count"] ?> Comments</h3>
    </div>
</div>