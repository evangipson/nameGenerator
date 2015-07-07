<!DOCTYPE HTML> 
<html lang=en>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- FONT:OPEN SANS -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:100,300,700,600,400' rel='stylesheet' type='text/css'>
<!-- FONT:AWESOME -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<!-- TITLE -->
<title> :evngpsn-#name </title>
<!-- FAVICON -->
<link rel="shortcut icon" href="favicon.ico" />
<!-- CSS SHEET -->
<link rel="stylesheet" type="text/css" href="name.css" >
<!-- INITIAL SESSION PHP -->
<?php 
// ingredients, functions, variables
require 'nameBrain.php';
/* uh ohhhhhh 
  if execution is an issue...
set_time_limit(0);
ignore_user_abort(1);*/
// we need to start the session
// in order to make sure the variables
// are there when we refresh.
if (!isset($_SESSION)) {
	/*if($seedChart!=0) {
		// don't forget to clean up
		// that chart nonsense as well
		$qry = "chart".$seedChart.".png";
		unlink($qry);
		// reset seedChart variable to
		// ensure new filename.
		$seedChart = (int)((rand(1,183927)*1.2-9*rand(1,3))*rand(8,12)*.1);
	}*/
	// start up that php session
	// for grabbing POST variables.
	session_start();
	$thePortable =  'this is session id from index.php: ' .session_id();
	// this function lives in <include>.php
	debug_to_console($thePortable);
}
?>
</head>           
<body>
	<?php if(!isset($_GET['created'])): ?>	
		<!-- IF $_GET===null -->
		<!-- MAIN MENU -->
		<div class="container">
			<h1>Name Generator</h1>
			<form class="form" action="name.php?created=1" method="post">
				<!-- <p>
					<label for="island"><small>base land masses (1-20) </small></label>
					<input type="text" name="island" id="island" value="4" /> 
				</p> -->
				<!-- <p>
					<label for="vision"><small>vision distance (2-max 5)</small></label>
					<input type="text" name="vision" id="vision" value="3" /> 
				</p> -->
				<label for="size"><small>noun selector</small></label>
				<select name="size">
					<?php
						$theClasses = array("person","place","thing");
						$i=0;
						$theSelected = rand(1,count($theClasses)-1);
						foreach($theClasses as $class) {
							if(++$i == $theSelected) {
								echo "<option value='".$class."' selected>".ucfirst($class)."</option>";
							}
							else {
								echo "<option value='".$class."'>".ucfirst($class)."</option>";
							}
						}
					?>
				</select> 
				<br />
				<input class="submit" style="color:#121212;" type="submit" value="Create" /> 
				<!-- <p style="padding-top:1em;"><i>Or would you rather <a href="cellular.php">generate a map?</a></i></p> -->
			</form>
		</div>
	<?php else: ?>
		<!-- IF $_GET!=null -->
		<?php if(isset($_GET['created'])): ?>
			<!-- IF $_GET['created'] -->
			<?php $_SESSION['theName']=generateName($_POST);
				$theString = '<h1>'.$_SESSION['theName'].'</h1>';
			?>
			<div class="container">
				<h1 style="letter-spacing:0.2em;text-transform:uppercase;font-size:0.8em">your generated name was</h1>
				<!-- the comment -->
				<?php echo $theString; ?>
				<form class="form" action="name.php?created=1" method="post">
					<select name="size" style="display:none"><option value="<?php echo $_POST['size'] ?>" selected><?php echo $_POST['size'] ?></option></select>
					<input class="submit" style="color:#121212;" type="submit" value="Create another <?php echo $_POST['size'] ?>" /> 
				</form>
				<!-- <p style="padding-top:1em;"><i>Or would you rather just <a href="chopped.php">generate a chopped basket?</a></i></p> -->

			</div>
		<?php endif; ?>
		<!-- STICKY GEAR -->
		<div class='stickyMenu shadow-1 animated bounceInLeft'><i class="fa fa-cog fa-2x"></i></div>
		<!-- STICKY PANEL OF DATA -->
		<div class='stickyPanel'>
			<!-- WORLD NAME -->
			<p class="list" style='width:100%;font-weight:300;text-align:center;padding: 0!important;padding-bottom:1em!important;padding-top: 2em!important;'>
				<?php 
					$nameArray = explode(" ",$_SESSION['theName']);
					if(count($nameArray)>1) {
						for($i=0;$i<count($nameArray);$i++) {
							if(($i+1)%2==0) {
								echo '<span style="font-weight:600">'.$nameArray[$i].'</span> ';
							}
							else {
								echo $nameArray[$i].' ';
							}
						}
					}
					else {
						echo '<span style="font-weight:600">'.$nameArray[0].'</span> ';
					}
				?>
			</p>
			<!-- HOW MANY CELLS ARE THERE?
			<p class="list">Cells</p> -->
			<?php 
				//$amount = $_SESSION['bigArray'][2]*$_SESSION['bigArray'][3];
			?>
			<!--<p class="data"><?php //echo $amount; ?></p> -->
			
			<!-- NAVIGATION/ACTION BUTTONS  (maybe later) 
			<form action="cellular.php?evolve=<?php //echo $theTempEvo; ?>" method="post">	
				<input class='submit' style="margin-top:1.3em;" type="submit" value="Evolve Map Data" name="mapdata"><br /> 
			</form> -->
			<form action="name.php" method="post">	
				<input class='submit refreshy' type="submit" value="Create New Name" name="mapdata"><br /> 
			</form>
			<form action="index.php" method="post">	
				<input class='submit homelink' style="margin-top:1em" type="submit" value="Back Home" name="homelink"><br /> 
			</form>
			<input class='submit closer' type="submit" value="Close" name="close"><br /> 
		</div>
		
	<?php endif; ?>
	<!-- <div class='loading'>Loading...</div> -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
	<!-- BASIC JQUERY FOR MENU -->
	<script type="text/javascript">
      $(document).ready(function(){
		//$('.square').addClass('animated fadeIn');
		$('.stickyMenu').show();
		$('.stickyMenu').click(function() {
			$('.stickyMenu').removeClass('bounceInLeft');
			$('.stickyMenu').addClass('animated bounceOutLeft');
			$('.stickyMenu').show();
			$('.stickyPanel').removeClass('bounceOutLeft');
			$('.stickyPanel').addClass('animated bounceInLeft');
			$('.stickyPanel').show();
		});
		$('.closer').click(function() {
			$('.stickyPanel').removeClass('bounceInLeft');
			$('.stickyPanel').addClass('animated bounceOutLeft');
			$('.stickyPanel').show();
			$('.stickyMenu').removeClass('bounceOutLeft');
			$('.stickyMenu').addClass('animated bounceInLeft');
			$('.stickyMenu').show();
		});
	});
	</script>
</body>
</html>
