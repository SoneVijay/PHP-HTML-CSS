<?php
include('C:\xampp\htdocs\Library\include\dbConfig.php');
$Book_ID = isset($_POST['Book_ID'])?$_POST['Book_ID']:"";
$tran_id = isset($_POST['tran_id'])?$_POST['tran_id']:"";
//var_dump($Book_ID); var_dump($tran_id); 
$sql = "DELETE FROM `user_books` WHERE `user_books`.`tran_id`=$tran_id LIMIT 1";
		$result = mysqli_query($con, $sql);

$add = "UPDATE `books` SET `Number_Available`= Number_Available+1 WHERE Book_ID=$Book_ID";
$addresult = mysqli_query($con, $add);



if($result){
	echo json_encode(array('msg'=>'Book Returned!'));
 }
?>