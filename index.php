<?php include "templates/header.php"; ?><h2>New blog post</h2>

    <form method="post">
    	<label for="title">Title</label>
    	<input type="text" name="title" id="title">
    	<label for="comment">Comment</label>
    	<input type="text" name="comment" id="comment">
    	<input type="submit" name="submit" value="Submit">
    </form>

<?php

require_once 'functions/Post.php';
$data = file_get_contents("dragonbone.json");
$posts = json_decode($data, true);
$getAllPosts = Post::fetchAllPosts($posts);
var_dump($getAllPosts);
$posts = array();
if (!empty($getAllPosts)) {
    foreach ($getAllPosts as $blog) {
        $postId = $blog->getId();
        $postTitle = $blog->getStoryTitle();
        $postBody = $blog->getStoryBody();
        $postPic = $blog->getStoryImage();
        $postTimestamp = $blog->getTimePosted();
        $post['id'] = $postId;
        $post['title'] = $postTitle;
        $post['body'] = $postBody;
        $post['post_image'] = $postPic;
        $post['post_timestamp'] = $postTimestamp;
        array_push($posts, $post);
    }
    $result['error'] = false;
    $result['result'] = $posts;
}
else{
    $result['error'] = true;
    $result['message'] = 'internal server error';
}
echo(json_encode($result));
?>

<?php include "templates/footer.php"; ?>
