<!DOCTYPE HTML>
<html>
<head>
    <title>The Book Borrowing Record Canceling Page For Outsider</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
         
</head>
<body>
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Cancel Book Borrowing Record</h1>
        </div>
     
        <?php
        // get passed parameter value, in this case, the record ID
        // isset() is a PHP function used to verify if a value is there or not
        $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
        
        //include database connection
        include 'config/database.php';
        
        // read current record's data
        try {
            // prepare select query
            $query = "SELECT BookRecordID, BookID, BorrowerName, BorrowerType, StartDate, EndDate, RecordFee, BorrowingStatus, ReturnStatus, SubmitDate, BorrowPriority, BookingStatus, BorrowerMail FROM bookrecords WHERE BookRecordID = ? LIMIT 0,1";
            $stmt = $con->prepare( $query );
            
            // this is the first question mark
            $stmt->bindParam(1, $id);
            
            // execute our query
            $stmt->execute();
            
            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // values to fill up our form
            $bookid = $row['BookID'];
            $borrowername = $row['BorrowerName'];
            $borrowertype = $row['BorrowerType'];
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $startdate = $row['StartDate'];
            $enddate = $row['EndDate'];
            $recordfee = $row['RecordFee'];
            $borrowingstatus = $row['BorrowingStatus'];
            $returnstatus = $row['ReturnStatus'];
            $submitdate = $row['SubmitDate'];
            $borrowpriority = '0';
            $bookingstatus=0;
            $borrowermail = $row['BorrowerMail'];

            if($borrowingstatus == 1) {
                $borrow = 'Borrowed';
            } else {
                $borrow = 'Not Borrowed';
            }

            if($returnstatus == 1) {
                $return = 'Returned';
            } else {
                $return = 'Not Returned';
            }

            if($bookingstatus == 1) {
                $book = 'Booked';
            } else {
                $book = 'Disabled';
            }
        }
        
        // show error
        catch(PDOException $exception){
            die('ERROR: ' . $exception->getMessage());
        }
        ?>
 
        <?php
        
        // check if form was submitted
        if($_POST){
            
            try{
                
                if($borrowingstatus == 1 && $bookingstatus == 0) {
                    echo '<script>alert("This book borrowing record can not be disabled")</script>';
                } else {
                    // write update query
                    // in this case, it seemed like we have so many fields to pass and 
                    // it is better to label them and not use question marks
                    $query = "UPDATE bookrecords 
                    SET BookID=:bookid, BorrowerName=:borrowername, BorrowerType=:borrowertype, StartDate=:startdate, EndDate=:enddate, RecordFee=:recordfee, BorrowingStatus=:borrowingstatus, ReturnStatus=:returnstatus, SubmitDate=:submitdate, BorrowPriority=:borrowpriority, BookingStatus=:bookingstatus, BorrowerMail=:borrowermail
                    WHERE BookRecordID = :id";

                    // prepare query for excecution
                    $stmt = $con->prepare($query);

                    // posted values
                    $bookid=htmlspecialchars(strip_tags($_POST['txt-bookid']));
                    $borrowername=htmlspecialchars(strip_tags($_POST['txt-borrowername']));
                    $borrowertype=htmlspecialchars(strip_tags($_POST['txt-borrowertype']));
                    $startdate=htmlspecialchars(strip_tags($_POST['txt-startdate']));
                    $enddate=htmlspecialchars(strip_tags($_POST['txt-enddate']));
                    $recordfee=htmlspecialchars(strip_tags($_POST['txt-recordfee']));
                    $borrowingstatus=htmlspecialchars(strip_tags($_POST['txt-borrowingstatus']));
                    $returnstatus=htmlspecialchars(strip_tags($_POST['txt-returnstatus']));
                    $submitdate=htmlspecialchars(strip_tags($_POST['txt-submitdate']));
                    $borrowpriority=htmlspecialchars(strip_tags($_POST['txt-borrowpriority']));
                    $bookingstatus=htmlspecialchars(strip_tags($_POST['txt-bookingstatus']));
                    $borrowermail=htmlspecialchars(strip_tags($_POST['txt-borrowermail']));

                    // bind the parameters
                    $stmt->bindParam(':bookid', $bookid);
                    $stmt->bindParam(':borrowername', $borrowername);
                    $stmt->bindParam(':borrowertype', $borrowertype);
                    $stmt->bindParam(':startdate', $startdate);
                    $stmt->bindParam(':enddate', $enddate);
                    $stmt->bindParam(':recordfee', $recordfee);
                    $stmt->bindParam(':borrowingstatus', $borrowingstatus);
                    $stmt->bindParam(':returnstatus', $returnstatus);
                    $stmt->bindParam(':submitdate', $submitdate);
                    $stmt->bindParam(':borrowpriority', $borrowpriority);
                    $stmt->bindParam(':bookingstatus', $bookingstatus);
                    $stmt->bindParam(':borrowermail', $borrowermail);
                    $stmt->bindParam(':id', $id);
                    
                    // Execute the query
                    if($stmt->execute()){
                        echo "<div class='alert alert-success'>Record was updated.</div>";
                    }else{
                        echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
                    }
                }
                
            }
            
            // show errors
            catch(PDOException $exception){
                die('ERROR: ' . $exception->getMessage());
            }
        }
        ?>
 
        <!--we have our html form here where new record information can be updated-->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Book ID</td>
                    <td><input type='text' name='txt-bookid' value="<?php echo htmlspecialchars($bookid, ENT_QUOTES);  ?>" readonly class='form-control' /></td>
                </tr>
                <tr>
                    <td>Borrower Name</td>
                    <td><input type='text' name='txt-borrowername' value="<?php echo htmlspecialchars($borrowername, ENT_QUOTES);  ?>" readonly class='form-control' /></td>
                </tr>
                <tr>
                    <td>Borrower Type</td>
                    <td><input type='text' name='txt-borrowertype' value="<?php echo htmlspecialchars($borrowertype, ENT_QUOTES);  ?>" readonly class='form-control' /></td>
                </tr>
                <tr>
                    <td>Start Date</td>
                    <td><input type='text' name='txt-startdate' value="<?php echo htmlspecialchars($startdate, ENT_QUOTES);  ?>" readonly class='form-control' /></td>
                </tr>
                <tr>
                    <td>End Date</td>
                    <td><input type='text' name='txt-enddate' value="<?php echo htmlspecialchars($enddate, ENT_QUOTES);  ?>" readonly class='form-control' /></td>
                </tr>
                <tr>
                    <td>Record Fee</td>
                    <td><input type='text' name='txt-recordfee' value="<?php echo htmlspecialchars($recordfee, ENT_QUOTES);  ?>" readonly class='form-control' /></td>
                </tr>
                <tr>
                    <td>Borrowing Status</td>
                    <td><input type='text' name='txt-borrowingstatus' value="<?php echo htmlspecialchars($borrow, ENT_QUOTES);  ?>" readonly class='form-control' /></td>
                </tr>
                <tr>
                    <td>Return Status</td>
                    <td><input type='text' name='txt-returnstatus' value="<?php echo htmlspecialchars($return, ENT_QUOTES);  ?>" readonly class='form-control' /></td>
                </tr>
                <tr>
                    <td>Request Submit Date</td>
                    <td><input type='text' name='txt-submitdate' value="<?php echo htmlspecialchars($submitdate, ENT_QUOTES);  ?>" readonly class='form-control' /></td>
                </tr>
                <tr>
                    <td>Book Borrowing Priority</td>
                    <td><input type='text' name='txt-borrowpriority' value="<?php echo htmlspecialchars($borrowpriority, ENT_QUOTES);  ?>" readonly class='form-control' /></td>
                </tr>
                <tr>
                    <td>Booking Status</td>
                    <td><input type='text' name='txt-bookingstatus' value="<?php echo htmlspecialchars($book, ENT_QUOTES);  ?>" readonly class='form-control' /></td>
                </tr>
                <tr>
                    <td>Borrower Mail</td>
                    <td><input type='text' name='txt-borrowermail' value="<?php echo htmlspecialchars($borrowermail, ENT_QUOTES);  ?>" readonly class='form-control' /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save Changes' class='btn btn-primary' />
                        <a href='viewobookborrowingrecords.php' class='btn btn-danger'>Back to view book borrowing records</a>
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