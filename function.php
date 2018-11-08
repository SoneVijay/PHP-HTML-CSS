<?php
function check_user_role()
{
	if($_SESSION["user_role"] != 0)
	{
		return false;
	}
	else
	{
		return true;
	}
	
}

?>

<?php 
/*function rent_book()
{
	// $con = mysqli_connect("localhost","root","","library");

 //            // Check connection
 //            if (mysqli_connect_errno())
 //              {
 //              echo "Failed to connect to MySQL: " . mysqli_connect_error();
 //              }

    mysqli_select_db($con, 'user_books');

    	$user_id=$_SESSION["user_id"];
    	$book_id=$_SESSION["Book_ID"];
    	$sql = "INSERT INTO `user_books` (`Book_ID`, `user_id`) VALUES ('$user_id', '$book_id')";
    	mysqli_query($con, $sql);

    	echo "<h2>Book Rented!</h2>";
      $con -> close();
}
*/
?>
