<!-- 
    Student Name: Seeram Likitha
    Project Name: Project 3
    Due Date: 20 Nov 2016
-->

<?php
$owner = "Likitha Seeram";
/*Form to display the Search on Navigation bar*/
function getForm() {
	return "<form class='nav navbar-form navbar-right' method='post'>
        <div class='form-group'>
          <input type='text' class='form-control' placeholder='Search Paintings' name='title'>
        </div>
        <button type='submit' class='btn btn-primary' name='submit'>Search</button>
       </form>";
	}
/*To navigate  to search Page upon clicking search button on navigation bar*/
if(isset($_POST['submit'])) {
	$name = $_POST['title'];
	if($name) {
		header('Location: Part04_Search.php?title='.$name);
	}
	else {
		header('Location: Part04_Search.php');
	}
}
?>

<!DOCTYPE HTML>

<html>
<head>
	<title>CSE5335 - Assignment3</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="art.css">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
     <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Project 3</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li>
        <?php echo "<a href='default.php'>Home <span class='sr-only'></span></a>"; ?>
        </li>
        <li><a href="about.php">About Us</a></li>
        <li class="dropdown">
          <a href="" class="dropdown-toggle" data-toggle="dropdown">Pages <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class="active"><?php echo "<a href='Part01_ArtistDataList.php'>Artists Data List (Part 1)</a>"; ?></li>
            <li><?php echo "<a href='Part02_SingleArtist.php?id=19'>Single Artist (Part 2)</a>"; ?></li>
            <li><?php echo "<a href='Part03_SingleWork.php?id=394'>Single Work (Part 3)</a>"; ?></li>
            <li><?php echo "<a href='Part04_Search.php'>Search (Part 4)</a>"; ?></li>
          </ul>
        </li>
       </ul>  

       <?php echo getForm(); ?>

       <div class="nav navbar-form navbar-right">
 	   	<span class="text-muted name"><?php echo $owner; ?></span>
 	   </div>
    </div>
   </div> 
</nav>

<!-- This div is liked to display lsut of artists as hyperlinks to Artist pages -->
<div class="container">
<h1 id="heading">Artists DataList (Part 1)</h1>
<hr>

<?php
	$db = new mysqli('localhost','root','','art');
	if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    } 
	$sql = "SELECT * FROM ARTISTS ORDER BY LASTNAME";
	try{
	$result = $db->query($sql);
	/*print_r($result);
	echo "Number of rows" .$result->num_rows;*/
	}
	catch(Exception $e) {
		echo "Message:" .$e->getMessage();
	}
?>

<div>
	<?php
	try {
	while ($row = $result->fetch_assoc()) {
		echo "<span>";
		echo "<a href='Part02_SingleArtist.php?id=".$row['ArtistID']."'>";
		echo utf8_encode($row['FirstName']). " " .utf8_encode($row['LastName']);
		echo "(" . $row['YearOfBirth'] . "-" . $row['YearOfDeath'] . ")";
		echo "</span><br></li>";
	}
	}
	catch(Exception $ex) {
		throw $ex;
	}
	?>
</div>
</div>

<?php 
$result->close();
$db->close();
?>

</body>
</html>