<?php 
    require_once('header.php');  //config header a call kora ache tai ei khane drkr nei

?>

<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white mr-2">
      <i class="mdi mdi-account-multiple"></i>                 
    </span>
    Assign Subject &nbsp;&nbsp;  <a href="teacher-new-assign.php" class="btn btn-sm btn-primary">New Assign</a>
  </h3>
</div>


<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped" id="Table_Teacher_List">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Teacher Name</th>
                                    <th>Subject Name</th>
                                    <th>Subject Code</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <!-- database a deya teacher er info gulo ei table a show kre -->
                                <?php
                                    $stm = $pdo->prepare("SELECT assign_teachers.id,assign_teachers.teacher_id,assign_teachers.subject_id,teachers.name as teacher_name,subject.name as subject_name,code FROM assign_teachers 
                                    INNER JOIN teachers ON assign_teachers.teacher_id = teachers.id
                                    INNER JOIN subject ON assign_teachers.subject_id = subject.id 
                                    ");
                                    $stm->execute();
                                    $assignList = $stm->fetchAll(PDO::FETCH_ASSOC); 
                                    $i=1;
                                    foreach($assignList as $list) :

                                ?>

                                <tr>
                                    <td><?php echo $i;$i++;?></td>
                                    <td><?php echo $list['teacher_name'];?></td>
                                    <td><?php echo $list['subject_name'];?></td>
                                    <td><?php echo $list['code'];?></td>
                                    <td>
                                    <a href="" class="btn btn-sm btn-warning"><i class="mdi mdi-table-edit "></i></a>&nbsp;
                                    <a href="" class="btn btn-sm btn-danger"><i class="mdi mdi-delete"></i></a>                                    </td>
                                </tr>
                                
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require_once('footer.php');?>


