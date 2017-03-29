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
            <li><?php echo "<a href='Part01_ArtistDataList.php'>Artists Data List (Part 1)</a>"; ?></li>
            <li class="active"><?php echo "<a href='Part02_SingleArtist.php?id=19'>Single Artist (Part 2)</a>"; ?></li>
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

<?php
	$db1 = new mysqli('localhost','root','','art');
	if ($db1->connect_error) {
        die("Connection failed: " . $db1->connect_error);
    } 
	$sql1 = "SELECT * FROM ARTISTS WHERE ARTISTID=" .$_GET['id'];
	try{
	$result1 = $db1->query($sql1);
	$artist = $result1->fetch_assoc();
/*Redirecting to Error page if no results are fetched*/
  if(!$artist) {
    header('Location: error.php');
  }
	}
	catch(Exception $e) {
		echo "Message:" .$e->getMessage();
	}
?>

<!-- This container displays Artist Image and Details -->
<div class="container welcome">
	<div class="row">
		<h3 class="container"><?php echo utf8_encode($artist['FirstName']). " " .utf8_encode($artist['LastName']); ?></h3>
		<div class="col-xs-3 container">
		<a href="#">
      <?php echo "<img src='images/art/artists/medium/".$artist['ArtistID'].".jpg' alt='ARTIST' height='300px' width='235px' class='thumbnail'>"; ?>
		</a>
		</div>
		<div class="col-xs-6 container">
			<div class="small">
				<p>
          <?php 
          $data = utf8_encode($artist['Details']);
          echo $data; ?>    
        </p>
        <button type="submit" class="btn btn-default text-primary favorite-button gap">
        <span class="glyphicon glyphicon-heart input-md text-primary" aria-hidden="true"></span><span class="text-primary">Add to Favorites List</span>
        </button><br>
        <table class="table gap table-details">
          <thead>
          <tr>
            <td colspan="2" class="row-color">Artist Details</td>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>Date:</td>
            <td> <?php echo " ".$artist['YearOfBirth']. "-" .$artist['YearOfDeath']; ?></td>
          </tr>
          <tr>
            <td>Nationality:</td>
            <td><?php echo $artist['Nationality']; ?></td>
          </tr>
          <tr>
            <td>More Info:</td>
            <td><?php echo "<a href='".$artist['ArtistLink']."'>".$artist['ArtistLink']."</a>"; ?></td>
          </tr>
          </tbody>
        </table>
			</div>
		</div>
	</div>
</div>

<?php
  $db2 = new mysqli('localhost','root','','art');
  if ($db2->connect_error) {
        die("Connection failed: " . $db2->connect_error);
    } 
  $sql2 = "SELECT * FROM ARTWORKS WHERE ARTISTID = ".$_GET['id'];  
  try{
  $result2 = $db2->query($sql2);
  }
  catch(Exception $e) {
    echo "Message:" .$e->getMessage();
  }
?>

<!-- This container displays all the Artworks of an Artist as panels, linking to the ArtWorks page -->
<div class="container">
  <h4>Art by <?php echo utf8_encode($artist['FirstName']). " " .utf8_encode($artist['LastName']) ?></h4>
  <div class="row">
   <?php
   while($works = mysqli_fetch_array($result2)) {
        echo "<div class='col-xs-3 clearfix visible-*-block'>
              <div class='panel panel-default'>
              <div class='panel-body div-position'>
              <div class='container'>
                <div class='container'>
                  <a href='Part03_SingleWork.php?id=".$works['ArtWorkID']."'><img src='images/art/works/square-medium/".$works['ImageFileName'].".jpg' alt='Painting' height='150px' width='150px' class='thumbnail'></a>
                </div>
                <div class='container'>
                <p class='text-primary small'>
                  <a href='Part03_SingleWork.php?id=".$works['ArtWorkID']."'>".utf8_encode($works['Title']).", ".$works['YearOfWork']."</a>
                </p>
                </div>
                <div class='container gap'>
                  <a href='Part03_SingleWork.php?id=".$works['ArtWorkID']."'><button class='btn btn-primary btn-xs'>
                  <span class='glyphicon glyphicon-info-sign input-xs' aria-hidden='true'>View</span>
                  </button></a>
                  <button class='btn btn-success btn-xs'>
                  <span class='glyphicon glyphicon-gift input-xs' aria-hidden='true'>Wish</span>
                  </button>
                  <button class='btn btn-info btn-xs'>
                  <span class='glyphicon glyphicon-shopping-cart input-xs' aria-hidden='true'>Cart</span>
                  </button>
                </div>
              </div>
              </div>
              </div>
        </div>";
   }
  ?>
  </div>
</div>

<?php 
$result1->close();
$db1->close();
$result2->close();
$db2->close();
?>

</body>
</html>