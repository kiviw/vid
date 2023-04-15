<?php
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the video title and description from the form
  $title = $_POST['title'];
  $description = $_POST['description'];

  // Get the video file from the form
