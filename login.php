<?php
  $host="localhost";
  $user="root";
  $password="";
  $db="library";
  
  $connection = mysqli_connect($host,$user,$password,$db);
  session_start();
  
  if(isset($_POST['btn-login'])){
    
    $loginusername=$_POST['txt-loginusername'];
    $loginpassword=$_POST['txt-loginpassword'];
    
    $sql="SELECT * FROM administrators WHERE AdminUsername='".$loginusername."'AND AdminPassword='".$loginpassword."'AND AdminStatus = 1 limit 1";
    
    $result=mysqli_query($connection ,$sql);
    
    if(mysqli_num_rows($result) > 0){
        $_SESSION['login_adminusername'] = $loginusername;
        
        header("location: home1.php");
    }
    else {
        $sql="SELECT * FROM staffs WHERE StaffUsername='".$loginusername."'AND StaffPassword='".$loginpassword."'AND StaffStatus = 1 limit 1";
    
        $result=mysqli_query($connection ,$sql);
        
        if(mysqli_num_rows($result) > 0){
            $_SESSION['login_staffusername'] = $loginusername;
            
            header("location: home2.php");
        } else {
            $sql="SELECT * FROM students WHERE StudentUsername='".$loginusername."'AND StudentPassword='".$loginpassword."'AND StudentStatus = 1 limit 1";
    
            $result=mysqli_query($connection ,$sql);
            
            if(mysqli_num_rows($result) > 0){
            $_SESSION['login_studentusername'] = $loginusername;
            $_SESSION['borrowed_bookname'] = "";
            $_SESSION['borrowed_laptopname'] = "";
            $_SESSION['printed_bookname'] = "";

            $_SESSION['login_usertype'] = "Student";

            while ($row = mysqli_fetch_assoc($result)){
                $_SESSION['login_mail'] = $row["StudentMail"];
            }
            
            header("location: home3.php");
            } else {
                $sql="SELECT * FROM teachers WHERE TeacherUsername='".$loginusername."'AND TeacherPassword='".$loginpassword."'AND TeacherStatus = 1 limit 1";
    
                $result=mysqli_query($connection ,$sql);
                
                if(mysqli_num_rows($result) > 0){
                $_SESSION['login_teacherusername'] = $loginusername;
                $_SESSION['borrowed_bookname'] = "";
                $_SESSION['borrowed_laptopname'] = "";
                $_SESSION['printed_bookname'] = "";

                $_SESSION['login_usertype'] = "Teacher";

                while ($row = mysqli_fetch_assoc($result)){
                    $_SESSION['login_mail'] = $row["TeacherMail"];
                }
                
                header("location: home4.php");
                } else {
                    $sql="SELECT * FROM outsiders WHERE OutsiderUsername='".$loginusername."'AND OutsiderPassword='".$loginpassword."'AND OutsiderStatus = 1 limit 1";
    
                    $result=mysqli_query($connection ,$sql);
                    
                    if(mysqli_num_rows($result) > 0){
                    $_SESSION['login_outsiderusername'] = $loginusername;
                    $_SESSION['borrowed_bookname'] = "";
                    $_SESSION['borrowed_laptopname'] = "";
                    $_SESSION['printed_bookname'] = "";

                    $_SESSION['login_usertype'] = "Outsider";

                    while ($row = mysqli_fetch_assoc($result)){
                        $_SESSION['login_mail'] = $row["OutsiderMail"];
                    }
                    
                    header("location: home5.php");
                    } else {
                        $sql="SELECT * FROM schoolusers WHERE SchoolUsername='".$loginusername."'AND UserPassword='".$loginpassword."'AND UserStatus = 1 limit 1";

                        $result=mysqli_query($connection ,$sql);
                    
                        if(mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)){
                                $usertype = $row["UserType"];

                                if($usertype == 'Student') {
                                    $_SESSION['login_studentusername'] = $loginusername;
                                    $_SESSION['login_studentpassword'] = $loginpassword;
                                    $_SESSION['borrowed_bookname'] = "";
                                    $_SESSION['borrowed_laptopname'] = "";
                                    $_SESSION['printed_bookname'] = "";
                                    $_SESSION['login_studentname'] = $row["Username"];
                                    $_SESSION['login_studentbirthday'] = $row["UserDoB"];
                                    $_SESSION['login_studentphone'] = $row["UserPhone"];
                                    $_SESSION['login_studentaddress'] = $row["UserAddress"];
                                    $_SESSION['login_studentmail'] = $row["UserMail"];
                                    $_SESSION['login_studentgender'] = $row["UserGender"];

                                    $_SESSION['login_mail'] = $row["UserMail"];

                                    $_SESSION['login_usertype'] = "Student";

                                    $username = $row["Username"];
                                    $userbirthday = $row["UserDoB"];
                                    $userphone = $row["UserPhone"];
                                    $useraddress = $row["UserAddress"];
                                    $usermail = $row["UserMail"];
                                    $usergender = $row["UserGender"];

                                    $sql="INSERT INTO students (StaffID, StudentName, StudentUsername, StudentPassword, StudentGender, StudentDoB, StudentPhone, StudentAddress, StudentMail, StudentStatus)
                                    VALUES ('1','$username', '$loginusername', '$loginpassword', '$usergender', '$userbirthday', '$userphone', '$useraddress', '$usermail', '1')"; 

                                    if ($connection->query($sql) === TRUE) {
                                        header("location: home3.php");
                                    } else {
                                        echo '<script>alert("Invalid login username/password or user account was made unavailable for login")</script>';
                                    }
                                } else {
                                    $_SESSION['login_teacherusername'] = $loginusername;
                                    $_SESSION['login_teacherpassword'] = $loginpassword;
                                    $_SESSION['borrowed_bookname'] = "";
                                    $_SESSION['borrowed_laptopname'] = "";
                                    $_SESSION['printed_bookname'] = "";
                                    $_SESSION['login_teachername'] = $row["Username"];
                                    $_SESSION['login_teacherbirthday'] = $row["UserDoB"];
                                    $_SESSION['login_teacherphone'] = $row["UserPhone"];
                                    $_SESSION['login_teacheraddress'] = $row["UserAddress"];
                                    $_SESSION['login_teachermail'] = $row["UserMail"];
                                    $_SESSION['login_teachergender'] = $row["UserGender"];

                                    $_SESSION['login_mail'] = $row["UserMail"];

                                    $_SESSION['login_usertype'] = "Teacher";
                                    
                                    $username = $row["Username"];
                                    $userbirthday = $row["UserDoB"];
                                    $userphone = $row["UserPhone"];
                                    $useraddress = $row["UserAddress"];
                                    $usermail = $row["UserMail"];
                                    $usergender = $row["UserGender"];

                                    $sql="INSERT INTO teachers (StaffID, TeacherName, TeacherUsername, TeacherPassword, TeacherGender, TeacherDoB, TeacherPhone, TeacherAddress, TeacherMail, TeacherStatus)
                                    VALUES ('1','$username', '$loginusername', '$loginpassword', '$usergender', '$userbirthday', '$userphone', '$useraddress', '$usermail', '1')"; 
                                    
                                    if ($connection->query($sql) === TRUE) {
                                        header("location: home4.php");
                                    } else {
                                        echo '<script>alert("Invalid login username/password or user account was made unavailable for login")</script>';
                                    }
                                }
                            }
                        } else {
                            echo '<script>alert("Invalid login username/password or user account was made unavailable for login")</script>';
                        }
                    }
                }
            }
        }
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
    <title>The Login Page For User</title>

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
  <form action="login.php" method="POST" class="container">
    
    <h1>The Login Form For User</h1>

    <label for="txt-loginusername"><b>Login Username</b></label>
    <input type="text" placeholder="Enter Login Username" name="txt-loginusername" id="txt-loginusername" data-clear-btn="true" data-mini="true" pattern=".{6,30}" title="Username must contain at least 6 and maximum 30 characters" required>

    <label for="txt-adminpassword"><b>Login Password</b></label>
    <input type="password" placeholder="Enter Login Password" name="txt-loginpassword" id="txt-loginpassword" data-clear-btn="true" data-mini="true" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 8 to 30 characters" required>

    <button type="submit" class="btn" name="btn-login">Login For User</button>

    <h2>Does not have an account ?</h2>
    <a href="signup.php">Sign Up For Outsider</a>

  </form>

  
</div>

</body>
</html>