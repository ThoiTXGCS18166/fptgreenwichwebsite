<?php
  $host="us-cdbr-iron-east-05.cleardb.net";
  $user="be790e4eb7458b";
  $password="78c739da";
  $db="heroku_0a876b33f00670d";
  
  $conn = mysqli_connect($host,$user,$password,$db);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  
  session_start();

  date_default_timezone_set("Asia/Ho_Chi_Minh");
  $currentdate = date("Y-m-d");


mysqli_close($conn);
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>The Printing Record Adding Page For Staff</title>
      
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
          
</head>
<body>
  
    <!-- container -->
    <div class="container">
   
        <div class="page-header">
            <h1>Add Printing Record</h1>
        </div>
      
        <?php
        if($_POST){
        
            // include database connection
            include 'config/database.php';
        
            try{
            
                // insert query
                $query = "INSERT INTO printings SET BookID=:bookid, StaffID=:staffid, PrinterName=:printername, PrinterType=:printertype, PrintingDate=:printingdate, PrintingFee=:printingfee, PrintingStatus=:printingstatus, QRCode=:qrcode, SubmitDate=:submitdate, PrintPriority=:printpriority, BookingStatus=:bookingstatus, PaymentStatus=:paymentstatus, PrinterMail=:printermail";
        
                // prepare query for execution
                $stmt = $con->prepare($query);
        
                // posted values
                $bookid=htmlspecialchars(strip_tags($_POST['txt-bookid']));
                $staffid=1;
                $printername=htmlspecialchars(strip_tags($_POST['txt-printername']));
                $printertype=htmlspecialchars(strip_tags($_POST['txt-printertype']));
                $printingdate=htmlspecialchars(strip_tags($_POST['txt-printingdate']));
                $printingstatus=htmlspecialchars(strip_tags($_POST['txt-printingstatus']));
                $paymentstatus=htmlspecialchars(strip_tags($_POST['txt-paymentstatus']));
                date_default_timezone_set("Asia/Ho_Chi_Minh");
                $submitdate=date('Y-m-d H:i:s');
                $printpriority=htmlspecialchars(strip_tags($_POST['txt-printpriority']));
                $bookingstatus=htmlspecialchars(strip_tags($_POST['txt-bookingstatus']));

                $printermail=htmlspecialchars(strip_tags($_POST['txt-printermail']));
                
                if($printertype == "Student" || $printertype == "student") {
                    $qrcode = "sprintqrcode3.png";
                    $printingfee = "20 USD";
                }

                if($printertype == "Teacher" || $printertype == "teacher") {
                    $qrcode = "tprintqrcode3.png";
                    $printingfee = "20 USD";
                }

                if($printertype == "Outsider" || $printertype == "outsider") {
                    $qrcode = "oprintqrcode3.png";
                    $printingfee = "25 USD";
                }
        
                // bind the parameters
                $stmt->bindParam(':bookid', $bookid);
                $stmt->bindParam(':staffid', $staffid);
                $stmt->bindParam(':printername', $printername);
                $stmt->bindParam(':printertype', $printertype);
                $stmt->bindParam(':printingdate', $printingdate);
                $stmt->bindParam(':printingfee', $printingfee);
                $stmt->bindParam(':printingstatus', $printingstatus);
                $stmt->bindParam(':qrcode', $qrcode);
                $stmt->bindParam(':submitdate', $submitdate);
                $stmt->bindParam(':printpriority', $printpriority);
                $stmt->bindParam(':bookingstatus', $bookingstatus);
                $stmt->bindParam(':paymentstatus', $paymentstatus);
                $stmt->bindParam(':printermail', $printermail);
                
                // Execute the query
                if($stmt->execute()){
                    echo "<div class='alert alert-success'>Record was saved.</div>";
                }else{
                    echo "<div class='alert alert-danger'>Unable to save record.</div>";
                }
                
            }
            
            // show error
            catch(PDOException $exception){
                die('ERROR: ' . $exception->getMessage());
            }
        }
        ?>
 
    <!-- html form here where the product information will be entered -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Book ID</td>
                <td><input type='number' name='txt-bookid' min="1" max="20" class='form-control' required/></td>
            </tr>
            <tr>
                <td>Printer Name</td>
                <td><input type='text' name='txt-printername' class='form-control' required/></td>
            </tr>
            <tr>
                <td>Printer Type</td>
                <td><input type='text' name='txt-printertype' class='form-control' pattern="[^0-9]*" title="Printer type must not contain number" required/></td>
            </tr>
            <tr>
                <td>Printing Date</td>
                <td><input type='date' name='txt-printingdate' min="<?php echo $currentdate;?>" class='form-control' required/></td>
            </tr>
            <tr>
                <td>Printing Status</td>
                <td><input type='number' name='txt-printingstatus' min="0" max="1" class='form-control' required/></td>
            </tr>
            <tr>
                <td>Print Priority</td>
                <td><input type='number' name='txt-printpriority' min="0" class='form-control' required/></td>
            </tr>
            <tr>
                <td>Booking Status</td>
                <td><input type='number' name='txt-bookingstatus' min="0" max="1" class='form-control' required/></td>
            </tr>
            <tr>
                <td>Payment Status</td>
                <td><input type='number' name='txt-paymentstatus' min="0" max="1" class='form-control' required/></td>
            </tr>
            <tr>
                <td>Printer Mail</td>
                <td><input type='text' name='txt-printermail' class='form-control' pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Email must be resembled to characters@characters.domain" required/></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type='submit' value='Save' class='btn btn-primary' />
                    <a href='viewprintingrecords.php' class='btn btn-danger'>Back to view printing records</a>
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