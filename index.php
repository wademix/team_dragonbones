<?php include "templates/header.php"; ?><h2>New blog post</h2>

    <form method="post">
    	<label for="title">Title</label>
    	<input type="text" name="title" id="title">
    	<label for="comment">Comment</label>
    	<input type="text" name="comment" id="comment">
    	<input type="submit" name="submit" value="Submit">
    </form>

<?php include "templates/footer.php"; ?>