<?php
    $con=mysqli_connect("localhost","root","","database");
    // Check connection
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $result = mysqli_query($con,"SELECT * FROM registry");

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- Bootstrap CSS -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>Registration Page</title>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Anonymous+Pro&display=swap");
body {
    font-family: "Anonymous Pro", monospace;
    font-size: 20px;
    
    background-repeat: no-repeat;
    background-size: cover;
    
}
.form-group{
    max-width: 500px;
    border: 15px solid black;
    border-radius: 15px;
    padding: 20px;
    background-color: black;
    box-shadow: 5px 10px orangered;

}
.btn{
   
    background-color: orangered;
    color: black;
    border-radius: 20px;
    width: 80px;
    margin-right: 17px;
    
}
.btn:hover{
    background-color: black;
    color:orangered;
    border-color: orangered;
}
.form-label{
    color:palegoldenrod;
}
label{
    color:palegoldenrod;
}

.form-check-input input:checked ~ .checkmark {
    background-color: orangered;
  }

  @media (max-width: 600px) {
      body{
          font-size: 12px;
      }
    .form-group{
        max-width:200px;
        border: 15px solid black;
        border-radius: 15px;
        padding: 20px;
        background-color: black;
        box-shadow: 5px 10px orangered;
    
    }
    .btn{
        margin-left: 20px;
        padding: 5px;
        margin-bottom: 5px;
        
    }

    table{
        width:500px;
    }
  }


</style>

</head>
<body style="background-image: url('images/back.jpg');">
    <form id="data_form">
        <div class="form-group container mt-5">
            <div class="mb-3">
                <label for="title" class="form-label">Title :</label>
                <select class="form-select" id="title" required="required">
                    <option value="Mr">Mr</option>
                    <option value="Miss">Miss</option>
                    <option value="Mrs">Mrs</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="name">Surname :</label>
                <input type="text" class="form-control" required="required" id="surname" placeholder="Surname">
            </div>
            <div class="mb-3">           
                <label class="form-label" for="start">Date of Birth :</label>
                <input type="date" class="form-control" id="dob" required="required">
            </div>
            <div class="mb-3">
                <label class="form-label" for="status">Status :</label>

                <input type="radio" class="form-check-input" required="required" id="status" name="status" value="married"> <label >Married</label>
                <input type="radio" class="form-check-input" required="required" id="status" name="status" value="unmarried"> <label >Unmarried</label>
            </div>
            <div class="mb-3">                
                <button type="button" class="btn" id="clear"> Clear</button>
                <button type="button" class="btn">Delete</button>
                <button type="button" class="btn">Update</button>
                <button type="submit" id="register" class="btn ">Add</button>
            </div> 
        </div>
    </form>


    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Surname</th>
                            <th>Date_of_Birth</th>
                            <th>Age</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="innerTable">
                       
                    </tbody>
                </table>
                <?php                 
                mysqli_close($con);
                ?>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () { 
            
            function fetchData() {
                $.ajax({
                    url: "fetch_entry.php",
                    method:"GET",
                    success:function(data){
                        $('#innerTable').html(data);
                    }
                })
            }

            fetchData();

            $('#ccc').click(() => {
                alert('fdfdf')
            })

            $('#clear').click(() => {
                clear();
            })

            function clear(){
                $('#title option:first').prop('selected',true);
                $('#surname').val('');
                $('#dob').val('');
                $("input[type='radio']:checked").prop('checked', false);
            }
 

            $('#data_form').submit(function(e){
                e.preventDefault();
            
                var title = $('#title').val();
                var surname = $('#surname').val();
                var dob = $('#dob').val();
                var status = $("input[type='radio']:checked").val();              

                $.ajax({
                    url: "add_entry.php",
                    method:"POST",
                    data: {
                        title:title,
                        surname:surname,
                        dob:dob,
                        status:status,
                    },
                    success:function(data){
                        if (data == "1"){
                            clear();
                            
                        }else if(data == "-1"){
                            alert(data);
                        }else{
                            alert('Something went wrong');
                        }  
                        fetchData();                     
                        
                    }
                })
            });
        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

</body>
</html>