<?php

require_once 'generator.php';

if (!empty($_POST)) {
	
	BukkitPluginGenerator::start();
	BukkitPluginGenerator::checkInput($_POST);
	if (empty(BukkitPluginGenerator::$error)) {
		BukkitPluginGenerator::setPresets();
		BukkitPluginGenerator::generate();
	}
}
?>

<!DOCTYPE html>
<html lang="en-US">
	<head>
			<meta charset="utf-8">
			<title>Bukkit-Plugin Skeleton</title>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link rel="stylesheet" href="css/bootstrap.css">
			<link rel="stylesheet" href="css/bootstrap-responsive.css">
			<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
			<!--[if lt IE 9]>
				<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<![endif]-->
	</head>
	
	<body>

		<!-- Content =======================-->
		<div class="container">
			
			<h1>Bukkit-Plugin Skeleton Maker</h1>
			<?php if (!BukkitPluginGenerator::$gen) {?>
			<form class="form-horizontal well" action="index.php" method="POST">
				<div class="control-group">
					<label class="control-label">Plugin-Name</label>
					<div class="controls">
						<input type="text" name="name" placeholder="AwesomePluginName">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Package</label>
					<div class="controls">
						<input type="text" name="package" placeholder="me.author.plugins">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Author</label>
					<div class="controls">
						<input type="text" name="author" placeholder="Your Name">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Version</label>
					<div class="controls">
						<input type="text" name="version" value="1.0">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Database</label>
					<div class="controls">
						<input type="checkbox" name="database" id="id_database" /> (Does your plugin will need a database?)
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Startup</label>
					<div class="controls">
						<select name="startup" id="id_startup">
							<option value="startup">At server startup</option>
							<option value="postworld" selected="selected">After the default worlds are created </option>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">MainClass</label>
					<div class="controls">
						<input type="text" name="class" placeholder="Main">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Description</label>
					<div class="controls">
						<input type="text" name="description" placeholder="Short Description of your plugin...">
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn">Generate Skeleton</button>
					</div>
				</div>
			</form>
		<?php } else { ?>
			
			<div class="well">
				<h1>Thank you for using the Bukkit-Plugin Skeleton Generator</h1>
				<p>This generator created the following files and directorys for you:</p>
				<pre>
/{authorname}
 /src
  /main
   /java
    /{packagename first part}
     /{packagename second part}
      {...}
       /{mainclassname}.java
   /resources
    -plugin.yml
				</pre>
				
				<a href="<?php echo BukkitPluginGenerator::$name ?>"><button class="btn">Download!</button></a> - <a href="index.php"><button class="btn">Create a new one</button></a>
				
			</div>
		
		<?php } ?>
		</div><!-- /.container -->
		
		
		
		
		<!-- Javascript stuff =======================-->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="js/bootstrap-affix.js"></script>
		<script src="js/bootstrap-alert.js"></script>
		<script src="js/bootstrap-button.js"></script>
		<script src="js/bootstrap-carousel.js"></script>
		<script src="js/bootstrap-collapse.js"></script>
		<script src="js/bootstrap-dropdown.js"></script>
		<script src="js/bootstrap-modal.js"></script>
		<script src="js/bootstrap-popover.js"></script>
		<script src="js/bootstrap-scrollspy.js"></script>
		<script src="js/bootstrap-tab.js"></script>
		<script src="js/bootstrap-tooltip.js"></script>
		<script src="js/bootstrap-transition.js"></script>
		<script src="js/bootstrap-typeahead.js"></script>
		<!-- JS stuff END =======================-->
	</body>
	
</html>

