<?php 
    require_once('header.php');  //config header a call kora ache tai ei khane drkr nei

?>

<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white mr-2">
      <i class="mdi mdi-book-open-page-variant "></i>                 
    </span>
    All Class
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
                                <th>Class Name</th> 
                                <th>Start Date</th> 
                                <th>End Date</th>  
                                <th>Subjects</th>  
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <!-- datatable a deya teacher er info gulo ei table a show kre -->
                                <?php
                                    $stm = $pdo->prepare("SELECT * FROM class ORDER BY id DESC");
                                    $stm->execute();
                                    $subList = $stm->fetchAll(PDO::FETCH_ASSOC);
                                    $i=1;
                                    foreach($subList as $sub):

                                ?>

                                <tr>
                                    <td><?php echo $i; $i++;?></td>
                                    <td><?php echo $sub['class_name']?></td>
                                    <td><?php echo date('d-m-Y',strtotime($sub['start_date']));?></td>
                                    <td><?php echo date('d-m-Y',strtotime($sub['end_date']));?></td>
                                    <td><?php
                                    // subject name r code show krbe
                                       $subject_list = json_decode($sub['subjects']);
                                       //print_r($subject_list);
                                       foreach($subject_list as $new_subject){
                                        echo getSubjectName($new_subject)."<br>";
                                    } 
                                    
                                       ?></td>

                                    <td>
                                        <a href="" class="btn btn-sm btn-warning"><i class="mdi mdi-table-edit "></i></a>&nbsp;
                                        <a href="" class="btn btn-sm btn-danger"><i class="mdi mdi-delete"></i></a>
                                    </td>
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


