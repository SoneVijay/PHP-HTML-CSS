<?php //include('./component/helper/helper.php'); ?>
<?php  
//include(include('component/helper/helper.php')); 
            $sql = "SELECT Book_ID, Serial_Number, Book_Name, Author, Total_Quantity, Number_Available, Cover, description FROM books WHERE Book_ID={$_GET['book_template']}";
            
            $result = $con -> query($sql);
            // var_dump($result);
            if ($result -> num_rows > 0)
            {
            	while($row = $result -> fetch_assoc())
            	{
         	 


?>



<div class="container">
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">
						
						<div class="preview-pic tab-content">
						  <div class="tab-pane active">
						  <?php if(empty($row["Cover"])){ ?>
						  	<img style="padding-right:20px;" src="NoImg.png"/>
						  <?php }else{ ?>
						  	<img style="padding-right:20px;" src="uploads/<?php echo $row["Cover"] ?>"/>
						  <?php } ?>	
						  </div>
						</div>				
					</div>
					<div class="details col-md-6" style="padding-left:20px;">
						<h2 class="product-title"><?php echo $row["Book_Name"]; ?></h2>
						<h4 class="product-title"><?php echo "Author: " .$row["Author"]; ?></h4>
						<h4 class="product-title"><?php echo "Book ID: " .$row["Book_ID"]; ?></h4>
						<h4 class="product-title"><?php echo "Total Quantity: " .$row["Total_Quantity"]; ?></h4>
						<h4 class="product-title"><?php echo "Quantity Available: " .$row["Number_Available"]; ?></h4>
						
						<p class="product-description" style="font-weight: bold; color: #595959;"> Description: <?php echo $row["description"]; ?> </p>
						<div class="action">

						<?php 
						$check = "SELECT
						ub.tran_id,
						b.Book_ID,
						b.Serial_Number,
						u.user_id
						FROM
						books AS b
						INNER JOIN user_books AS ub ON ub.Book_ID = b.Book_ID
						INNER JOIN users AS u ON ub.user_id = u.user_id
						where b.Book_ID = {$_GET['book_template']} AND ub.user_id = {$_SESSION["user_id"]}
						";
						$resultcheck = $con->query($check);
						$userid=0;
						$bookid=NULL;
						while($checkrow = $resultcheck -> fetch_assoc()){
							$bookid=$checkrow["Book_ID"];
							$userid=$_SESSION["user_id"];

						}
						
						if ( $bookid == $_GET["book_template"] && $userid == $_SESSION["user_id"]){ ?>
						
						<div class="n_warning"><h3>Book Already Requested!</h3></div>
							<?php }
						elseif($row["Number_Available"] > 0 ){  ?>
						<button class="add-to-cart btn btn-default" data-book-id="<?php echo $row["Book_ID"]; ?>" data-user-id="<?php echo $_SESSION['user_id']; ?>"> Request Book </button>
						</div>
						<?php }
							else{
						?>
						<div class="n_warning"><h3>Book Not Available!</h3></div>
						<?php }	?>	
					</div>
				</div>
			</div>
		</div>
	</div>

<?php 
}
}

?>