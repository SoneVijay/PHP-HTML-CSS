<?php
include('C:\xampp\htdocs\Library\include\dbConfig.php');
$user_id = isset($_POST['user_id'])?$_POST['user_id']:"";
$book_id = isset($_POST['book_id'])?$_POST['book_id']:"";

$sql = "INSERT INTO `user_books` (`Book_ID`, `user_id`) VALUES ('$book_id', '$user_id')";
$result = mysqli_query($con, $sql);

$sub = "UPDATE `books` SET `Number_Available`= Number_Available-1 WHERE Book_ID=$book_id";
$subresult = mysqli_query($con, $sub);

if($result){
	echo json_encode(array('msg'=>'Request Sent.'));
 }
?>