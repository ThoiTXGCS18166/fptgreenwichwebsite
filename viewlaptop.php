<!DOCTYPE HTML>
<html>
<head>
    <title>The Specific Laptop Viewing Page For Administrator</title>
 
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
 
</head>
<body>
 
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>View Specific Laptop Information</h1>
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
            $query = "SELECT LaptopID, AdminID, LaptopName, LaptopImage, CPU, RAM, HardDrive, Screen, ScreenCard, Port, OperatingSystem, LaptopStatus, Size FROM laptops WHERE LaptopID = ? LIMIT 0,1";
            $stmt = $con->prepare( $query );
        
            // this is the first question mark
            $stmt->bindParam(1, $id);
        
            // execute our query
            $stmt->execute();
        
            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
            // values to fill up our form
            $laptopid = $row['LaptopID'];
            $adminid = $row['AdminID'];
            $laptopname = $row['LaptopName'];
            $laptopimage = $row['LaptopImage'];
            $cpu = $row['CPU'];
            $ram = $row['RAM'];
            $harddrive = $row['HardDrive'];
            $screen = $row['Screen'];
            $screencard = $row['ScreenCard'];
            $port = $row['Port'];
            $operatingsystem = $row['OperatingSystem'];
            $laptopstatus = $row['LaptopStatus'];
            $size = $row['Size'];

            if($laptopstatus == 1) {
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
                <td>Laptop ID</td>
                <td><?php echo htmlspecialchars($laptopid, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Admin ID</td>
                <td><?php echo htmlspecialchars($adminid, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Laptop Name</td>
                <td><?php echo htmlspecialchars($laptopname, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Laptop Image</td>
                <td>
                <?php echo $laptopimage ? "<img src='uploads/{$laptopimage}' style='width:300px;' />" : "No image found.";  ?>
                </td>
            </tr>
            <tr>
                <td>CPU</td>
                <td><?php echo htmlspecialchars($cpu, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>RAM</td>
                <td><?php echo htmlspecialchars($ram, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Hard Drive</td>
                <td><?php echo htmlspecialchars($harddrive, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Screen</td>
                <td><?php echo htmlspecialchars($screen, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Screen Card</td>
                <td><?php echo htmlspecialchars($screencard, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Port</td>
                <td><?php echo htmlspecialchars($port, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Operating System</td>
                <td><?php echo htmlspecialchars($operatingsystem, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Size</td>
                <td><?php echo htmlspecialchars($size, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Laptop Status</td>
                <td><?php echo htmlspecialchars($status, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href='viewlaptops.php' class='btn btn-danger'>Back to view laptops</a>
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