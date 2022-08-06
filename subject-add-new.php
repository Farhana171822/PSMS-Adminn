<?php 
    require_once('header.php');  //config header a call kora ache tai ei khane drkr nei

    $admin_id = $_SESSION['admin_loggedin'][0]['id'];

    if(isset($_POST['change_btn'])){
        $sub_name = $_POST['sub_name'];
        $sub_code = $_POST['sub_code'];
        $sub_type = $_POST['sub_type'];

        // count row of teacher
        $codeCount = getCount('subject','code',$sub_code);

        if(empty($sub_name)){
            $error = "Subject Name is required!";
        }
        else if(empty($sub_code)){
            $error = "Email is required!";
        }
        else if(empty($sub_type)){
            $error = "Mobile is required!";
        }
        else if($codeCount != 0){
            $error = " Already Used Subject Code!";
        }
        else{
            // $password = SHA1($t_password);
            // $created_at = date('Y-m-d H:i:s');

            $insert = $pdo->prepare("INSERT INTO subject(name,code,type) VALUES(?,?,?)");
            $insert->execute(array($sub_name,$sub_code,$sub_type));
            $success = "Added Subject Done!";
        }
        
    }

?>

<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white mr-2">
      <i class="mdi mdi-book-open-variant "></i>                 
    </span>
    Add New Subject
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
                <label for="sub_name">Subject Name</label>
                <input type="text" name="sub_name" class="form-control" id="sub_name" placeholder="Subject Name">
            </div>
            
            
            <div class="form-group">
                <label for="sub_code">Subject Code</label>
                <input type="text" name="sub_code" class="form-control" id="sub_code" placeholder="Subject Code">
            </div>
            <div class="form-group">
                <label>Subject Type</label>&nbsp;&nbsp;&nbsp;
                <label><input type="radio" name="sub_type" value="Theory">&nbsp;Theory</label> &nbsp;
                <label><input type="radio" name="sub_type" value="Practical">&nbsp;Practical</label>&nbsp;
            </div>
            <button type="submit" name="change_btn" class="btn btn-gradient-primary mr-2">Add Subject</button>
            </form>
          </div>
    </div>
</div>


<?php require_once('footer.php');?>