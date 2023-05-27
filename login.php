<?php

$email=$_POST['email'];

$password=$_POST['password'];
$timezone = date_default_timezone_set("Asia/kolkata");




$con = new mysqli('localhost','root','','nftmarketplace');

if($con->connect_error){
    die("Failed to connect : ".$con->connect_error);

} else{
    $stmt = $con ->prepare("select * from authenticate where email=? ");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    if($stmt_result->num_rows > 0){
        
        $data = $stmt_result->fetch_assoc();
        if($data['password'] === $password){
            

            // $reg = "select registration_date from registration where email='$email'";
            // $runn= mysqli_query($con,$reg);
            // $row = mysqli_fetch_assoc($runn);

            // $clogin = "select current_login from registration where email='$email'";
            // $clogg = mysqli_query($con,$clogin);
            // $crows = mysqli_fetch_assoc($clogg);

            $myname = "select name from authenticate where email='$email'";
            $mname = mysqli_query($con,$myname);
            $nrows = mysqli_fetch_assoc($mname);

            // $p1 = "select lastlogin from registration where email='$email'";
            // $p2 = mysqli_query($con,$p1);
            // $p3 = mysqli_fetch_assoc($p2);
 

            echo '<h1>Welcome.....</h1><br>';
            echo '<h3>You are successfully login</h3><br> <h4>Your name and Email ID is:</h4> ';
            echo  "<br>" . $nrows['name'] ;
            echo "<br>" . $email;
           
           
            
            //echo "<br><h4> Registration date and time is: </h4>" .$row['registration_date'];
           // echo"<br><h4>Last login date and time is : </h4>" . $p3['lastlogin'];
            //$plogin = "update registration set lastlogin = '$date_added' where email='$email'";
           // $plogg = mysqli_query($con,$plogin);

           
           

            echo '<br><a href="home.html "><b><h3>Back To Home</h3></b></a>';
                
        }else{
            echo "<h2> Invalid email or password</h2>";
        }
    
    }    else{
        echo "<h2> Invalid email or password</h2>";
    }
}
?>


