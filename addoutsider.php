<!DOCTYPE HTML>
<html>
<head>
    <title>The Outsider Adding Page For Staff</title>
      
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
          
</head>
<body>
  
    <!-- container -->
    <div class="container">
   
        <div class="page-header">
            <h1>Add Outsider</h1>
        </div>
      
        <?php
        if($_POST){
        
            // include database connection
            include 'config/database.php';
        
            try{
            
                // insert query
                $query = "INSERT INTO outsiders SET StaffID=:staffid, OutsiderName=:outsidername, OutsiderUsername=:outsiderusername, OutsiderPassword=:outsiderpassword, OutsiderGender=:outsidergender, OutsiderDoB=:outsiderbirthday, OutsiderPhone=:outsiderphone, OutsiderAddress=:outsideraddress, OutsiderMail=:outsidermail, OutsiderStatus=:outsiderstatus, PaymentStatus=:paymentstatus";
        
                // prepare query for execution
                $stmt = $con->prepare($query);
        
                // posted values
                $staffid=1;
                $outsidername=htmlspecialchars(strip_tags($_POST['txt-outsidername']));
                $outsiderusername=htmlspecialchars(strip_tags($_POST['txt-outsiderusername']));
                $outsiderpassword=htmlspecialchars(strip_tags($_POST['txt-outsiderpassword']));
                $outsidergender=htmlspecialchars(strip_tags($_POST['txt-outsidergender']));
                $outsiderbirthday=htmlspecialchars(strip_tags($_POST['txt-outsiderbirthday']));
                $outsiderphone=htmlspecialchars(strip_tags($_POST['txt-outsiderphone']));
                $outsideraddress=htmlspecialchars(strip_tags($_POST['txt-outsideraddress']));
                $outsidermail=htmlspecialchars(strip_tags($_POST['txt-outsidermail']));
                $outsiderstatus=1;
                $paymentstatus=0;
        
                // bind the parameters
                $stmt->bindParam(':staffid', $staffid);
                $stmt->bindParam(':outsidername', $outsidername);
                $stmt->bindParam(':outsiderusername', $outsiderusername);
                $stmt->bindParam(':outsiderpassword', $outsiderpassword);
                $stmt->bindParam(':outsidergender', $outsidergender);
                $stmt->bindParam(':outsiderbirthday', $outsiderbirthday);
                $stmt->bindParam(':outsiderphone', $outsiderphone);
                $stmt->bindParam(':outsideraddress', $outsideraddress);
                $stmt->bindParam(':outsidermail', $outsidermail);
                $stmt->bindParam(':outsiderstatus', $outsiderstatus);
                $stmt->bindParam(':paymentstatus', $paymentstatus);
                
                // Execute the query
                if($stmt->execute()){
                    echo "<div class='alert alert-success'>Record was saved.</div>";
                }else{
                    echo "<div class='alert alert-danger'>Unable to save record because username has already existed in the database.</div>";
                }
                
            }
            
            // show error
            catch(PDOException $exception){
                die('ERROR: ' . $exception->getMessage());
            }
        }
        ?>
 
    <!-- html form here where the product information will be entered -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Outsider Name</td>
                <td><input type='text' name='txt-outsidername' class='form-control' pattern="[^0-9]*" title="Name must not contain number" required/></td>
            </tr>
            <tr>
                <td>Outsider Username</td>
                <td><input type='text' name='txt-outsiderusername' class='form-control' pattern=".{1,30}" title="Username must contain at least 1 and maximum 30 characters" required/></td>
            </tr>
            <tr>
                <td>Outsider Password</td>
                <td><input type='password' name='txt-outsiderpassword' class='form-control' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 8 to 30 characters" required/></td>
            </tr>
            <tr>
                <td>Outsider Gender</td>
                <td><input type='text' name='txt-outsidergender' class='form-control' required/></td>
            </tr>
            <tr>
                <td>Outsider Birthday</td>
                <td><input type='date' name='txt-outsiderbirthday' min="1962-06-30" max="2003-06-30" class='form-control' title="Birthday must be in between 1962-06-30 and 2003-06-30" required/></td>
            </tr>
            <tr>
                <td>Outsider Phone</td>
                <td><input type='text' name='txt-outsiderphone' class='form-control' pattern="\d*" title="Phone number must not contain letter" required/></td>
            </tr>
            <tr>
                <td>Outsider Address</td>
                <td><input type='text' name='txt-outsideraddress' class='form-control' pattern=".{12,50}" title="Address must contain at least 12 and maximum 50 characters" required/></td>
            </tr>
            <tr>
                <td>Outsider Mail</td>
                <td><input type='email' name='txt-outsidermail' class='form-control' pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Email must be resembled to characters@characters.domain" required/></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type='submit' value='Save' class='btn btn-primary' />
                    <a href='viewoutsiders.php' class='btn btn-danger'>Back to view outsiders</a>
                </td>
            </tr>
        </table>
    </form>
          
    </div> <!-- end .container -->
      
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
</body>
</html>