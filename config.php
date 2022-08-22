<?php 
    $host = "localhost";
    $db_name = "psms";
    $user = "root";
    $password = "";

    date_default_timezone_set("Asia/Dhaka");
try{
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
}
catch(PDOException $m){
    echo "Connection failed: " . $m->getMessage();
}

// // Count any Column Value from Students Table
// function stRowCount($col,$val){
//     global $pdo;
//     $stm=$pdo->prepare("SELECT $col FROM students WHERE $col=?");
//     $stm->execute(array($val));
//     $count = $stm->rowCount();
//     return $count;
// }

//Count any Column Value from teachers Table
// function teacherCount($col,$val){
//     global $pdo;
//     $stm=$pdo->prepare("SELECT $col FROM teachers WHERE $col=?");
//     $stm->execute(array($val));
//     $count = $stm->rowCount();
//     return $count;
// }

//Count any Column Value from subject Table
// function subjectCount($col,$val){
//     global $pdo;
//     $stm=$pdo->prepare("SELECT $col FROM subject WHERE $col=?");
//     $stm->execute(array($val));
//     $count = $stm->rowCount();
//     return $count;
// }
// ei vabe table er data count krle bar bar alada count function create krte hbe nah
function getCount($tbl,$col,$val){
    global $pdo;
    $stm=$pdo->prepare("SELECT $col FROM $tbl WHERE $col=?");
    $stm->execute(array($val));
    $count = $stm->rowCount();
    return $count;
}


// function for routine-add-new.php
function getSubjectName($id){
    global $pdo;
    $stm=$pdo->prepare("SELECT name,code FROM subject WHERE id=?");
    $stm->execute(array($id));
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $result[0]['name']."-".$result[0]['code'];
}

// need for routine-add-new.php & assign_teachers table,, to gat teacher id from subject_id
function getSubjectTeacher($id){
    global $pdo;
    $stm=$pdo->prepare("SELECT teacher_id FROM assign_teachers WHERE subject_id=?");
    $stm->execute(array($id));
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $result[0]['teacher_id'];

}

// 
function getClassName($id,$col){
    global $pdo;
    $stm=$pdo->prepare("SELECT $col FROM class WHERE id=?");
    $stm->execute(array($id));
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $result[0][$col];
}


// //  GET Student Data
function Student($col,$id){
    global $pdo;
    $stm=$pdo->prepare("SELECT $col FROM students WHERE id=?");
    $stm->execute(array($id));
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $result[0][$col];
}


