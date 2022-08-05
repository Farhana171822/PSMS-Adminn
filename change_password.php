<?php 
    require_once('header.php');

    if(isset($_POST['change_btn'])){
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        $admin_id = $_SESSION['admin_loggedin'][0]['id'];

        $statement = $pdo->prepare("SELECT password FROM admin WHERE id=?");
        $statement->execute(array($admin_id));
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $db_password = $result[0]['password'];



        if(empty($current_password)){
            $error = "Current Password is required!";
        }
        else if(empty($new_password)){
            $error = "New Password is required!";
        }
        else if(empty($confirm_password)){
            $error = "Confirm Password is required!";
        }
        else if($new_password != $confirm_password){
           $error = " New Password or Confirm Password is not matched!";
        }
        elseif(SHA1($current_password) != $db_password){
            $error = " Current Password is not matched!";
        }

        // sob condition match korle lasr else a password update krbe
        else{
            $new_password=SHA1($confirm_password);

            $stm=$pdo->prepare("UPDATE admin SET password=? WHERE id=?");
            $stm->execute(array($new_password,$admin_id));
            $success = "Password Changed!";

            // session_destroy();
            // header('location:logout.php');
        }
        
    }


?>

<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white mr-2">
      <i class="mdi mdi-lock"></i>                 
    </span>
    Change Password
  </h3>
</div>


<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
        
        <?php if(isset($error)) :?>
            <div class="alert alert-danger">
                <?php echo $error;?>
            </div>
        <?php endif;?>
        <?php if(isset($success)) :?>
            <div class="alert alert-success">
                <?php echo $success;?>
            </div>
        <?php endif;?>
            
        <form class="forms-sample" method="POST" action="">
            <div class="form-group">
                <label for="c_password">Current Password</label>
                <input type="password" name="current_password" class="form-control" id="c_password" placeholder="Current Password">
            </div>
            
            
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" name="new_password" class="form-control" id="new_password" placeholder="New Password">
            </div>

            <div class="form-group">
                <label for="c_new_password">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" id="c_new_password" placeholder="Confirm New Password">
            </div>

            <button type="submit" name="change_btn" class="btn btn-gradient-primary mr-2">Change Password</button>
            </form>
          </div>
    </div>
</div>


<?php require_once('footer.php');?>


