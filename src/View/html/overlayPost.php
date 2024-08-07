<button onclick="closeOverlay();">Close Overlay</button>
<div class="post">
    <div class="post__header">
        <h2>@<?= $handle ?> | post_id: <?= $id ?></h2>
        <h3><?= $created ?></h3>
    </div>
    <p><?= $text ?><p>
    <div class="post__footer">
        <h2><?= $likeCount ?> Likes</h2>
        <h3><?= $commentCount ?> Comments</h3>
    </div>
</div>
<form class="create-comment">
    <textarea name="comment-text" type="text" minlength="3" maxlength="255" required></textarea>
    <div id="error-container"></div>
    <button type="submit">Comment</button>
</form>
<div class="comment-feed">
    <h2 class="loading-comments" hx-post="/getComments" hx-vals='{"postId": "<?= $id ?>"}' hx-trigger="load" hx-target=".comment-feed">Loading posts</h2>
</div>