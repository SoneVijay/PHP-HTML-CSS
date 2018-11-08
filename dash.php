<!-- Includes -->
  <?php include('include/dbConfig.php'); ?>
  <?php //include('./component/helper/helper.php'); ?>
  <?php include('include/session.php'); ?>
  <?php include('include/header.php'); ?>
  <?php include('function.php'); ?>

<!-- topbar -->
 <div class="wrap">
  <div id="header">
    <div id="top">
      <div class="left">
        <p>Welcome, <strong><?php echo $_SESSION["username"] ?></strong> [ <a href="log_out.php">logout</a> ]</p>
      </div>
      <div class="right">
        <div class="align-right">
        </div>
      </div>
    </div>
    <div id="nav">
      <ul>
        <li class="upp"><a href="#">Main control</a>
          <ul>
            <li>&#8250; <a href="">Visit site</a></li>
            <li>&#8250; <a href="">Reports</a></li>
            <li>&#8250; <a href="">Add new page</a></li>
            <li>&#8250; <a href="">Site config</a></li>
          </ul>
        </li>
        <li class="upp"><a href="#">Manage content</a>
          <ul>
            <li>&#8250; <a href="">Show all pages</a></li>
            <li>&#8250; <a href="">Add new page</a></li>
            <li>&#8250; <a href="">Add new gallery</a></li>
            <li>&#8250; <a href="">Categories</a></li>
          </ul>
        </li>
        
      
       <!--  <li class="upp"><a href="#">Settings</a>
          <ul>
            <li>&#8250; <a href="">Site configuration</a></li>
            <li>&#8250; <a href="">Contact Form</a></li>
          </ul> -->
        </li>
      </ul>
    </div>
  </div>

<!-- sidebar -->
  <div id="content">
      <div id="sidebar">
        <div class="box">
          <div class="h_title">&#8250; Main control</div>
          <ul id="home">
            <li class="b1"><a class="icon view_page" href="dash.php">Home</a></li>
            <!-- <li class="b2"><a class="icon report" href="">Reports</a></li>
            <li class="b1"><a class="icon add_page" href="">Add new page</a></li>
            <li class="b2"><a class="icon config" href="">Site config</a></li> -->
          </ul>
        </div>

        <div class="box">
          <div class="h_title">&#8250; Manage Library</div>
          <ul>
            <li class="b1"><a class="icon page" href="?view_books">View Library</a></li>
            <?php if(check_user_role()){ ?>
            <li class="b2"><a class="icon add_page" href="?add_books">Add New Book</a></li>
            <?php } ?>
            <li class="b1"><a class="icon page" href="?my_books=<?php echo $_SESSION["user_id"]; ?>">My Books</a></li>
            <!-- <li class="b1"><a class="icon photo" href="">Add new gallery</a></li>
            <li class="b2"><a class="icon category" href="">Categories</a></li> -->
          </ul>
        </div>
        <?php if(check_user_role()){ ?>
        <div class="box">
          <div class="h_title">&#8250; Manage Users</div>
          <ul>
            <li class="b1"><a class="icon users" href="?view_users">Show all users</a></li>
            <li class="b2"><a class="icon add_user" href="?add_users">Add new user</a></li>
            <!-- <li class="b1"><a class="icon block_users" href="">Lock users</a></li> -->
          </ul>
        </div>
        <?php } ?>
        <div class="box">
          <div class="h_title">&#8250; Settings</div>
          <ul>
            <li class="b1"><a class="icon config" href="">Site configuration</a></li>
            <li class="b2"><a class="icon contact" href="">Contact Form</a></li>
          </ul>
        </div>
      </div>

<!-- Slides -->
  <?php 
  $sql = "SELECT
  user_books.tran_id,
  books.Book_Name,
  books.Author,
  books.Cover,
  user_books.user_id,
  user_books.Book_ID
  FROM
  books
  INNER JOIN user_books ON user_books.Book_ID = books.Book_ID
  Where user_id={$_SESSION["user_id"]}"
  ;
  $result = $con->query($sql);
  if(empty($_GET)) { 
    ?>
  <div class="accordian"> 
    <ul>
  <?php while($row = $result->fetch_assoc()){ ?>
      <li>
        <div class="image_title">
          <a href="dash.php?book_template=<?php echo $row['Book_ID']?>"><?php echo $row["Book_Name"]?></a>
        </div>
        <a href="dash.php?book_template=<?php echo $row['Book_ID']?>">
       <img src="uploads/<?php echo $row['Cover']?>">
        </a>
      </li>
      <?php } ?>
         
    </ul>
  </div>  

<!-- Links  -->
  <?php 

  }

  if(isset($_GET['add_books']) || isset($_GET['update']) && check_user_role()){
       include('view/add_book.php');
  }

  if(isset($_GET['view_books']) || isset($_GET['delete'])){
      include('view/view_books.php');
  }

  if(isset($_GET['add_users']) || isset($_GET['update_user']) && check_user_role()){
      include('user options/add_users.php');
  }

  if(isset($_GET['view_users']) || isset($_GET['delete_user']) && check_user_role()){
       include('user options/view_users.php');
  }

  if(isset($_GET['book_template'])){
       include('view/book_template.php');
  }

  if(isset($_GET['my_books'])){
       include('user options/my_books.php');
  }
  ?>
  <?php include('include/footer.php'); ?>