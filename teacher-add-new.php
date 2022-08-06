<?php 
    require_once('header.php');  //config header a call kora ache tai ei khane drkr nei

    $admin_id = $_SESSION['admin_loggedin'][0]['id'];

    if(isset($_POST['change_btn'])){
        $t_name = $_POST['t_name'];
        $t_email = $_POST['t_email'];
        $t_mobile = $_POST['t_mobile'];
        $t_address = $_POST['t_address'];
        $t_gender = $_POST['t_gender'];
        $t_password = $_POST['t_password'];

        // count row of teacher
        $emailCount = teacherCount('email',$t_email);
        $mobileCount = teacherCount('mobile',$t_mobile);//column name "mobile",,,value is "$t_mobile"

        if(empty($t_name)){
            $error = "Name is required!";
        }
        else if(empty($t_email)){
            $error = "Email is required!";
        }
        else if(empty($t_mobile)){
            $error = "Mobile is required!";
        }
        else if(empty($t_password)){
            $error = "Password is required!";
        }
        else if($emailCount != 0){
            $error = "Used Email!";
        }
        else if($mobileCount != 0){
            $error = "Used Mobile Number!";
        }
        else{
            $password = SHA1($t_password);
            $created_at = date('Y-m-d H:i:s');

            $insert = $pdo->prepare("INSERT INTO teachers(name,email,mobile,address,gender,password,created_at) VALUES(?,?,?,?,?,?,?)");
            $insert->execute(array($t_name,$t_email,$t_mobile,$t_address,$t_gender,$password,$created_at));
            $success = "Teacher Account Create Success!";
        }
        
    }

?>

<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white mr-2">
      <i class="mdi mdi-account-outline"></i>                 
    </span>
    Add New Teacher
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
                <label for="t_name">Teacher Name</label>
                <input type="text" name="t_name" class="form-control" id="t_name" placeholder="Teacher Name">
            </div>
            
            
            <div class="form-group">
                <label for="t_email">Teacher Email</label>
                <input type="text" name="t_email" class="form-control" id="t_email" placeholder="Teacher Email">
            </div>

            <div class="form-group">
                <label for="t_mobile">Teacher Mobile</label>
                <input type="text" name="t_mobile" class="form-control" id="t_mobile" placeholder="Teacher Mobile">
            </div>
            <div class="form-group">
                <label for="t_address">Address</label>
                <input type="address" name="t_address" class="form-control" id="t_address" placeholder="Teacher Mobile">
            </div>
            <div class="form-group">
                <label for="">Gender</label>&nbsp;&nbsp;&nbsp;
                <label><input type="radio" name="t_gender" value="Male" id="t_male" checked>&nbsp;Male</label> &nbsp;
                <label><input type="radio" name="t_gender" value="Female" id="t_female">&nbsp;Female</label>&nbsp;
            </div>
            <div class="form-group">
                <label for="t_password">Password</label>
                <input type="password" name="t_password" class="form-control" id="t_password">
            </div>

            <button type="submit" name="change_btn" class="btn btn-gradient-primary mr-2">Add Teacher Account</button>
            </form>
          </div>
    </div>
</div>


<?php require_once('footer.php');?>


