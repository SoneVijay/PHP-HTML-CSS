<?php 
      $con = mysqli_connect("localhost","root","","library");
      // Check connection
      if (mysqli_connect_errno())
        {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        // function reqBook($con,$user_id=NULL,$book_id=NULL){
        // 	$sql = "INSERT INTO `user_books` (`Book_ID`, `user_id`) VALUES ('$book_id', '$user_id')";
        // 	$result = mysqli_query($con, $sql);

        // 	$sub = "UPDATE `books` SET `Number_Available`= Number_Available-1 WHERE Book_ID=$book_id";
        // 	$subresult = mysqli_query($con, $sub);

        // 	if($result){
        // 		echo json_encode(array('msg'=>'Request Sent.'));
        // 	 }
        // }

       //include('./component/helper/helper.php'); 
?>