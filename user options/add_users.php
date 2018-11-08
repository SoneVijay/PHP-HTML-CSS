        <?php
        if(check_user_role()){
            include('include/header.php');
            
            

            

            if(isset($_GET['update_user'])){
            $sql = "SELECT * FROM users WHERE `user_id`={$_GET['update_user']} ";

            $updatedData = $con->query($sql)->fetch_assoc();
            }else{
            $updatedData = "";

            }

            $username = isset($_POST['username'])?$_POST['username']:'';
            $password = isset($_POST['password'])?$_POST['password']:'';
            $password = md5($password);
            $email = isset($_POST['email'])?$_POST['email']:'';
            $role = isset($_POST['role'])?$_POST['role']:'';



            if(isset($_POST['create_user']) && $_POST['create_user']!='')
            {
                if (empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["email"]) || empty($_POST["role"]) || !filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    $userErr = "Username Required";
                    $passErr = "Password Required";
                    $emailErr= "Valid Email Required";
                }
                else
                {
                        
                    $query = "INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `user_role`) VALUES (NULL, '$username', '$password', '$email', '$role')";
                    mysqli_query($con, $query);

                    echo "<h2>User Added!</h2>";
                }
            }
            
            if(isset($_POST['update_user']) && $_POST['update_user']!=''){
                
                $u_id = isset($_POST['update_user-id'])?$_POST['update_user-id']:"";
                //var_dump($u_id);
                $query = "UPDATE `users` SET username = '".$username."', password = '".$password."', email = '".$email."', user_role = '".$role."' WHERE user_id = '".$u_id."'";
                //var_dump($query);
                $res = mysqli_query($con, $query);
                //var_dump($res);die;
                if($res){
                //header('Location:dash.php');
                echo "<h2> Updated!</h2>";
            }else{
                //echo (mysqli_error($res));
                echo "Something went wrong";
            }
            }
            $con->close();
            

        ?>

<?php include('include/div_content.php'); ?>
<div class="full_w">
                <div class="h_title">Add new User</div>
                <form name="user" method="post" enctype="multipart/form-data">
                    <div class="element">
                        <label for="username">Username <span class="red">(required)</span></label>
                        <input id="userName" name="username" class="text <?php echo isset($userErr)?'err':'';?>" placeholder="username" value="<?php echo !empty($updatedData['username']) ?  $updatedData['username']: ""; ?>"/>
                        <span>* <?php echo isset($userErr)?$userErr:"";?></span>
                    </div>
                    <div class="element">
                        <label for="password">Password <span class="red">(required)</span></label>
                        <input type="password" id="password" name="password"  placeholder="password"= value="" class="text <?php echo isset($passErr)?'err':'';?>"/>
                        <span>* <?php echo isset($passErr)?$passErr:"";?></span>
                    </div>
                    <div class="element">
                        <label for="username">Email <span class="red">(required)</span></label>
                        <input type="text" id="Email" name="email"  placeholder="email" value="<?php echo !empty($updatedData['email']) ?  $updatedData['email']: ""; ?>" class="text <?php echo isset($emailErr)?'err':'';?>"/>
            <span>* <?php echo isset($emailErr)?$emailErr:"";?></span>
                    </div>
                    <div class="element">
                        <label for="role">User Role</label>
                        
                                Member: <input type="radio" name="role" placeholder= "role" value="<?php echo !empty($updatedData['role']) ?  $updatedData['role']: "2"; ?>" />
                                
                               <!--  Staff: <input type="radio" name="role" placeholder="role" value="<?php// echo !empty($updatedData['role']) ?  $updatedData['role']: "1"; ?>" />
     -->
                                Admin: <input type="radio" name="role" placeholder="role" value="<?php echo !empty($updatedData['role']) ?  $updatedData['role']: "0"; ?>" />
                    </div>

                    <?php if(isset($updatedData) ? $updatedData : ""){ ?>
                        <div class="entry">
                            <button type="submit" name="update_user" value="Update User" class="add">Update User</button>
                            <input type="hidden" name="update_user-id" value="<?php echo $updatedData['user_id']; ?>">
                        </div>
                    <?php } else { ?>
                        <div class="entry">
                            <button class="add" type="submit" name="create_user" value="Add User">Add User</button>
                        </div>

                    <?php } ?>                    
                    







                </form>
            </div>
<?php include('include/div_end.php'); 
}else{
include('include/div_content.php');  
?>
<div class="n_error"><p>ACCESS DENIED! You do not have the permission to view this page</p></div>
<?php }
include('include/div_end.php'); ?> 
