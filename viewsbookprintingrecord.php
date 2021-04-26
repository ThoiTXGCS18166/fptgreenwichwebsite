<!DOCTYPE HTML>
<html>
<head>
    <title>The Specific Book Printing Record Viewing Page For Student</title>
 
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
 
</head>
<body>
 
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>View Specific Book Printing Record Information</h1>
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
            $query = "SELECT PrintingID, BookID, PrinterName, PrinterType, PrintingDate, PrintingFee, PrintingStatus, SubmitDate, BookingStatus, PaymentStatus, PrinterMail FROM printings WHERE PrintingID = ? LIMIT 0,1";
            $stmt = $con->prepare( $query );
        
            // this is the first question mark
            $stmt->bindParam(1, $id);
        
            // execute our query
            $stmt->execute();
        
            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
            // values to fill up our form
            $printingid = $row['PrintingID'];
            $bookid = $row['BookID'];
            $printername = $row['PrinterName'];
            $printertype = $row['PrinterType'];
            $printingdate = $row['PrintingDate'];
            $printingfee = $row['PrintingFee'];
            $printingstatus = $row['PrintingStatus'];
            $submitdate = $row['SubmitDate'];
            $bookingstatus = $row['BookingStatus'];
            $paymentstatus = $row['PaymentStatus'];
            $printermail = $row['PrinterMail'];

            if($printingstatus == 1) {
                $print = 'Printed';
            } else {
                $print = 'Not Printed';
            }

            if($bookingstatus == 1) {
                $book = 'Booked';
            } else {
                $book = 'Disabled';
            }

            if($paymentstatus == 1) {
                $payment = 'Paid';
            } else {
                $payment = 'Unpaid';
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
                <td>Printing Record ID</td>
                <td><?php echo htmlspecialchars($printingid, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Book ID</td>
                <td><?php echo htmlspecialchars($bookid, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Printer Name</td>
                <td><?php echo htmlspecialchars($printername, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Printer Type</td>
                <td><?php echo htmlspecialchars($printertype, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Printing Date</td>
                <td><?php echo htmlspecialchars($printingdate, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Printing Fee</td>
                <td><?php echo htmlspecialchars($printingfee, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Printing Status</td>
                <td><?php echo htmlspecialchars($print, ENT_QUOTES);  ?></td>
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
                <td>Payment Status</td>
                <td><?php echo htmlspecialchars($payment, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Printer Mail</td>
                <td><?php echo htmlspecialchars($printermail, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href='viewsbookprintingrecords.php' class='btn btn-danger'>Back to view book printing records</a>
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