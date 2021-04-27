<?php
    $host="localhost";
    $user="root";
    $password="";
    $db="library";
    
    $conn = mysqli_connect($host,$user,$password,$db);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    session_start();
    
    if(isset($_POST['btn-signup'])) {
        $staffid=1;
        $outsiderusername=$_POST['txt-outsiderusername'];
        $outsidername=$_POST['txt-outsidername'];
        $outsiderpassword=$_POST['txt-outsiderpassword'];
        $repeatpassword=$_POST['txt-repeatpassword'];
        $outsidergender=$_POST['txt-outsidergender'];
        $outsiderbirthday=$_POST['txt-outsiderbirthday'];
        $outsiderphone=$_POST['txt-outsiderphone'];
        $outsideraddress=$_POST['txt-outsideraddress'];
        $outsidermail=$_POST['txt-outsidermail'];
        $outsiderstatus=1;
        $paymentstatus=0;

        if($outsiderpassword == $repeatpassword) {
            $sql="SELECT * FROM outsiders WHERE OutsiderUsername='".$outsiderusername."' OR OutsiderMail='".$outsidermail."' limit 1";
    
            $result=mysqli_query($conn,$sql);
            
            if(mysqli_num_rows($result)==1) {
                echo '<script>alert("Error: The entered outsider username/email is already existed in the library database. Please check and retype the outsider username again.")</script>';
            } else {
                $_SESSION['login_outsiderusername'] = $outsiderusername;
                $_SESSION['login_outsiderpassword'] = $outsiderpassword;
                $_SESSION['borrowed_bookname'] = "";
                $_SESSION['borrowed_laptopname'] = "";
                $_SESSION['printed_bookname'] = "";

                $_SESSION['login_mail'] = $outsidermail;

                $_SESSION['login_usertype'] = "Outsider";

                $_SESSION['login_outsidername'] = $outsidername;
                $_SESSION['login_outsiderbirthday'] = $outsiderbirthday;
                $_SESSION['login_outsiderphone'] = $outsiderphone;
                $_SESSION['login_outsideraddress'] = $outsideraddress;
                $_SESSION['login_outsidermail'] = $outsidermail;
                $_SESSION['login_outsidergender'] = $outsidergender;

                $sql="INSERT INTO outsiders (StaffID, OutsiderName, OutsiderUsername, OutsiderPassword, OutsiderGender, OutsiderDoB, OutsiderPhone, OutsiderAddress, OutsiderMail, OutsiderStatus, PaymentStatus)
                VALUES ('$staffid', '$outsidername', '$outsiderusername', '$outsiderpassword', '$outsidergender', '$outsiderbirthday', '$outsiderphone', '$outsideraddress', '$outsidermail', '$outsiderstatus', '$paymentstatus')";   
                    
                if ($conn->query($sql) === TRUE) {
                echo '<script>alert("Signing up for outsider successfully. Please come to the library to confirm and make payment for executing the function of the website");window.location.href="home5.php"</script>';
                } else {
                echo '<script>alert("The input information is incorrect. Please modify the information into the form again for signing up for outsider")</script>';
                }
            }
        } else {
            echo '<script>alert("The entered passwords are not matched. Please modify the passwords into the form again for signing up for outsider")</script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="css/style.css"/>
    <script src="js/index.js"></script>
    <title>The Sign Up Page For Outsider</title>

    <style>
      body {
        background-image: url('img/background-image.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed; 
        background-size: 100% 100%;
      }

      a {font-size: 20px}
    </style>
    
</head>
<body>
    
<div class="">
  <form action="signup.php" method="POST" class="container">
    
    <h1>The Sign Up Form For Outsider</h1>

    <label for="txt-outsidername"><b>Sign Up Name</b></label>
    <input type="text" placeholder="Enter Outsider Name" name="txt-outsidername" id="txt-outsidername" data-clear-btn="true" data-mini="true" pattern=".{1,30}" title="Name must contain at least 1 and maximum 30 characters" required>

    <label for="txt-outsiderusername"><b>Sign Up Username</b></label>
    <input type="text" placeholder="Enter Outsider Username" name="txt-outsiderusername" id="txt-outsiderusername" data-clear-btn="true" data-mini="true" pattern=".{1,30}" title="Username must contain at least 1 and maximum 30 characters" required>

    <label for="txt-outsiderpassword"><b>Sign Up Password</b></label>
    <input type="password" placeholder="Enter Outsider Password" name="txt-outsiderpassword" id="txt-outsiderpassword" data-clear-btn="true" data-mini="true" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 8 to 30 characters" required>

    <label for="txt-repeatpassword"><b>Repeat Password</b></label>
    <input type="password" placeholder="Enter Outsider Password Again" name="txt-repeatpassword" id="txt-repeatpassword" data-clear-btn="true" data-mini="true" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 8 to 30 characters" required>

    <label for="txt-outsidergender"><b>Sign Up Gender</b></label>
    <input type="text" placeholder="Enter Outsider Gender" name="txt-outsidergender" id="txt-outsidergender" data-clear-btn="true" data-mini="true" pattern=".{3,30}" title="Gender must contain at least 3 and maximum 30 characters" required>
    
    <label for="txt-outsiderbirthday"><b>Sign Up Birthday</b></label>
    <input type="date" id="txt-outsiderbirthday" name="txt-outsiderbirthday" min="1962-06-30" max="2003-06-30" data-clear-btn="true" data-mini="true" title="Birthday must be in between 1962-06-30 and 2003-06-30" required>
    
    <label for="txt-outsiderphone"><b>Sign Up Phone</b></label>
    <input type="text" id="txt-outsiderphone" name="txt-outsiderphone" placeholder="Enter Outsider Phone Number" data-clear-btn="true" data-mini="true" pattern="\d*" title="Phone number must not contain letter" required>

    <label for="txt-outsideraddress"><b>Sign Up Address</b></label>
    <input type="text" id="txt-outsideraddress" name="txt-outsideraddress" placeholder="Enter Outsider Address" data-clear-btn="true" data-mini="true" pattern=".{12,50}" title="Address must contain at least 12 and maximum 50 characters" required>

    <label for="txt-outsidermail"><b>Sign Up Mail</b></label>
    <input type="email" id="txt-outsidermail" name="txt-outsidermail" placeholder="Enter Outsider Mail Address" data-clear-btn="true" data-mini="true" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Email must be resembled to characters@characters.domain" required>
    
    <button type="submit" class="btn" name="btn-signup">Sign Up For Outsider</button>

    <h2>Already have an account ?</h2>
    <a href="index.php">Login For User</a>

  </form>

  
</div>

</body>
</html>