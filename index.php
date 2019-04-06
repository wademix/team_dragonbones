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
          "title" => $_POST['title'],
          "comment" => $_POST['comment']
        );

        // print to screen as feedback
        //echo ($new_post['title'] . "<br>". $new_post['comment']);

        // use blog title as file name.
        // to be updatd to also use user email for unique posts
        // replace spaces in title with underscores
        $fileName = str_replace(' ', '_', $_POST['title']);
        $file = 'BlogPosts/'.$fileName.'.txt';

        // write to file
        // title goes on first line
        // comment follows on a new line
        file_put_contents($file, $new_post['title']."\n".$new_post['comment']);

        
      }
    ?>
    <!-- end:: write blog post to file
    
<?php include "templates/footer.php"; ?>