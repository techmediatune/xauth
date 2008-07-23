<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<body>
		<script type="text/javascript" charset="utf-8">
			<?php if ($_POST['done']): ?>
				var l = window.name;
				window.name = "1sometoken";
				window.location = l;
			<?php endif; ?>
		</script>
		<form method="POST" action="test.php">
			<input type="submit" name="next" value="Next">
			<input type="submit" name="done" value="Done">
		</form>
	</body>
</html>