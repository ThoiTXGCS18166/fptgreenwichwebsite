<?php
  $host="us-cdbr-iron-east-05.cleardb.net";
  $user="be790e4eb7458b";
  $password="78c739da";
  $db="heroku_0a876b33f00670d";
  
  $conn = mysqli_connect($host,$user,$password,$db);

  session_start();

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $sql="SELECT * FROM books WHERE BookName = 'Guns, Germs, and Steel' limit 1";

  $result=mysqli_query($conn,$sql);
                
  if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) {
      $book9author = $row["AuthorName"];
      $book9length = $row["BookLength"];
      $book9image = $row["BookImage"];
      $status9 = $row["BookStatus"];
    }

    if($status9 == 0) {
      $book9status = 'Unavailable';
    } else {
      $book9status = 'Available';
    }
  }

  $sql="SELECT * FROM books WHERE BookName = 'A People History of the United States' limit 1";

  $result=mysqli_query($conn,$sql);
                
  if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) {
      $book10author = $row["AuthorName"];
      $book10length = $row["BookLength"];
      $book10image = $row["BookImage"];
      $status10 = $row["BookStatus"];
    }

    if($status10 == 0) {
      $book10status = 'Unavailable';
    } else {
      $book10status = 'Available';
    }
  }

  $sql="SELECT * FROM books WHERE BookName = 'The History of the Ancient World' limit 1";

  $result=mysqli_query($conn,$sql);
                
  if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) {
      $book11author = $row["AuthorName"];
      $book11length = $row["BookLength"];
      $book11image = $row["BookImage"];
      $status11 = $row["BookStatus"];
    }

    if($status11 == 0) {
      $book11status = 'Unavailable';
    } else {
      $book11status = 'Available';
    }
  }

  $sql="SELECT * FROM books WHERE BookName = 'Devil in the White City' limit 1";

  $result=mysqli_query($conn,$sql);
                
  if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) {
      $book12author = $row["AuthorName"];
      $book12length = $row["BookLength"];
      $book12image = $row["BookImage"];
      $status12 = $row["BookStatus"];
    }

    if($status12 == 0) {
      $book12status = 'Unavailable';
    } else {
      $book12status = 'Available';
    }
  }

  $sql="SELECT * FROM books WHERE BookName = 'Salt, Fat, Acid, Heat' limit 1";

  $result=mysqli_query($conn,$sql);
                
  if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) {
      $book13author = $row["AuthorName"];
      $book13length = $row["BookLength"];
      $book13image = $row["BookImage"];
      $status13 = $row["BookStatus"];
    }

    if($status13 == 0) {
      $book13status = 'Unavailable';
    } else {
      $book13status = 'Available';
    }
  }

  $sql="SELECT * FROM books WHERE BookName = 'On Food and Cooking' limit 1";

  $result=mysqli_query($conn,$sql);
                
  if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) {
      $book14author = $row["AuthorName"];
      $book14length = $row["BookLength"];
      $book14image = $row["BookImage"];
      $status14 = $row["BookStatus"];
    }

    if($status14 == 0) {
      $book14status = 'Unavailable';
    } else {
      $book14status = 'Available';
    }
  }

  $sql="SELECT * FROM books WHERE BookName = 'Kitchen Confidential' limit 1";

  $result=mysqli_query($conn,$sql);
                
  if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) {
      $book15author = $row["AuthorName"];
      $book15length = $row["BookLength"];
      $book15image = $row["BookImage"];
      $status15 = $row["BookStatus"];
    }

    if($status15 == 0) {
      $book15status = 'Unavailable';
    } else {
      $book15status = 'Available';
    }
  }

  $sql="SELECT * FROM books WHERE BookName = 'Mastering the Art of French Cooking' limit 1";

  $result=mysqli_query($conn,$sql);
                
  if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) {
      $book16author = $row["AuthorName"];
      $book16length = $row["BookLength"];
      $book16image = $row["BookImage"];
      $status16 = $row["BookStatus"];
    }

    if($status16 == 0) {
      $book16status = 'Unavailable';
    } else {
      $book16status = 'Available';
    }
  }
   
  if(isset($_POST['btn-search'])){   
    $searchedname=$_POST['txt-searchedname'];
    if($searchedname == "How to win friends and influence people" || $searchedname == "Dale Carnegie"){
      header("location: searchsbook1.php");
    } elseif($searchedname == "Think and Grow Rich" || $searchedname == "Napoleon Hill"){
      header("location: searchsbook2.php");
    } elseif($searchedname == "Start with Why" || $searchedname == "Simon Sinek"){
      header("location: searchsbook3.php");
    } elseif($searchedname == "The 7 Habits of Highly Effective People" || $searchedname == "Stephen Covey"){
      header("location: searchsbook4.php");
    } elseif($searchedname == "HTML & CSS: Design and Build Web Sites" || $searchedname == "Jon Duckett"){
      header("location: searchsbook5.php");
    } elseif($searchedname == "Learning Web Design" || $searchedname == "Jennifer Robbins"){
      header("location: searchsbook6.php");
    } elseif($searchedname == "The Soul of a New Machine" || $searchedname == "Tracy Kidder"){
      header("location: searchsbook7.php");
    } elseif($searchedname == "Learning PHP, MySQL, JavaScript, CSS and HTML5" || $searchedname == "Robin Nixon"){
      header("location: searchsbook8.php");
    } elseif($searchedname == "Guns, Germs, and Steel" || $searchedname == "Jared Diamond"){
      header("location: searchsbook9.php");
    } elseif($searchedname == "A People History of the United States" || $searchedname == "Howard Zinn"){
      header("location: searchsbook10.php");
    } elseif($searchedname == "The History of the Ancient World" || $searchedname == "Susan Wise Bauer"){
      header("location: searchsbook11.php");
    } elseif($searchedname == "Devil in the White City" || $searchedname == "Erik Larson"){
      header("location: searchsbook12.php");
    } elseif($searchedname == "Salt, Fat, Acid, Heat" || $searchedname == "Samin Nosrat"){
      header("location: searchsbook13.php");
    } elseif($searchedname == "On Food and Cooking" || $searchedname == "Harold McGee"){
      header("location: searchsbook14.php");
    } elseif($searchedname == "Kitchen Confidential" || $searchedname == "Anthony Bourdain"){
      header("location: searchsbook15.php");
    } elseif($searchedname == "Mastering the Art of French Cooking" || $searchedname == "Julia Child"){
      header("location: searchsbook16.php");
    } elseif($searchedname == "Becoming" || $searchedname == "Michelle Obama"){
      header("location: searchsbook17.php");
    } elseif($searchedname == "Into the Wild" || $searchedname == "Jon Krakauer"){
      header("location: searchsbook18.php");
    } elseif($searchedname == "Steve Jobs" || $searchedname == "Walter Isaacson"){
      header("location: searchsbook19.php");
    } elseif($searchedname == "Unbroken" || $searchedname == "Laura Hillenbrand"){
      header("location: searchsbook20.php");
    } elseif($searchedname == ""){
      header("location: viewsbook1.php");
    } else{
      echo '<script>alert("The searched book/author name is not existed in the library database. Please modify the information in the search field again for searching book")</script>';
    }
  }

  if(isset($_POST['btn-borrow9'])){
    $_SESSION['borrowed_bookname'] = "Guns, Germs, and Steel";
    header("location: borrowsbook.php");
  }

  if(isset($_POST['btn-borrow10'])){
    $_SESSION['borrowed_bookname'] = "A People History of the United States";
    header("location: borrowsbook.php");
  }

  if(isset($_POST['btn-borrow11'])){
    $_SESSION['borrowed_bookname'] = "The History of the Ancient World";
    header("location: borrowsbook.php");
  }

  if(isset($_POST['btn-borrow12'])){
    $_SESSION['borrowed_bookname'] = "Devil in the White City";
    header("location: borrowsbook.php");
  }

  if(isset($_POST['btn-borrow13'])){
    $_SESSION['borrowed_bookname'] = "Salt, Fat, Acid, Heat";
    header("location: borrowsbook.php");
  }

  if(isset($_POST['btn-borrow14'])){
    $_SESSION['borrowed_bookname'] = "On Food and Cooking";
    header("location: borrowsbook.php");
  }

  if(isset($_POST['btn-borrow15'])){
    $_SESSION['borrowed_bookname'] = "Kitchen Confidential";
    header("location: borrowsbook.php");
  }

  if(isset($_POST['btn-borrow16'])){
    $_SESSION['borrowed_bookname'] = "Mastering the Art of French Cooking";
    header("location: borrowsbook.php");
  }

  if(isset($_POST['btn-print9'])){
    $_SESSION['printed_bookname'] = "Guns, Germs, and Steel";
    header("location: printsdocument.php");
  }

  if(isset($_POST['btn-print10'])){
    $_SESSION['printed_bookname'] = "A People History of the United States";
    header("location: printsdocument.php");
  }

  if(isset($_POST['btn-print11'])){
    $_SESSION['printed_bookname'] = "The History of the Ancient World";
    header("location: printsdocument.php");
  }

  if(isset($_POST['btn-print12'])){
    $_SESSION['printed_bookname'] = "Devil in the White City";
    header("location: printsdocument.php");
  }

  if(isset($_POST['btn-print13'])){
    $_SESSION['printed_bookname'] = "Salt, Fat, Acid, Heat";
    header("location: printsdocument.php");
  }

  if(isset($_POST['btn-print14'])){
    $_SESSION['printed_bookname'] = "On Food and Cooking";
    header("location: printsdocument.php");
  }

  if(isset($_POST['btn-print15'])){
    $_SESSION['printed_bookname'] = "Kitchen Confidential";
    header("location: printsdocument.php");
  }

  if(isset($_POST['btn-print16'])){
    $_SESSION['printed_bookname'] = "Mastering the Art of French Cooking";
    header("location: printsdocument.php");
  }

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Book Viewing Page For Students</title>
    <style>
    * {
      box-sizing:border-box;
    }

    body {
      margin: 0;
      font-family: "Lato", sans-serif;
    }

    .sidebar {
      margin: 0;
      padding: 0;
      width: 290px;
      background-color: #f1f1f1;
      position: fixed;
      height: 100%;
      overflow: auto;
    }

    .sidebar a {
      display: block;
      color: black;
      padding: 16px;
      text-decoration: none;
    }
    
    .sidebar a.active {
      background-color: #4CAF50;
      color: white;
    }

    .sidebar a:hover:not(.active) {
      background-color: #555;
      color: white;
    }

    div.content {
      margin-left: 300px;
      padding: 1px 16px;
      height: 1000px;
    }

    .autocomplete-items {
    position: absolute;
    border: 1px solid #d4d4d4;
    border-bottom: none;
    border-top: none;
    z-index: 99;
    /*position the autocomplete items to be the same width as the container:*/
    top: 100%;
    left: 0;
    right: 0;
    }

    .autocomplete-items div {
      padding: 10px;
      cursor: pointer;
      background-color: #fff; 
      border-bottom: 1px solid #d4d4d4; 
    }

    /*when hovering an item:*/
    .autocomplete-items div:hover {
      background-color: #e9e9e9; 
    }

    /*when navigating through the items using the arrow keys:*/
    .autocomplete-active {
      background-color: DodgerBlue !important; 
      color: #ffffff; 
    }

    input[type=text] {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
    }

    /*the container must be positioned relative:*/
    .autocomplete {
      position: relative;
      display: inline-block;
    }

    /* Create four equal columns that floats next to each other */
    .column {
    float: left;
    width: 25%;
    padding: 10px;
    }

    /* Clear floats after the columns */
    .row:after {
    content: "";
    display: table;
    clear: both;
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
    }

    label {
    padding: 12px 12px 12px 0;
    display: inline-block;
    font-weight: bold;
    }

    @media screen and (max-width: 992px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
      }
      .sidebar a {float: left;}
      div.content {margin-left: 0;}

      .column  {
            width: 50%;
        }
    }

    @media screen and (max-width: 500px) {
      .sidebar a {
        text-align: center;
        float: none;
      }

      .column  {
            width: 100%;
        }
    }

    h2{
        text-align: center;
    }

    h3{
        text-align: center;
    }

    img {
      display: block;
      margin-left: auto;
      margin-right: auto;
    }

    .center {
    text-align: center;
    }

    .pagination {
    display: inline-block;
    }

    .pagination a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #ddd;
    margin: 10px 4px;
    }

    .pagination a.active {
    background-color: #4CAF50;
    color: white;
    border: 1px solid #4CAF50;
    }

    .pagination a:hover:not(.active) {background-color: #ddd;}

    </style>
</head>
<body>

<div class="sidebar">
  <a href="home3.php">Home</a>
  <a class="active" href="viewsbook1.php">View Books</a>
  <a href="viewslaptop.php">View Laptops</a>
  <a href="borrowsbook.php">Borrow Books</a>
  <a href="borrowslaptop.php">Borrow Laptops</a>
  <a href="borrowsroom.php">Rent Study Room</a>
  <a href="printsdocument.php">Print Documents</a>
  <a href="viewsbookborrowingrecords.php">View Book Borrowing Records</a>
  <a href="viewslaptopborrowingrecords.php">View Laptop Borrowing Records</a>
  <a href="viewsroomborrowingrecords.php">View Room Borrowing Records</a>
  <a href="viewsbookprintingrecords.php">View Book Printing Records</a>
  <a href="updatestudentinfo.php">Update Info</a>
  <a href="librarychat.php"> Online Chat</a>
  <a href="about3.php">About Us</a>
  <a href="index.php">Log Out</a>
</div>

<div class="content">
  <img src="img/logo.PNG" alt="Library Logo" style="width:45%">
  <h2>The book-viewing page for students</h2>
  <h3>The information about the current books on this website</h3>
  
  <form action="viewsbook2.php" method="POST" autocomplete="off">
    <label for="txt-searchedname">Searched Book/Author Name</label>
    <div class="autocomplete" style="width:350px;">
    <input type="text" placeholder="Enter searched book/author name here" id="txt-searchedname" name="txt-searchedname" pattern=".{1,150}" title="Book/Author name must contain at least 1 and maximum 150 characters" data-clear-btn="true" data-mini="true">
    </div>
    <input type="submit" style="background-color: DodgerBlue;" value="Search Book" name="btn-search">
  </form>
  
  <h4>Book Category : History</h4>

  <div class="row">
    <div class="column" style="background-color:#aaa;">
    <?php echo $book9image ? "<img src='img/{$book9image}' style='display: block; margin-left: auto; margin-right: auto; width:100%; height:400px;' />" : "No image found.";  ?>
    <p>Book Author: <?php echo $book9author;?></p>
    <p>Book Pages: <?php echo $book9length;?> pages</p>
    <p>Book Status: <?php echo $book9status;?></p>
    <p style="text-align: center;"><a href="viewsbook9detail.php">View Book Details</a></p>
    <form action="viewsbook2.php" method="POST">
    <div class="buttonHolder">
    <input type="submit" style="background-color: #4CAF50;" value="Borrow Book" name="btn-borrow9">
    <input type="submit" style="background-color: #555555;" value="Print Book" name="btn-print9">
    </div>
    </form>
    </div>
    <div class="column" style="background-color:#bbb;">
    <?php echo $book10image ? "<img src='img/{$book10image}' style='display: block; margin-left: auto; margin-right: auto; width:100%; height:400px;' />" : "No image found.";  ?>
    <p>Book Author: <?php echo $book10author;?></p>
    <p>Book Pages: <?php echo $book10length;?> pages</p>
    <p>Book Status: <?php echo $book10status;?></p>
    <p style="text-align: center;"><a href="viewsbook10detail.php">View Book Details</a></p>
    <form action="viewsbook2.php" method="POST">
    <div class="buttonHolder">
    <input type="submit" style="background-color: #4CAF50;" value="Borrow Book" name="btn-borrow10">
    <input type="submit" style="background-color: #555555;" value="Print Book" name="btn-print10">
    </div>
    </form>
    </div>
    <div class="column" style="background-color:#ccc;">
    <?php echo $book11image ? "<img src='img/{$book11image}' style='display: block; margin-left: auto; margin-right: auto; width:100%; height:400px;' />" : "No image found.";  ?>
    <p>Book Author: <?php echo $book11author;?></p>
    <p>Book Pages: <?php echo $book11length;?> pages</p>
    <p>Book Status: <?php echo $book11status;?></p>
    <p style="text-align: center;"><a href="viewsbook11detail.php">View Book Details</a></p>
    <form action="viewsbook2.php" method="POST">
    <div class="buttonHolder">
    <input type="submit" style="background-color: #4CAF50;" value="Borrow Book" name="btn-borrow11">
    <input type="submit" style="background-color: #555555;" value="Print Book" name="btn-print11">
    </div>
    </form>
    </div>
    <div class="column" style="background-color:#ddd;">
    <?php echo $book12image ? "<img src='img/{$book12image}' style='display: block; margin-left: auto; margin-right: auto; width:100%; height:400px;' />" : "No image found.";  ?>
    <p>Book Author: <?php echo $book12author;?></p>
    <p>Book Pages: <?php echo $book12length;?> pages</p>
    <p>Book Status: <?php echo $book12status;?></p>
    <p style="text-align: center;"><a href="viewsbook12detail.php">View Book Details</a></p>
    <form action="viewsbook2.php" method="POST">
    <div class="buttonHolder">
    <input type="submit" style="background-color: #4CAF50;" value="Borrow Book" name="btn-borrow12">
    <input type="submit" style="background-color: #555555;" value="Print Book" name="btn-print12">
    </div>
    </form>
    </div>
  </div>

  <h4>Book Category : Cooking</h4>
  <div class="row">
    <div class="column" style="background-color:#aaa;">
    <?php echo $book13image ? "<img src='img/{$book13image}' style='display: block; margin-left: auto; margin-right: auto; width:100%; height:400px;' />" : "No image found.";  ?>
    <p>Book Author: <?php echo $book13author;?></p>
    <p>Book Pages: <?php echo $book13length;?> pages</p>
    <p>Book Status: <?php echo $book13status;?></p>
    <p style="text-align: center;"><a href="viewsbook13detail.php">View Book Details</a></p>
    <form action="viewsbook2.php" method="POST">
    <div class="buttonHolder">
    <input type="submit" style="background-color: #4CAF50;" value="Borrow Book" name="btn-borrow13">
    <input type="submit" style="background-color: #555555;" value="Print Book" name="btn-print13">
    </div>
    </form>
    </div>
    <div class="column" style="background-color:#bbb;">
    <?php echo $book14image ? "<img src='img/{$book14image}' style='display: block; margin-left: auto; margin-right: auto; width:100%; height:400px;' />" : "No image found.";  ?>
    <p>Book Author: <?php echo $book14author;?></p>
    <p>Book Pages: <?php echo $book14length;?> pages</p>
    <p>Book Status: <?php echo $book14status;?></p>
    <p style="text-align: center;"><a href="viewsbook14detail.php">View Book Details</a></p>
    <form action="viewsbook2.php" method="POST">
    <div class="buttonHolder">
    <input type="submit" style="background-color: #4CAF50;" value="Borrow Book" name="btn-borrow14">
    <input type="submit" style="background-color: #555555;" value="Print Book" name="btn-print14">
    </div>
    </form>
    </div>
    <div class="column" style="background-color:#ccc;">
    <?php echo $book15image ? "<img src='img/{$book15image}' style='display: block; margin-left: auto; margin-right: auto; width:100%; height:400px;' />" : "No image found.";  ?>
    <p>Book Author: <?php echo $book15author;?></p>
    <p>Book Pages: <?php echo $book15length;?> pages</p>
    <p>Book Status: <?php echo $book15status;?></p>
    <p style="text-align: center;"><a href="viewsbook15detail.php">View Book Details</a></p>
    <form action="viewsbook2.php" method="POST">
    <div class="buttonHolder">
    <input type="submit" style="background-color: #4CAF50;" value="Borrow Book" name="btn-borrow15">
    <input type="submit" style="background-color: #555555;" value="Print Book" name="btn-print15">
    </div>
    </form>
    </div>
    <div class="column" style="background-color:#ddd;">
    <?php echo $book16image ? "<img src='img/{$book16image}' style='display: block; margin-left: auto; margin-right: auto; width:100%; height:400px;' />" : "No image found.";  ?>
    <p>Book Author: <?php echo $book16author;?></p>
    <p>Book Pages: <?php echo $book16length;?> pages</p>
    <p>Book Status: <?php echo $book16status;?></p>
    <p style="text-align: center;"><a href="viewsbook16detail.php">View Book Details</a></p>
    <form action="viewsbook2.php" method="POST">
    <div class="buttonHolder">
    <input type="submit" style="background-color: #4CAF50;" value="Borrow Book" name="btn-borrow16">
    <input type="submit" style="background-color: #555555;" value="Print Book" name="btn-print16">
    </div>
    </form>
    </div>
  </div>

  <div class="center">
    <div class="pagination">
    <a href="viewsbook1.php">1</a>
    <a href="viewsbook2.php" class="active">2</a>
    <a href="viewsbook3.php">3</a>
    </div>
  </div>

</div>

<script>
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the country names in the world:*/
var books = ["How to win friends and influence people", "Think and Grow Rich", "Start with Why", "The 7 Habits of Highly Effective People", "HTML & CSS: Design and Build Web Sites", "Learning Web Design", "The Soul of a New Machine", "Learning PHP, MySQL, JavaScript, CSS and HTML5", "Guns, Germs, and Steel", "A People History of the United States", "The History of the Ancient World", "Devil in the White City", "Salt, Fat, Acid, Heat", "On Food and Cooking", "Kitchen Confidential", "Mastering the Art of French Cooking", "Becoming", "Into the Wild", "Steve Jobs", "Unbroken", "Dale Carnegie", "Napoleon Hill", "Simon Sinek", "Stephen Covey", "Jon Duckett", "Jennifer Robbins", "Tracy Kidder", "Robin Nixon", "Jared Diamond", "Howard Zinn", "Susan Wise Bauer", "Erik Larson", "Samin Nosrat", "Harold McGee", "Anthony Bourdain", "Julia Child", "Michelle Obama", "Jon Krakauer", "Walter Isaacson", "Laura Hillenbrand"];

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("txt-searchedname"), books);
</script>

</body>
</html>