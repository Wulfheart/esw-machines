
 <?php
$id = $_POST['id'];
$time =  date('Y-m-d H:i:s', $_POST['time']);
$full = $_POST['full'];
$room = $_POST['room'];


// Create connection
$conn = mysqli_connect('localhost','u809243528_hausmeister','Pepino24','u809243528_wash_machine');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE `wash_maschine_table` SET `Time`='$time',`Full`=$full,`Room`=$room WHERE `MashineID`=$id";

if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();
?> 