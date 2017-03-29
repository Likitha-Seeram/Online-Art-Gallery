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
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">

	<link rel="stylesheet" type="text/css" href="art.css">

<!-- Script to open a modal on click of an image -->
<script>
$(document).ready(function() {
	$("#enlarge").on("click", function() {
   		$('#imagepreview').attr('src', $('#imageresource').attr('src')); 
   		$('#imagemodal').modal('show'); 
	});
});
</script>

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
            <li><?php echo "<a href='Part02_SingleArtist.php?id=19'>Single Artist (Part 2)</a>"; ?></li>
            <li class="active"><?php echo "<a href='Part03_SingleWork.php?id=394'>Single Work (Part 3)</a>"; ?></li>
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
	$db = new mysqli('localhost','root','','art');
	if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    } 
	$sql1 = "SELECT * FROM ARTWORKS WHERE ARTWORKID=" .$_GET['id'];
	$sql2= "SELECT * FROM ARTISTS AS A, ARTWORKS AS B WHERE A.ARTISTID=B.ARTISTID AND B.ARTWORKID=" .$_GET['id'];
	$sql3 = "SELECT * FROM ARTWORKS INNER JOIN ARTWORKGENRES ON ARTWORKS.ArtWorkID=ARTWORKGENRES.ArtWorkID INNER JOIN GENRES ON ARTWORKGENRES.GenreID=GENRES.GenreID AND ARTWORKS.ArtWorkID=" .$_GET['id'];
	$sql4 = "SELECT * FROM ARTWORKS INNER JOIN ARTWORKSUBJECTS ON ARTWORKS.ArtWorkID=ARTWORKSUBJECTS.ArtWorkID INNER JOIN SUBJECTS ON ARTWORKSUBJECTS.SubjectID=SUBJECTS.SubjectID AND ARTWORKS.ArtWorkID=" .$_GET['id'];
	$sql5 = "SELECT * FROM ARTWORKS INNER JOIN ORDERDETAILS ON ARTWORKS.ArtWorkID=ORDERDETAILS.ArtWorkID INNER JOIN ORDERS ON ORDERDETAILS.OrderID=ORDERS.OrderID and ARTWORKS.ArtWorkID=" .$_GET['id'];
	try{
	$result1 = $db->query($sql1);
	$result2 = $db->query($sql2);
	$result3 = $db->query($sql3);
	$result4 = $db->query($sql4);
	$result5 = $db->query($sql5);
	$painting = $result1->fetch_assoc();
/*Redirecting to Error page if no results are fetched*/
  if(!$painting) {
    header('Location: error.php');
  }
	$info = $result2->fetch_assoc();	
  if(!$info) {
    header('Location: error.php');
  }
  }
	catch(Exception $e) {
		echo "Message:" .$e->getMessage();
	}
?>

<!-- This container displays Artwork Image and Details -->
<div class="container welcome">
<h3><?php echo utf8_encode($painting['Title']); ?>
	<br><h5>By <span><?php echo "<a href='Part02_SingleArtist.php?id=".$info['ArtistID']."'>".utf8_encode($info['FirstName'])." ".utf8_encode($info['LastName'])."</a>"; ?></h5></span>
</h3><br>
<div class="row">
	<div class="container col-xs-4 clearfix visible-*-block">
	<a href="#" id="enlarge">
		<?php echo "<img src='images/art/works/medium/".$painting['ImageFileName'].".jpg' alt='ARTWORK' height='400px' width='335px' class='thumbnail' id='imageresource'>"; ?>
	</a>
		<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  			<div class="modal-dialog">
    			<div class="modal-content">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        				<h4 class="modal-title" id="myModalLabel"><?php echo utf8_encode($painting['Title'])." (".$painting['YearOfWork'].") by ".utf8_encode($info['FirstName'])." ".utf8_encode($info['LastName']); ?></h4>
      				</div>
      				<div class="modal-body">
        			<img src="" id="imagepreview" style="width: 350px; height: 450px;" >
      				</div>
      				<div class="modal-footer">
        			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      				</div>
    			</div>
  			</div>
		</div>

	</div>
	<div class="container col-xs-5 clearfix visible-*-block">
		<p class="small">
    <?php 
    $data = utf8_encode($painting['Description']);
    echo $data; ?></p>
		<h4 class="red"><?php echo "$".number_format((float)$painting['Cost'], 2, '.', ''); ?></h4>
		<div class="btn-group">
			<button class="btn btn-default"><span class="glyphicon glyphicon-gift input-md text-primary" aria-hidden="true"></span><span class="text-primary">Add to Wish List</span>
			</button>
			<button class="btn btn-default text-primary"><span class="glyphicon glyphicon-shopping-cart input-md text-primary" aria-hidden="true"></span><span class="text-primary">Add to Shopping Cart</span>
			</button>
		</div>
		<table class="table gap table-details">
          <thead>
          <tr>
            <td colspan="2" class="row-color">Product Details</td>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>Date:</td>
            <td> <?php echo $painting['YearOfWork']; ?></td>
          </tr>
          <tr>
            <td>Medium:</td>
            <td><?php echo $painting['Medium']; ?></td>
          </tr>
          <tr>
            <td>Dimensions:</td>
            <td><?php echo $painting['Width']."cm X ".$painting['Height']."cm"; ?></td>
          </tr>
          <tr>
            <td>Home:</td>
            <td><?php echo utf8_encode($painting['OriginalHome']); ?></td>
          </tr>
          <tr>
            <td>Genres:</td>
            <td><?php 
            while ($genre = mysqli_fetch_array($result3)) {
            		echo "<a href=''>".$genre['GenreName']."</a><br>";
            	}	
            ?></td>
          </tr>
          <tr>
            <td>Subjects:</td>
            <td><?php 
            while ($subject = mysqli_fetch_array($result4)) {
            		echo "<a href=''>".$subject['SubjectName']."</a><br>";
            	}	
            ?></td>
          </tr>
          </tbody>
        </table>
	</div>
	<div class="container col-xs-2 col-xs-offset-1 clearfix visible-*-block">
		<table class="table-style table-width">
          <thead>
          <tr>
            <td class="bg-info text-primary container">Sales</td>
          </tr>
          </thead>
          <tbody>
          <tr>
          <td class="container">
          <?php
          $sale = mysqli_fetch_array($result5);
          if(isset($sale)) {
          while ($sale = mysqli_fetch_array($result5)) {
          	$dateTime = $sale['DateCompleted'];
          	$date = explode(" ", $dateTime);
          	$format_date = date('m/d/Y',strtotime($date[0]));
          	echo "<p><a href=''>".$format_date."</a></p>";
          	}
          }
          else {
          	echo "No Sales";
          }
          ?>
          </td>
          </tr>
          </tbody>
          </table>
	</div>	
</div>
</div>

<?php 
$result1->close();
$result2->close();
$result3->close();
$result4->close();
$result5->close();
$db->close();
?>

</body>
</html>