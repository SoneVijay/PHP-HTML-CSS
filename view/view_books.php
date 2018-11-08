 


<?php

$msg = "";
echo isset($msg)?$msg : "";
$rec_limit = 5;
?>

    <div class="btn-toolbar">
       <?php if(check_user_role()){ 
       if(!isset($_GET['create']) || !isset($_GET['update']) ){ 
        ?>
       <a href="?view_books" ><button class="btn btn-primary">View Book</button></a>
       <a href="?add_books"><button class="btn btn-primary">Create Book</button></a>
       <?php } else {?>
       <a href="?update"><button class="btn btn-primary">Update Book</button></a>  
       </div>
<!-- Search -->
<?php } }
 include('view/search.php');  ?>
<div class="element">
  <label for="search">Search: </label>
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search In Page..">
  </label>
</div>
<?php include('include/dbConfig.php'); ?>


    <div class="well">

     <?php
              if(isset($_GET['delete']) && check_user_role())
              {
                  $sql = "DELETE FROM `books` WHERE `books`.`Book_ID`={$_GET['delete']} LIMIT 1";
                  $result = $con->query($sql);
              }

              if(isset($_GET['update']) && check_user_role())
              {
                  $sql = "UPDATE `books` SET `Book_ID`=,`Serial_Number`=,`Book_Name`=,`Author`=,`Total_Quantity`=,`Number_Available`= WHERE 1";


                  $result = $con->query($sql);
                  if($result)
                  {
                      $msg .= "Deleted Successfully!";
                  }
              }

                $countsql = "SELECT count(Book_ID) FROM books";
                $countresult= $con->query($countsql);
                $row = mysqli_fetch_array($countresult, MYSQLI_NUM);
                $rec_count = $row[0];
              if (isset($_GET['page']))
              { 
                $page = ($_GET['page']);
                $offset = ($page-1) * $rec_limit;
                }
              else
              {
                $page = 1;
                $offset = 0;
              }
            if(isset($_POST['search'])){


                $search_by = isset($_POST['search_by']) ? $_POST['search_by'] : "";
                $search_key = isset($_POST['search_key']) ? $_POST['search_key'] : "";

                 $sql = "SELECT Book_ID, Serial_Number, Book_Name, Author, Total_Quantity, Number_Available FROM books where $search_by LIKE '%$search_key%' ";
                 $result = $con -> query($sql);
                  $countresult= $con->query($sql);
                $row = mysqli_fetch_array($countresult, MYSQLI_NUM);
                $rec_count = $row[0];

            }else{  
              $left_rec = $rec_count -($page * $rec_limit);
                $sql = "SELECT Book_ID, Serial_Number, Book_Name, Author, Total_Quantity, Number_Available FROM books LIMIT $offset, $rec_limit";
        include('include/div_content.php');

            $result = $con->query($sql);
          }

  ?> 
        
       
<?php
    
        echo "<table class='table' id='view'>";
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
                    echo "<td class='delete'>";



if(check_user_role()){
?>
<a href="?view_books&update=<?php echo $row['Book_ID']; ?>" class="table-icon edit"></a>
<a href="?view_books&delete=<?php echo $row['Book_ID']; ?>"  class="table-icon delete" onClick="return confirm('Are you sure?')"></a>
<?php } ?>
<a href="?book_template=<?php echo $row['Book_ID']; ?>"  class="table-icon archive"></a>


<?php
                echo "</td>";
                echo "</tr>";
            }
        echo"</table>";

        ?>
          <div class="entry">
          <?php if(!isset($_POST['search'])) { ?>
          <div class="pagination">
          <?php if($page != 1) {?>
            <a href='?view_books&page=1'>« First</a>
            <a href='?view_books&page=<?php echo ($page-1)  ?>'>< Previous</a>
            <?php 
          }
              $n = $rec_count / $rec_limit; //number of pagination
              $n = ceil($n);
              for($i = $page; $i <= $page+2; $i++) 
              {
                if($i>=$n-2)
                {
                  break;
                }
                echo "<a href ='?view_books&page=". $i ."'>" . $i . "</a> ";
            } 

                if($page < $n-4){
          ?>
            <span>...</span>
            <?php
          } 
              // for($i = $n-4; $i <= $n; $i++)
              {
                echo "<a href ='?view_books&page=". ($n-2) ."'>" . ($n-2) . "</a> ";
                echo "<a href ='?view_books&page=". ($n-1) ."'>" . ($n-1) . "</a> ";
                echo "<a href ='?view_books&page=". $n ."'>" . $n . "</a> ";
              }
           if($page!=$n){  
            ?>   
            <a href='?view_books&page=<?php echo ($page+1)  ?>'>Next ></a>
            <a href="?view_books&page=<?php echo $n?>">Last »</a>
            <?php }?>
          </div>
          <?php }?>


          <div class="sep"></div>
        <?php  
        include('include/div_end.php');

        $con->close();
        ?>

        <script>
        function myFunction() {
          var input, filter, table, tr, td, i;
          input = document.getElementById("myInput");
          filter = input.value.toUpperCase();
          table = document.getElementById("view");
          tr = table.getElementsByTagName("tr");
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
            if (td) {
              if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            }       
          }
        }
        </script>
