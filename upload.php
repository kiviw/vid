<?php
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the video title and description from the form
  $title = $_POST['title'];
  $description = $_POST['description'];

  // Get the video file from the form
  $videoFile = $_FILES['video'];

  // Check if the file was uploaded without errors
  if ($videoFile['error'] === UPLOAD_ERR_OK) {
    // Generate a unique name for the video file
    $videoName = uniqid('video_') . '.' . pathinfo($videoFile['name'], PATHINFO_EXTENSION);
    // Move the uploaded file to the server's videos directory
    if (move_uploaded_file($videoFile['tmp_name'], '/var/www/html/videos/' . $videoName)) {
      // Save the video title, description and file name to the database
      $db = new PDO('mysql:host=localhost;dbname=mydatabase', 'myusername', 'mypassword');
      $query = $db->prepare('INSERT INTO videos (title, description, filename) VALUES (?, ?, ?)');
      $query->execute([$title, $description, $videoName]);
      // Redirect the user to the success page
      header('Location: /success.html');
      exit;
    } else {
      echo 'Failed to move the uploaded file to the server';
    }
  } else {
    echo 'Failed to upload the file';
  }
}
?>
