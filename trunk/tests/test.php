<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<script type="text/javascript" charset="utf-8">
			var l = window.name;
			<?php if ($_POST['done']): ?>
				window.name = "true,sometoken";
				window.location = l;
			<?php endif; ?>
		</script>
	</head>
	<body>
		<form method="POST" action="test.php">
			<input type="submit" name="next" value="Next">
			<input type="submit" name="done" value="Done">
		</form>
	</body>
</html>