<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="assets/css/alertify.min.css" type='text/css' />
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<script src="assets/js/alertify.min.js"></script>
</head>
<body>
<?php
	session_start();
	session_destroy();
	?>
	<script language="JavaScript">
		alertify.alert("Terima Kasih", function(){ window.location.assign('index'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	</script>
	<?php
?>
</body>
</html>
