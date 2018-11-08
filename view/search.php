 <?php include('C:\xampp\htdocs\Library\include\div_content.php');?>
 <form name="search" method="POST">
 	<div class="element">
 	<label for="search">Search</label>
    	<input type="text" name="search_key"/> in 
   	<Select name="search_by" class ="err">
        	<Option value="Book_ID">Book_ID</option>
        	<Option value="Book_Name">Book Name</option>
        	<Option value="Author">Author</option>
    </Select>
    <input type="submit" name="search" value="Search" />
    </div>
 </form>

<?php include('C:\xampp\htdocs\Library\include\div_end.php');?>







 ​