<?php

    
     $name = $_POST['name'];
     $email = $_POST['email'];
     $password = $_POST['password'];
    
     
    
    //  $timezone = date_default_timezone_set("Asia/kolkata");

     $con = new mysqli('localhost','root','','nftmarketplace');
     if($con -> connect_error){
        die('Connection failed : '.$con->connect_error);
     }else{
        $stmt = $con->prepare("insert into authenticate(name,email,password) values( ? , ? , ? )");
        $stmt->bind_param("sss", $name , $email, $password );
        $stmt->execute();
        // $reg_added = date("Y-m-d H:i:s");
            
        //$update = "update registration set registration_date = '$reg_added'"; 
        $run = mysqli_query($con,$update);
        echo header("Location: home.html");
        echo 'welcome';
        
        $stmt->close();
        $con->close();;
     }


?>

