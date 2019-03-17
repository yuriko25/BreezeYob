<?php 
  session_start();
  $pageName = "Feed";
  require_once("header.php");
  require_once("serverCode/checklogin.php");
  require_once("serverCode/connect.php");

  if(!empty($_POST)) {
    if(!empty($_POST['postText'])) {
      $text = $mysqli->real_escape_string($_POST['postText']);
      $sql = "INSERT INTO POST (postText, userID) VALUES ('$text', {$_SESSION['userID']})";
      // For Debugging: echo($sql);
      if(!$mysqli->query($sql)) {
        $errorMessage = "Server error. Could not add post. (" . $mysqli->error .")";
      } else {
        $successMessage = "Added post!";
      }
    } else {
      $errorMessage = "No post text.";
    }
  }
?>

<h2>Feed</h2>
<?php
  if(isset($errorMessage)) {
    echo "<div class='error'>$errorMessage</div>";
  } else if(isset($successMessage)) {
    echo "<div class='success'>$successMessage</div>";
  }
?>

<!-- form to add a post -->
<form method="post" id='postForm'>
  <textarea name="postText" id="postTextInput"></textarea>
  <button type="reset">Undo</button>
  <button type="submit">Post</button>
  <div class='clearFix'></div>
</form>
<!-- form to add a post -->

<!-- post list (start) -->
<?php

  $sql = "SELECT * FROM POST JOIN USER ON POST.userID = USER.userID ORDER BY postAdded DESC"; // Joining user record so we can get name without using an additional query.
  $result = $mysqli->query($sql);
  while($row = $result->fetch_assoc()) {
    // Wrap all of the below in one div for easy management in DOM
    echo "<div class='postWrapper clearFix'>";

    // Show the post itself
    $postDateObj = new DateTime($row['postAdded']);
    $postFormatted = date_format($postDateObj, 'F j g:i a T');
    echo "
        <div class='postText'>{$row['postText']}</div>
        <div class='postBy'>{$row['userFirstName']} {$row['userLastName']} / {$postFormatted}</div>
    ";
    // Then, get the most recent 5 comments and show them.
    $sql = "SELECT * FROM COMMENT JOIN USER on COMMENT.userID = USER.userID WHERE postID = {$row['postID']} ORDER BY commentAdded DESC LIMIT 5";
    // For Debugging: echo($sql);
    $comment_result = $mysqli->query($sql);
    while($comment_row = $comment_result->fetch_assoc()) {
      echo"
        <div class='commentWrapper'>
          <div class='commentText'>{$comment_row['commentText']}</div>
          <div class='commentBy'>{$comment_row['userFirstName']} {$comment_row['userLastName']}</div>";
          if($comment_row['userID'] === $_SESSION['userID']) {
            echo "
              <form class='commentDelete'>
                <input type='hidden' name='commentID' value='{$comment_row['commentID']}'>
                <button class='commentDeleteLink'>Delete</button>
              </form>";
          }
      echo"</div>";
    }
    // Finally, offer the viewing user a chance to comment
    echo "
      <div class='commentFormOuterWrapper clearFix'>
        <a class='commentFormLink'>Comment</a>
        <div class='commentFormWrapper hidden'>
          <form method='post' action='comment.php' class='commentForm'>
            <input type='hidden' name='postID' value='{$row['postID']}'>
            <textarea name='commentFormText' id='commentFormText_{$row['postID']}'></textarea>
            <button type='submit'>Comment</button>
          </form>
        </div>
      </div>";

    // End #postWrapper
    echo "</div>";
  }

?>
<script src="js/feed.js"></script>
<?php
require_once("footer.php");