<?php 
    $conn = mysqli_connect("localhost","root", "", "database");

    $title = $_POST['title'];
    $surname = $_POST['surname'];
    $dob = $_POST['dob'];
    $status = $_POST['status'];
    $age = (int) floor((time() - strtotime('1998-01-21')) / (60*60*24*365));

    $query = "INSERT INTO registry(title, surname, dob, age, status) VALUES('$title','$surname', '$dob', '$age', '$status')";

    $res = mysqli_query($conn, $query);

    if($res){
      echo "1";
    }else{
      echo "-1";
    }    
  
    

?>