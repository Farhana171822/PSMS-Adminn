<?php require_once('header.php');?>
<?php


$user_id = $_SESSION['teacher_loggedin'][0]['id'];




if(isset($_POST['change_btn'])){

	$current_password = $_POST['current_password'];
	$new_password = $_POST['new_password'];
	$confirm_new_password = $_POST['confirm_new_password'];

	$db_password = teacherData('password',$user_id);

	if(empty($current_password)){
		$error = "Current Password is requird!";
	}
	else if(empty($new_password)){
		$error = "New Password is requird!";
	}
	else if(empty($confirm_new_password)){
		$error = "Confirm New Password is requird!";
	}
	else if($db_password != SHA1($current_password)){
		$error = "Current Password Is Wrong!";
	}
	else if($new_password != $confirm_new_password){
		$error = "New Password Doesn't Match!";
	}
	else if(strlen($new_password) < 5){
		$error = "Password Must Be More Then 5 Digit!";
	}
	else if($db_password == SHA1($new_password)){
		$error = "Try New Password! You cannot enter the previous password twice.";
	}
	else {
		$update = $pdo->prepare("UPDATE teachers SET password=? WHERE id=?");
		$update->execute(array(SHA1($new_password),$user_id));

		

		$success = "Password Updated Successfully!";
	}
}




?>


<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class=" mdi mdi-account-check"></i>                 
        </span>
        New Attendance
    </h3>
</div>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                
                <?php if(isset($error)) :?>
                <div class="alert alert-danger"><?php echo $error;?></div>
                <?php endif;?>
                <?php if(isset($success)) :?>
                <div class="alert alert-success"><?php echo $success;?></div>
                <?php endif;?>
                
                <form class="forms-sample" method="POST" action="">
                    <div class="row">
                        <div class="col md-4">
                            <div class="form-group">
                                <label for="select_class">Select Class</label>
                                <select class="form-control" name="select_class" id="select_class">
                                    <option value="">Select Class</option>
                                </select>

                            </div>
                        </div>
                        
                        <div class="col md-4">
                            <div class="form-group">
                                <label for="select_subject">Select Subject</label>
                                <select class="form-control" name="current_password" id="current">
                                    <option value="">Select Subject</option>
                                </select>

                                
                            </div>
                        </div>

                        <div class="col md-4">
                            <div class="form-group">
                                <label for="att_date">Select Date</label>
                                <input type="date" class="form-control" name="att_date" id="att_date">
                            </div>
                        </div>
 
                        <div class="col md-4">
                            <div class="form-group">
                            <button type="submit" name="change_btn" class="btn btn-gradient-primary mr-2">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- <div class="row"> -->
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Student Name</th>
                                <th>Student Roll</th>
                                <th>Absent</th>
                                <th>Present</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td>#</td>
                            <td>AB</td>
                            <td>5</td>
                            <td><label for="Absent"><input type="radio" value="0" name="status" class="" id="Absent"> Absent</label></td>
                            <td><label for="Present"><input type="radio" value="1" name="status" class="" id="Present"> Present</label></td>
                        </tbody>
                    </table>

                    <div class="form-group">
                        <input type="submit" class="btn btn-gradient-primary mr-2" value="Submit Attendence" class="">
                    </div>
                </div>
            </div>
        </div>
    <!-- </div> -->






</div>


<?php require_once('footer.php');?>
