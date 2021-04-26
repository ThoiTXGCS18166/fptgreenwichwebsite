<!DOCTYPE HTML>
<html>
<head>
    <title>The Specific Laptop Borrowing Record Viewing Page For Student</title>
 
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
 
</head>
<body>
 
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>View Specific Laptop Borrowing Record Information</h1>
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
            $query = "SELECT LaptopRecordID, LaptopID, BorrowerName, BorrowerType, StartDate, EndDate, RecordFee, BorrowingStatus, ReturnStatus, SubmitDate, BookingStatus, BorrowerMail FROM laptoprecords WHERE LaptopRecordID = ? LIMIT 0,1";
            $stmt = $con->prepare( $query );
        
            // this is the first question mark
            $stmt->bindParam(1, $id);
        
            // execute our query
            $stmt->execute();
        
            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
            // values to fill up our form
            $laptoprecordid = $row['LaptopRecordID'];
            $laptopid = $row['LaptopID'];
            $borrowername = $row['BorrowerName'];
            $borrowertype = $row['BorrowerType'];
            $startdate = $row['StartDate'];
            $enddate = $row['EndDate'];
            $recordfee = $row['RecordFee'];
            $borrowingstatus = $row['BorrowingStatus'];
            $returnstatus = $row['ReturnStatus'];
            $submitdate = $row['SubmitDate'];
            $bookingstatus = $row['BookingStatus'];
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
 
        <!--we have our html table here where the record will be displayed-->
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Laptop Borrowing Record ID</td>
                <td><?php echo htmlspecialchars($laptoprecordid, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Laptop ID</td>
                <td><?php echo htmlspecialchars($laptopid, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Borrower Name</td>
                <td><?php echo htmlspecialchars($borrowername, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Borrower Type</td>
                <td><?php echo htmlspecialchars($borrowertype, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Start Date</td>
                <td><?php echo htmlspecialchars($startdate, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>End Date</td>
                <td><?php echo htmlspecialchars($enddate, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Record Fee</td>
                <td><?php echo htmlspecialchars($recordfee, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Borrowing Status</td>
                <td><?php echo htmlspecialchars($borrow, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Return Status</td>
                <td><?php echo htmlspecialchars($return, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Request Submit Date</td>
                <td><?php echo htmlspecialchars($submitdate, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Booking Status</td>
                <td><?php echo htmlspecialchars($book, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Borrower Mail</td>
                <td><?php echo htmlspecialchars($borrowermail, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href='viewslaptopborrowingrecords.php' class='btn btn-danger'>Back to view laptop borrowing records</a>
                </td>
            </tr>
        </table>
 
    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>