<?php 
    require_once('header.php');  //config header a call kora ache tai ei khane drkr nei

    $admin_id = $_SESSION['admin_loggedin'][0]['id'];

    if(isset($_POST['change_btn'])){
        $name = $_POST['name'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        // table er na  ta alada vabe define kre nite hbe
        if(isset($_POST['subject'])){
            $subject = $_POST['subject'];
        }
        else{
            $error = "";
        }
        

        print_r($subject);

        // count row of teacher
        //$codeCount = getCount('subject','code',$sub_code);

        if(empty($name)){
            $error = "Class Name is required!";
        }
        else if(empty($start_date)){
            $error = "Start Date is required!";
        }
        else if(empty($end_date)){
            $error = "End Date is required!";
        }
        else if(empty($subject)){
            $error = "Subject is required!";
        }
        else{
            // $password = SHA1($t_password);
            // $created_at = date('Y-m-d H:i:s');
            $subject = json_encode($subject);
            $insert = $pdo->prepare("INSERT INTO class(class_name,start_date,end_date,subjects) VALUES(?,?,?,?)"); 
            $insert->execute(array($name,$start_date,$end_date,$subject));
            $success = "Created Class!";
        }
        
    }

?>

<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white mr-2">
      <i class=" mdi mdi-book-plus"></i>                 
    </span>
    Add New Class
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
                <label for="name">Class Name:</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Class Name">
                </div>
            
                <div class="form-group">
                    <label for="start_date">Start Date:</label>
                    <input type="date" name="start_date" class="form-control" id="start_date" >
                </div> 

                <div class="form-group">
                    <label for="end_date">End Date:</label>
                    <input type="date" name="end_date" class="form-control" id="end_date" >
                </div> 
                <div class="form-group">
                    <label>Subjects:</label>&nbsp;<br>
                    <?php
                        $stm = $pdo->prepare("SELECT * FROM subject");
                        $stm->execute();
                        $result=$stm->fetchAll(PDO::FETCH_ASSOC);

                        foreach($result as $row) :?>
                        <label><input type="checkbox" value="<?php echo $row['id'];?>" name="subject[]">  <?php echo $row['name'];?> - <?php echo $row['code'];?></label> <br>
                    <?php endforeach;?>
                </div>
                <button type="submit" name="change_btn" class="btn btn-gradient-primary mr-2">Add Subject</button>
            </form>
        </div>
    </div>
</div>


<?php require_once('footer.php');?>