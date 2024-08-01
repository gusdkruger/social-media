<div class="post" id="post<?= $id ?>">
    <div class="post__header">
        <h2>@<?= $handle ?> | post_id: <?= $id ?></h2>
        <h3><?= $created ?></h3>
    </div>
    <p><?= $text ?><p>
    <div class="post__footer">
        <h2><?= $likeCount ?></h2>
        <h3 hx-post="/templateCommentsFeed" hx-vals='{"postId": "<?= $id ?>"}' hx-trigger="click" hx-target="#commentsFeedForPost<?= $id ?>">Comments</h3>
    </div>
    <div class="comments-feed" id="commentsFeedForPost<?= $id ?>"></div>
</div>