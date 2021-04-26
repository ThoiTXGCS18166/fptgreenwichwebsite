<!DOCTYPE HTML>
<html>
<head>
    <title>The Specific Book Viewing Page For Administrator</title>
 
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
 
</head>
<body>
 
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>View Specific Book Information</h1>
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
            $query = "SELECT BookID, CategoryID, AdminID, BookName, AuthorName, BookEdition, BookPublisher, BookLength, ISBN, PublishYear, BookImage, BookStatus, QRCode FROM books WHERE BookID = ? LIMIT 0,1";
            $stmt = $con->prepare( $query );
        
            // this is the first question mark
            $stmt->bindParam(1, $id);
        
            // execute our query
            $stmt->execute();
        
            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
            // values to fill up our form
            $bookid = $row['BookID'];
            $categoryid = $row['CategoryID'];
            $adminid = $row['AdminID'];
            $bookname = $row['BookName'];
            $authorname = $row['AuthorName'];
            $bookedition = $row['BookEdition'];
            $bookpublisher = $row['BookPublisher'];
            $booklength = $row['BookLength'];
            $isbn = $row['ISBN'];
            $publishyear = $row['PublishYear'];
            $bookimage = $row['BookImage'];
            $bookstatus = $row['BookStatus'];
            $qrcode = $row['QRCode'];

            if($bookstatus == 1) {
                $status = 'Available';
            } else {
                $status = 'Disabled';
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
                <td>Book ID</td>
                <td><?php echo htmlspecialchars($bookid, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Category ID</td>
                <td><?php echo htmlspecialchars($categoryid, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Admin ID</td>
                <td><?php echo htmlspecialchars($adminid, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Book Name</td>
                <td><?php echo htmlspecialchars($bookname, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Author Name</td>
                <td><?php echo htmlspecialchars($authorname, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Book Edition</td>
                <td><?php echo htmlspecialchars($bookedition, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Book Publisher</td>
                <td><?php echo htmlspecialchars($bookpublisher, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Book Length</td>
                <td><?php echo htmlspecialchars($booklength, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>ISBN</td>
                <td><?php echo htmlspecialchars($isbn, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Publish Year</td>
                <td><?php echo htmlspecialchars($publishyear, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Book Image</td>
                <td>
                <?php echo $bookimage ? "<img src='uploads/{$bookimage}' style='width:300px;' />" : "No image found.";  ?>
                </td>
            </tr>
            <tr>
                <td>Book Status</td>
                <td><?php echo htmlspecialchars($status, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>QR Code</td>
                <td>
                <?php echo $qrcode ? "<img src='uploads/{$qrcode}' style='width:300px;' />" : "No image found.";  ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href='viewbooks.php' class='btn btn-danger'>Back to view books</a>
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