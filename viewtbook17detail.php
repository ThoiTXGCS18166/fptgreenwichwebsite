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

  $sql="SELECT * FROM books WHERE BookName = 'Becoming' limit 1";

  $result=mysqli_query($conn,$sql);
                
  if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) {
      $book17name = $row["BookName"];
      $book17author = $row["AuthorName"];
      $book17edition = $row["BookEdition"];
      $book17publisher = $row["BookPublisher"];
      $book17length = $row["BookLength"];
      $isbn = $row["ISBN"];
      $publishyear = $row["PublishYear"];
      $book17image = $row["BookImage"];
      $status17 = $row["BookStatus"];
    }

    if($status17 == 0) {
      $book17status = 'Unavailable for borrowing and printing';
    } else {
      $book17status = 'Available for borrowing and printing';
    }
  }

  $sql="SELECT * FROM bookpages WHERE PageID = 81 AND BookID = 17 limit 1";

  $result=mysqli_query($conn,$sql);
                
  if(mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $book17page1 = $row["PageImage"];
    }
  }

  $sql="SELECT * FROM bookpages WHERE PageID = 82 AND BookID = 17 limit 1";

  $result=mysqli_query($conn,$sql);
                
  if(mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $book17page2 = $row["PageImage"];
    }
  }

  $sql="SELECT * FROM bookpages WHERE PageID = 83 AND BookID = 17 limit 1";

  $result=mysqli_query($conn,$sql);
                
  if(mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $book17page3 = $row["PageImage"];
    }
  }

  $sql="SELECT * FROM bookpages WHERE PageID = 84 AND BookID = 17 limit 1";

  $result=mysqli_query($conn,$sql);
                
  if(mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $book17page4 = $row["PageImage"];
    }
  }

  $sql="SELECT * FROM bookpages WHERE PageID = 85 AND BookID = 17 limit 1";

  $result=mysqli_query($conn,$sql);
                
  if(mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $book17page5 = $row["PageImage"];
    }
  }
   
  if(isset($_POST['btn-return'])){
    header("location: viewtbook1.php");
  }

  if(isset($_POST['btn-borrow'])){
    $_SESSION['borrowed_bookname'] = "Becoming";
    header("location: borrowtbook.php");
  }

  if(isset($_POST['btn-print'])){
    $_SESSION['printed_bookname'] = "Becoming";
    header("location: printtdocument.php");
  }

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <meta name="robots" content="noindex,follow" />
    <title>The Biographies Book 1 Detail Viewing Page For Teachers</title>

    <style>
        
        * {box-sizing: border-box}
        .mySlides1 {display: none}
        img {vertical-align: middle;}

        /* Slideshow container */
        .slideshow-container {
        max-width: 350px;
        position: relative;
        margin: auto;
        }

        /* Next & previous buttons */
        .prev, .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        padding: 16px;
        margin-top: -22px;
        color: white;
        font-weight: bold;
        font-size: 18px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
        right: 0;
        border-radius: 3px 0 0 3px;
        }

        /* On hover, add a grey background color */
        .prev:hover, .next:hover {
        background-color: #f1f1f1;
        color: black;
        }

        h2{
            text-align: center;
        }

        table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        td, th {
        text-align: left;
        padding: 8px;
        }

        table, th, td {
        border: 1px solid black;
        }

        tr:nth-child(even) {
        background-color: #dddddd;
        }

        .buttonHolder{ 
        text-align: center; 
        }

        input[type=submit] {
        border: none;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        margin: 4px 2px;
        cursor: pointer;
        font-size: 17px;
        width: 12em;
        height: 3em;
        }

    </style>

</head>
<body>
    <h2>The Specific Detail For The Biographies Book 1</h2>
    <table>
        <tr>
            <th>Book Name</th>
            <td><?php echo $book17name;?></td>
        </tr>
        <tr>
            <th>Author Name</th>
            <td><?php echo $book17author;?></td>
        </tr>
        <tr>
            <th>Book Edition</th>
            <td><?php echo $book17edition;?></td>
        </tr>
        <tr>
            <th>Book Publisher</th>
            <td><?php echo $book17publisher;?></td>
        </tr>
        <tr>
            <th>Book Length</th>
            <td><?php echo $book17length;?> pages</td>
        </tr>
        <tr>
            <th>ISBN</th>
            <td><?php echo $isbn;?></td>
        </tr>
        <tr>
            <th>Publish Year</th>
            <td><?php echo $publishyear;?></td>
        </tr>
        <tr>
            <th>Book Status</th>
            <td><?php echo $book17status?></td>
        </tr>
        <tr>
            <th>The Images For The Book Pages</th>
            <td>
                <div class="slideshow-container">
                <div class="mySlides1">
                    <?php echo $book17image ? "<img src='img/{$book17image}' style='width:100%;' />" : "No image found.";  ?>
                </div>

                <div class="mySlides1">
                    <?php echo $book17page1 ? "<img src='img/{$book17page1}' style='width:100%;' />" : "No image found.";  ?>
                </div>

                <div class="mySlides1">
                    <?php echo $book17page2 ? "<img src='img/{$book17page2}' style='width:100%;' />" : "No image found.";  ?>
                </div>

                <div class="mySlides1">
                    <?php echo $book17page3 ? "<img src='img/{$book17page3}' style='width:100%;' />" : "No image found.";  ?>
                </div>

                <div class="mySlides1">
                    <?php echo $book17page4 ? "<img src='img/{$book17page4}' style='width:100%;' />" : "No image found.";  ?>
                </div>

                <div class="mySlides1">
                    <?php echo $book17page5 ? "<img src='img/{$book17page5}' style='width:100%;' />" : "No image found.";  ?>
                </div>

                <a class="prev" onclick="plusSlides(-1, 0)">&#10094;</a>
                <a class="next" onclick="plusSlides(1, 0)">&#10095;</a>
                </div>
            </td>
        </tr>
        <tr>
            <th>Action</th>
            <td>
            <form action="viewtbook17detail.php" method="POST">
            <div class="buttonHolder">
            <input type="submit" style="background-color: #FF0000;" value="Back To View Books" name="btn-return">
            <input type="submit" style="background-color: #4CAF50;" value="Borrow Book" name="btn-borrow">
            <input type="submit" style="background-color: #555555;" value="Print Book" name="btn-print">
            </div>
            </form>
            </td>
        </tr>

    </table>


    <script>
    var slideIndex = [1,1];
    var slideId = ["mySlides1"]
    showSlides(1, 0);
    showSlides(1, 1);

    function plusSlides(n, no) {
    showSlides(slideIndex[no] += n, no);
    }

    function showSlides(n, no) {
    var i;
    var x = document.getElementsByClassName(slideId[no]);
    if (n > x.length) {slideIndex[no] = 1}    
    if (n < 1) {slideIndex[no] = x.length}
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";  
    }
    x[slideIndex[no]-1].style.display = "block";  
    }
    </script>

</body>
</html>