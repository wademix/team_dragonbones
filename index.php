<?php include "templates/header.php"; ?><h2>New blog post</h2>

    <!-- begin::new blog post-->
    <form method="post">
    	<label for="title">Title</label>
    	<input type="text" name="title" id="title">
    	<label for="comment">Comment</label>
    	<input type="text" name="comment" id="comment">
    	<input type="submit" name="submit" value="Submit">
    </form>
    <!-- end:: new blog post-->

    <!-- begin::write blog post to file -->
    <!--Front end devs keep off, wizards at work {-_-}-->
    <!--seriously though, this code powers the backend do not modify-->

    <?php if(isset($_POST['submit'])) {
        $new_post = array(
          "userID" => 1,
          "title" => $_POST['title'],
          "comment" => $_POST['comment']
        );

        // print to screen as feedback
        //echo ($new_post['title'] . "<br>". $new_post['comment']);

        // use blog title as file name.
        // to be updatd to also use user email for unique posts
        // replace spaces in title with underscores
        $fileName = str_replace(' ', '_', $_POST['title']);
        $file = 'BlogPosts/'.$fileName.'.json';

        // write to file
        file_put_contents($file, json_encode($new_post));
      }
    ?>
    <!-- end:: write blog post to file-->

    <!-- begin:: load blog posts-->
    <?php

    require_once 'functions/Post.php';
    
    $data = file_get_contents("BlogPosts/dragonbone.json");
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
    <!-- end:: load blog posts-->

<?php include "templates/footer.php"; ?>
