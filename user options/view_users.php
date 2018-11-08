<?php include('include/dbConfig.php'); 
include('include/div_content.php');  
?>
<?php
if(check_user_role()){
$msg = "";
echo isset($msg)?$msg : "";
?>


    <div class="btn-toolbar">
      <?php if(!isset($_GET['create_user']) || !isset($_GET['update_user']))
      {
      ?>
        <a href="?add_users"><button class="btn btn-primary">Add Users</button></a>
    </div>
    <div class="well">
        
<?php

        }

         

              if(isset($_GET['delete_user']))
              {
                  $sql = "DELETE FROM `users` WHERE `users`.`user_id`={$_GET['delete_user']} LIMIT 1";
                  $result = $con->query($sql);
                  if($result)
                  {
                      $msg .= "Deleted Successfully!";
                  }
              }

              if(isset($_GET['update_user']))
              {
                  $sql = "UPDATE `users` SET `user_id`=,`username`=,`password`=,`email`=,`user_role`= WHERE `users`.`user_id`={$_GET['update_user']} ";


                  //$result = $con->query($sql);
              }

            if(isset($_POST['search_by'])){

                $search_by = isset($_POST['search_by']) ? $_POST['search_by'] : "";
                $search_key = isset($_POST['search_key']) ? $_POST['search_key'] : "";

                 $sql = "SELECT * FROM users where $search_by LIKE '%$search_key%' ";

            }
            else
            {  
                $sql = "SELECT user_id, username, password, email, user_role FROM users";
            }




            if(isset($sql)){
            $result = $con->query($sql);
}   

  ?> 

    <?php

            echo "<table class='table'>";
                $i=0;
                while($row = $result->fetch_assoc())
                {
                    if ($i == 0)
                    {
                        $i++;
                        echo"<tr>";
                        foreach ($row as $key => $value) 
                        {
                            echo"<th>" . $key . "</th>";
                        }
                        echo "<th>" . "Action" . "</th>";
                        echo"</tr>";
                    }
                    echo "<tr>";
                    foreach($row as $key => $value)
                    {
                        echo "<td>" . $value . "</td>"; 
                    }
                        $id =$row['user_id']; 
                        $nsql = "SELECT
                        ub.tran_id,
                        b.Book_Name,
                        b.Author,
                        b.Book_ID,
                        b.Serial_Number,
                        ub.`check-out`
                        FROM
                        books AS b
                        INNER JOIN user_books AS ub ON ub.Book_ID = b.Book_ID
                        where ub.user_id = $id;
                        ";
                        $nresult = $con->query($nsql);
                        echo "<td class='delete_user'>";



    ?>
    <a href="?view_users&update_user=<?php echo $row['user_id']; ?>" class="table-icon edit"></a>
    <a href="?my_books=<?php echo $row['user_id']; ?>"  class="table-icon archive"></a>
    <?php if($nresult-> num_rows <= 0){ ?>
    <a href="?view_users&delete_user=<?php echo $row['user_id']; ?>" class="table-icon delete" onClick="return confirm('Are you sure?')"></a> 
    <?php } ?>

    <?php
                    echo "</td>";
                    echo "</tr>";
                  }
                

            echo"</table>";
            $con->close();
            ?>

<?php
    if(isset($_GET['add_users'])){
     include('user options/add_users.php');
}
}
else{
?>
<div class="n_error"><p>ACCESS DENIED! You do not have the permission to view this page</p></div>
<?php }
include('include/div_end.php'); ?> 


