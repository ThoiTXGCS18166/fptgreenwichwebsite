<!DOCTYPE HTML>
<html>
<head>
    <title>The Staff Adding Page For Administrator</title>
      
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
          
</head>
<body>
  
    <!-- container -->
    <div class="container">
   
        <div class="page-header">
            <h1>Add Staff</h1>
        </div>
      
        <?php
        if($_POST){
        
            // include database connection
            include 'config/database.php';
        
            try{
            
                // insert query
                $query = "INSERT INTO staffs SET AdminID=:adminid, StaffName=:staffname, StaffUsername=:staffusername, StaffPassword=:staffpassword, StaffGender=:staffgender, StaffDoB=:staffbirthday, StaffPhone=:staffphone, StaffAddress=:staffaddress, StaffMail=:staffmail, StaffStatus=:staffstatus";
        
                // prepare query for execution
                $stmt = $con->prepare($query);
        
                // posted values
                $adminid=1;
                $staffname=htmlspecialchars(strip_tags($_POST['txt-staffname']));
                $staffusername=htmlspecialchars(strip_tags($_POST['txt-staffusername']));
                $staffpassword=htmlspecialchars(strip_tags($_POST['txt-staffpassword']));
                $staffgender=htmlspecialchars(strip_tags($_POST['txt-staffgender']));
                $staffbirthday=htmlspecialchars(strip_tags($_POST['txt-staffbirthday']));
                $staffphone=htmlspecialchars(strip_tags($_POST['txt-staffphone']));
                $staffaddress=htmlspecialchars(strip_tags($_POST['txt-staffaddress']));
                $staffmail=htmlspecialchars(strip_tags($_POST['txt-staffmail']));
                $staffstatus=1;
        
                // bind the parameters
                $stmt->bindParam(':adminid', $adminid);
                $stmt->bindParam(':staffname', $staffname);
                $stmt->bindParam(':staffusername', $staffusername);
                $stmt->bindParam(':staffpassword', $staffpassword);
                $stmt->bindParam(':staffgender', $staffgender);
                $stmt->bindParam(':staffbirthday', $staffbirthday);
                $stmt->bindParam(':staffphone', $staffphone);
                $stmt->bindParam(':staffaddress', $staffaddress);
                $stmt->bindParam(':staffmail', $staffmail);
                $stmt->bindParam(':staffstatus', $staffstatus);
                
                // Execute the query
                if($stmt->execute()){
                    echo "<div class='alert alert-success'>Record was saved.</div>";
                }else{
                    echo "<div class='alert alert-danger'>Unable to save record because new username/email has already existed in the database.</div>";
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
                <td>Staff Name</td>
                <td><input type='text' name='txt-staffname' class='form-control' pattern="[^0-9]*" title="Name must not contain number" required/></td>
            </tr>
            <tr>
                <td>Staff Username</td>
                <td><input type='text' name='txt-staffusername' class='form-control' pattern=".{7,30}" title="Username must contain at least 7 and maximum 30 characters" required/></td>
            </tr>
            <tr>
                <td>Staff Password</td>
                <td><input type='password' name='txt-staffpassword' class='form-control' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 8 to 30 characters" required/></td>
            </tr>
            <tr>
                <td>Staff Gender</td>
                <td><input type='text' name='txt-staffgender' class='form-control' required/></td>
            </tr>
            <tr>
                <td>Staff Birthday</td>
                <td><input type='date' name='txt-staffbirthday' min="1982-06-30" max="1997-06-30" class='form-control' title="Birthday must be in between 1982-06-30 and 1997-06-30" required/></td>
            </tr>
            <tr>
                <td>Staff Phone</td>
                <td><input type='text' name='txt-staffphone' class='form-control' pattern="\d*" title="Phone number must not contain letter" required/></td>
            </tr>
            <tr>
                <td>Staff Address</td>
                <td><input type='text' name='txt-staffaddress' class='form-control' pattern=".{12,50}" title="Address must contain at least 12 and maximum 50 characters" required/></td>
            </tr>
            <tr>
                <td>Staff Mail</td>
                <td><input type='email' name='txt-staffmail' class='form-control' pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Email must be resembled to characters@characters.domain" required/></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type='submit' value='Save' class='btn btn-primary' />
                    <a href='viewstaffs.php' class='btn btn-danger'>Back to view staffs</a>
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