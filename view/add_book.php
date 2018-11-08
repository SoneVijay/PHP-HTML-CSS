        <?php

        function ImageUpload($uploadOk, $target_file,$imageFileType){
    //var_dump($_FILES["cover"]["size"]);


// Check file size
    if ($_FILES["cover"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        $cover = NULL;
// if everything is ok, try to upload file book_
} else {
    if (move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["cover"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
}
            if(check_user_role()){
            include('include/header.php');

                

                    if(isset($_GET['update'])){
                    $sql = "SELECT * FROM books WHERE `Book_ID`={$_GET['update']} ";

                    $updatedData = $con->query($sql)->fetch_assoc();
                    }else{
                    $updatedData = "";

                    }

                    //image configs
                    $target_dir = "uploads/";
                    $filename = isset($_FILES["cover"]["name"]) ? $_FILES["cover"]["name"] : "";
                    $target_file = $target_dir . basename($filename);
                    $uploadOk = 1;
                    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                        

                    $serialnumber = isset($_POST['serialnumber'])?$_POST['serialnumber']:'';
                    $bookname = isset($_POST['bookname'])?$_POST['bookname']:'';
                    $author = isset($_POST['author'])?$_POST['author']:'';
                    $quantity = isset($_POST['quantity'])?$_POST['quantity']:'';
                    $available = isset($_POST['quantity'])?$_POST['quantity']:'';
                    $cover = isset($_FILES["cover"]["name"])?$_FILES["cover"]["name"]:'';
                    $description = isset($_POST["description"])?$_POST['description']:"";


                    if(isset($_POST['create']) && $_POST['create']!=''){
                        if (empty($_POST["serialnumber"]) || empty($_POST["bookname"]) || empty($_POST["author"]) || empty($_POST["quantity"]) || empty($_POST["description"]))
                        {
                            $serialErr ="Serial Number Required";
                            $nameErr = "Book Name Required";
                            $authorErr = "Author Required";
                            $availableErr = "Availability Required";
                            $quantityErr = "Quantity Required";
                            $descriptionErr = "Description Required";
                            
                        }
                        else
                        {

                            //var_dump($_FILES);die;
                        
                            $check = getimagesize(!empty($_FILES["cover"]["tmp_name"])?$_FILES["cover"]["tmp_name"]:$_FILES["cover"]["name"]);
                            if($check !== false) {
                                echo "File is an image - " . $check["mime"] . ".";
                                $uploadOk = 1;
                            } else {
                                echo "File is not an image.";
                                $uploadOk = 0;
                            }

                            ImageUpload($uploadOk, $target_file,$imageFileType);

                    $query = "INSERT INTO `books` (`Book_ID`, `Serial_Number`, `Book_Name`, `Author`, `Total_Quantity`, `Number_Available`, `Cover`, `description`) VALUES ( Null,'$serialnumber', '$bookname', '$author', '$quantity', '$available', '$cover', '$description')";
                    mysqli_query($con, $query);

                    echo "<h2>Book Added!</h2>";
                    
                }

            }

                if(isset($_POST['update']) && $_POST['update']!=''){
                    
                    $u_id = isset($_POST['update_id'])?$_POST['update_id']:"";
                    ImageUpload($uploadOk, $target_file,$imageFileType);

                    $query = "UPDATE `books` SET Serial_Number = '".$serialnumber."', Book_Name = '".$bookname."', Author = '".$author."', Total_Quantity = '".$quantity."', Number_Available = '".$available."', cover ='".$cover."' WHERE Book_ID='".$u_id."'";
                    $res = mysqli_query($con, $query);
                        if($res){
                           // header('Location:dash.php');
                    echo "<h2>Book Updated!</h2>";
                }else{
                    echo "Something went wrong";
                }
                }
                $con->close();

        ?>

<?php include('include/div_content.php'); ?>
<div class="full_w">
                <div class="h_title">Add New Book</div>
                <form name="books" method="post" enctype="multipart/form-data">
                    <div class="element">
                        <label for="serialnumber">Serial Number <span class="red">(required)</span></label>
                        <input type="number"id="Serial Number" name="serialnumber" class="text <?php echo isset($serialErr)?'err':'';?>" placeholder="serialnumber" value="<?php echo !empty($updatedData['Serial_Number']) ?  $updatedData['Serial_Number']: ""; ?>"/>
                        <span>* <?php echo isset($serialErr)?$serialErr:"";?></span>
                    </div>
                    <div class="element">
                        <label for="bookname">Book Name <span class="red">(required)</span></label>
                        <input type="text" id="book name" name="bookname" value="<?php echo !empty($updatedData['Book_Name']) ?  $updatedData['Book_Name']: ""; ?>" class="text <?php echo isset($nameErr)?'err':'';?>"  placeholder="bookname" />
            <span>* <?php echo isset($nameErr)?$nameErr:"";?></span>
                    </div>
                    <div class="element">
                        <label for="author">Author <span class="red">(required)</span></label>
                        <input type="text" id="Author" name="author"  placeholder="author" value="<?php echo !empty($updatedData['Author']) ?  $updatedData['Author']: ""; ?>" class="text <?php echo isset($authorErr)?'err':'';?>"/>
                         <span>* <?php echo isset($authorErr)?$authorErr:"";?></span>
                     <div class="element">
                        <label for="totalQuantity">Total Quantity <span class="red">(required)</span></label>
                        <input type="number" id="totalQuantity" name="quantity"  placeholder="quantity" value="<?php echo !empty($updatedData['Total_Quantity']) ?  $updatedData['Total_Quantity']: ""; ?>" class="text <?php echo isset($quantityErr)?'err':'';?>" />
            <span>* <?php echo isset($quantityErr)?$quantityErr:""; ?></span>
                    </div>
                    <input type="file" id="cover" name="cover"  value="<?php echo !empty($updatedData['Cover']) ?  $updatedData['Cover']: ""; ?>"/><span></span>
                    <div class="element">
                        <label for="Description">Book Description <span class="red">(required)</span></label>
                        <input type="text" class="textarea" id="Description" name="description" placeholder="description" value="<?php echo !empty($updatedData['description']) ?  $updatedData['description']: ""; ?>" class="text <?php echo isset($descriptionErr)?'err':'';?>"/>
                         <span>* <?php echo isset($descriptionErr)?$descriptionErr:"";?></span>
                    </div>
                   
                    <?php if(isset($updatedData) ? $updatedData : ""){ ?>
                        <div class="entry">
                            <button type="submit" name="update" value="Update Book" class="add">Update Book</button>
                            <input type="hidden" name="update_id" value="<?php echo $updatedData['Book_ID']; ?>">

                        </div>
                    <?php } else { ?>
                        <div class="entry">
                            <button class="add" type="submit" name="create" value="Add Book">Add Book</button>
                        </div>

                    <?php } ?>                    
                </form>
            </div>
<?php include('include/div_end.php'); ?>

<?php  



}else{
include('include/div_content.php');  
?>
<div class="n_error"><p>ACCESS DENIED! You do not have the permission to view this page</p></div>
<?php }
include('include/div_end.php'); ?> 
