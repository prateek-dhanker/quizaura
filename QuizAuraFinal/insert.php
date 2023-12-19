<?php
if (isset($_GET['action']) && $_GET['action'] === 'insert_score') {
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "users123";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Get user ID and score from the POST request
  $subName = $_POST['subName'];
  $score = $_POST['score'];
  $userid = $_COOKIE['userid'];
  // Insert data into the quiz_scores table
  $sql = "INSERT INTO `scorecard` (`userid`, `subject`, `score`) VALUES ('$userid', '$subName', '$score')";

  if ($conn->query($sql) === False) {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  // Close connection
  $conn->close();
}
?>
