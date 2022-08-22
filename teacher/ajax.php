<?php
require_once('../config.php');

if(isset($_POST['class_id'])){
    $class_id = $_POST['class_id'];
    $teacher_id = $_POST['teacher_id'];
    echo $_POST['teacher_id'];

    $stm=$pdo->prepare("SELECT subject.name,subject.code,subject_id  FROM class_routine  
    INNER JOIN subject ON class_routine.subject_id 
    WHERE class_routine.class_name=? AND class_routine.teacher_id=?
    ");
    $stm->execute(array($class_id,$teacher_id));
    $subject_list = $stm->fetchAll(PDO::FETCH_ASSOC);

    print_r($subject_list);

    $get_subject_options = '';
    foreach($subject_list as $new_subject){
        $get_subject_options .= '<option value="'.$new_subject['subject_id'].'">'.$new_subject['subject_name'].'-'.$new_subject['subject_code'].'</option>';
         
     }  
    // echo $get_subject_options ;
 
}
