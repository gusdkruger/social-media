<div class="post">
    <div class="post__header">
        <h2>@<?= $post["handle"] ?></h2>
        <h3><?= $post["created"] ?></h3>
    </div>
    <p><?= $post["text"] ?></p>
    <div class="post__footer">
        <h2><?= $post["like_count"] ?> Likes</h2>
        <h3><?= $post["comment_count"] ?> Comments</h3>
    </div>
    <form class="create-comment">
        <textarea name="comment-text" type="text" minlength="3" maxlength="255" required></textarea>
        <div id="error-container"></div>
        <button type="submit">Comment</button>
    </form>
    <div class="comment-feed">
        <h2 class="loading-comments" hx-post="/getComments" hx-vals='{"postId": "<?= $post["id"] ?>"}' hx-trigger="load" hx-target=".comment-feed">Loading posts</h2>
    </div>
</div>