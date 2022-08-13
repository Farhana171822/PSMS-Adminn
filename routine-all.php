<?php 
    require_once('header.php');  //config header a call kora ache tai ei khane drkr nei

?>

<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white mr-2">
      <i class="mdi mdi-account-multiple"></i>                 
    </span>
    All Class Routine
  </h3>
</div>


<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width:20px;">#</th> 
                                    <th>Class Name</th>  
                                    <th>Action</th> 
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                    $stm = $pdo->prepare("SELECT DISTINCT class_name FROM class_routine ORDER BY class_name ASC");
                                    $stm->execute();
                                    $classList = $stm->fetchAll(PDO::FETCH_ASSOC);
                                    $i=1;
                                    foreach($classList as $list):
                                ?>

                                <tr>
                                    <td><?php echo $i;$i++;?></td>
                                    <td><?php echo getClassName($list['class_name'],'class_name');?></td>

                                    <td>
                                    <a href="" class="btn btn-sm btn-warning"><i class="mdi mdi-table-edit "></i></a>&nbsp;
                                    <a href="" class="btn btn-sm btn-danger"><i class="mdi mdi-delete"></i></a>
                                    <a href="routine-details.php?id=<?php echo $list['class_name'];?>" class="btn btn-sm btn-success"><i class="mdi mdi-eye"></i></a>                                    </td>
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


