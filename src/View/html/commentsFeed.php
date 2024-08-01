<form class="create-comment">
    <textarea name="comment-text" type="text" minlength="3" maxlength="255" required></textarea>
    <div id="error-container"></div>
    <button type="submit">Comment</button>
</form>
<div class="comment-container" id="commentsForPost<?= $postId ?>">
    <h2 class="loading-comments" hx-post="/getComments" hx-vals='{"postId": "<?= $postId ?>"}' hx-trigger="load" hx-target="#commentsForPost<?= $postId ?>">Loading posts</h2>
</div>