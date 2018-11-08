
<?php


$msg = "";
echo isset($msg)?$msg : "";
?>


    <div class="well">
        
<?php

                $sql = "SELECT
ub.tran_id,
b.Book_Name,
b.Author,
b.Book_ID,
b.Serial_Number,
ub.`check-out`
FROM
books AS b
INNER JOIN user_books AS ub ON ub.Book_ID = b.Book_ID
where ub.user_id = {$_GET['my_books']}
";
                $result = $con->query($sql);

                


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
                        if(check_user_role()){echo "<th>" . "Action" . "</th>";}
                        echo"</tr>";
                    }
                    echo "<tr>";
                    foreach($row as $key => $value)
                    {
                        echo "<td>" . $value . "</td>"; 
                    }
                        echo "<td class='delete_user'>";
?>

     <?php                 
if(check_user_role()){
    ?>

    
   <button class="return-book" data-tran-id="<?php echo $row["tran_id"]; ?>" data-book-id="<?php echo $row["Book_ID"]; ?>" >Return Book</button>

    <?php                }
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

include('include/div_content.php');  
?>
<!-- <div class="n_error"><p>ACCESS DENIED! You do not have the permission to view this page</p></div> -->
<?php 
include('include/div_end.php'); ?> 


