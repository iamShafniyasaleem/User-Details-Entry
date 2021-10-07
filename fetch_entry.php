<?php
    $con=mysqli_connect("localhost","root","","database");
    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }   

    $result = mysqli_query($con,"SELECT * FROM registry");

   
    while($row = mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td id= 'ccc'>" . $row['id'] . "</td>";
        echo "<td>" . $row['title'] . "</td>";
        echo "<td>" . $row['surname'] . "</td>";
        echo "<td>" . $row['dob'] . "</td>";
        echo "<td>" . $row['age'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    

?>