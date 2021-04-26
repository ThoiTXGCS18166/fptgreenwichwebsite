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

  date_default_timezone_set("Asia/Ho_Chi_Minh");
  $currentdate=date('Y-m-d');
  $currenttime=date('H:i');


mysqli_close($conn);
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>The Room Borrowing Record Adding Page For Staff</title>
      
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
          
</head>
<body>
  
    <!-- container -->
    <div class="container">
   
        <div class="page-header">
            <h1>Add Room Borrowing Record</h1>
        </div>
      
        <?php
        if($_POST){
        
            // include database connection
            include 'config/database.php';
        
            try{
                
                $startdate=htmlspecialchars(strip_tags($_POST['txt-startdate']));
                $enddate = date('Y-m-d H:i:s', strtotime($startdate)+10800);

                $start_date = new DateTime($startdate);
                $end_date = new DateTime($enddate);
                $borrowdate = $start_date->format('Y-m-d 23:59:59');
                $borrow_date = new DateTime($borrowdate);
                
                if($end_date > $borrow_date) {
                echo '<script>alert("The current room can not be booked at the chosen time. Please return and choose a different time to borrow the study room")</script>';
                } else {
                    // insert query
                    $query = "INSERT INTO roomrecords SET RoomID=:roomid, StaffID=:staffid, BorrowerName=:borrowername, BorrowerType=:borrowertype, StartDate=:startdate, BorrowHour=:borrowhour, EndDate=:enddate, RecordFee=:recordfee, BorrowingStatus=:borrowingstatus, ReturnStatus=:returnstatus, SubmitDate=:submitdate, BorrowPriority=:borrowpriority, BookingStatus=:bookingstatus, BorrowerMail=:borrowermail";
            
                    // prepare query for execution
                    $stmt = $con->prepare($query);
            
                    // posted values
                    $roomid=htmlspecialchars(strip_tags($_POST['txt-roomid']));
                    $staffid=1;
                    $borrowername=htmlspecialchars(strip_tags($_POST['txt-borrowername']));
                    $borrowertype=htmlspecialchars(strip_tags($_POST['txt-borrowertype']));
                    $startdate=htmlspecialchars(strip_tags($_POST['txt-startdate']));
                    $borrowingstatus=htmlspecialchars(strip_tags($_POST['txt-borrowingstatus']));
                    date_default_timezone_set("Asia/Ho_Chi_Minh");
                    $submitdate=date('Y-m-d H:i:s');
                    $enddate = date('Y-m-d H:i:s', strtotime($startdate)+10800);
                    $borrowpriority=htmlspecialchars(strip_tags($_POST['txt-borrowpriority']));
                    $bookingstatus=htmlspecialchars(strip_tags($_POST['txt-bookingstatus']));
                    $recordfee = "0 USD";
                    $borrowhour = "3 hours";

                    $borrowermail=htmlspecialchars(strip_tags($_POST['txt-borrowermail']));

                    $returnstatus=htmlspecialchars(strip_tags($_POST['txt-returnstatus']));
            
                    // bind the parameters
                    $stmt->bindParam(':roomid', $roomid);
                    $stmt->bindParam(':staffid', $staffid);
                    $stmt->bindParam(':borrowername', $borrowername);
                    $stmt->bindParam(':borrowertype', $borrowertype);
                    $stmt->bindParam(':startdate', $startdate);
                    $stmt->bindParam(':borrowhour', $borrowhour);
                    $stmt->bindParam(':enddate', $enddate);
                    $stmt->bindParam(':recordfee', $recordfee);
                    $stmt->bindParam(':borrowingstatus', $borrowingstatus);
                    $stmt->bindParam(':returnstatus', $returnstatus);
                    $stmt->bindParam(':submitdate', $submitdate);
                    $stmt->bindParam(':borrowpriority', $borrowpriority);
                    $stmt->bindParam(':bookingstatus', $bookingstatus);
                    $stmt->bindParam(':borrowermail', $borrowermail);
                    
                    // Execute the query
                    if($stmt->execute()){
                        echo "<div class='alert alert-success'>Record was saved.</div>";
                    }else{
                        echo "<div class='alert alert-danger'>Unable to save record.</div>";
                    }
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
                <td>Room ID</td>
                <td><input type='number' name='txt-roomid' min="1" max="15" class='form-control' required/></td>
            </tr>
            <tr>
                <td>Borrower Name</td>
                <td><input type='text' name='txt-borrowername' class='form-control' required/></td>
            </tr>
            <tr>
                <td>Borrower Type</td>
                <td><input type='text' name='txt-borrowertype' class='form-control' pattern="[^0-9]*" title="Borrower type must not contain number" required/></td>
            </tr>
            <tr>
                <td>Start Date</td>
                <td><input type='datetime-local' name='txt-startdate' min="<?php echo $currentdate;?>T<?php echo $currenttime;?>" class='form-control' required/></td>
            </tr>
            <tr>
                <td>Borrowing Status</td>
                <td><input type='number' name='txt-borrowingstatus' min="0" max="1" class='form-control' required/></td>
            </tr>
            <tr>
                <td>Return Status</td>
                <td><input type='number' name='txt-returnstatus' min="0" max="1" class='form-control' required/></td>
            </tr>
            <tr>
                <td>Borrow Priority</td>
                <td><input type='number' name='txt-borrowpriority' min="0" class='form-control' required/></td>
            </tr>
            <tr>
                <td>Booking Status</td>
                <td><input type='number' name='txt-bookingstatus' min="0" max="1" class='form-control' required/></td>
            </tr>
            <tr>
                <td>Borrower Mail</td>
                <td><input type='text' name='txt-borrowermail' class='form-control' pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Email must be resembled to characters@characters.domain" required/></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type='submit' value='Save' class='btn btn-primary' />
                    <a href='viewroomrecords.php' class='btn btn-danger'>Back to view room borrowing records</a>
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