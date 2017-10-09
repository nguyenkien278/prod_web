<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>jmango360.com -  Signature Generator</title>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	
	<!-- Latest compiled and minified JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	
</head>
<body>


<div class="container">
	<div class="page-header">
  <h1>Email signature generator</h1>
</div>

<div class="row">

	<div class="col-md-4">
	
	<form role="form" action="" method="post">
		<div class="form-group">
			<label>Name:</label>
			<input type="text" name="name" class="form-control" />
		</div>
		<div class="form-group">
			<label>Function:</label>
			<input type="text" name="function" class="form-control" />
		</div>
		<div class="form-group">
			<label>Email:</label>
			<input type="email" name="mail" class="form-control" />
		</div>
		<div class="form-group">
			<label>Mobile:</label>
			<input type="text" name="mobile" class="form-control" />
		</div>
		<div class="form-group">
			<label>Phone:</label>
			<input type="text" name="phone" class="form-control" />
		</div>
		<div class="form-group">
			<label>Skype:</label>
			<input type="text" name="skype" class="form-control" />
		</div>
		<div class="form-group">
			<label>Website:</label>
			<input type="text" name="site" class="form-control" />
		</div>
		<div class="form-group">
			<input type="submit" value="Generate" class="btn btn-primary" />
		</div>
		
	</form>
		
	</div>
	
	<div class="col-md-8">
	<h2>Code:</h2>
	<pre class="pre-scrollable">
		<?php
		
		function sanitize_output($buffer) {
		
		    $search = array(
		        '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
		        '/[^\S ]+\</s',  // strip whitespaces before tags, except space
		        '/(\s)+/s'       // shorten multiple whitespace sequences
		    );
		
		    $replace = array(
		        '>',
		        '<',
		        '\\1'
		    );
		
		    $buffer = preg_replace($search, $replace, $buffer);
		
		    return $buffer;
		}
		

			if(isset($_POST)) {
				$template = file_get_contents('signature.html');
				$template = sanitize_output($template);
				
				foreach($_POST as $name => $val) {
					switch ($name) {
						case 'name':
							$template = str_replace('%NAME%', $val, $template);
						break;
						
						case 'function':
							$template = str_replace('%FUNCTION%', $val, $template);
						break;
						
						case 'mail':
							$template = str_replace('%MAIL%', $val, $template);
						break;
						
						case 'mobile':
							$template = str_replace('%MOBILE%', $val, $template);
						break;
						
						case 'phone':
							$template = str_replace('%PHONE%', $val, $template);
						break;
						
						case 'skype':
							$template = str_replace('%SKYPE%', $val, $template);
						break;
						
						case 'site':
							$template = str_replace('%WEBSITE%', $val, $template);
						break;
					}
				}
				
				echo htmlentities($template);				
			}

		?>		
	</pre>

	</div>
	
	
</div>

<?php
if(isset($template)) {
?>
<div class="row">
<div class="col-md-12">
	<h2>Example:</h2>
	<?php
		echo $template;
	?>
</div>
</div>
<?php
}
?>

</div>




	
</body>
</html>