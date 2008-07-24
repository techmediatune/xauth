<?php
session_start();
$referrer = parse_url($_SERVER['HTTP_REFERER']);
if ($referrer['host'] != $_SERVER['HTTP_HOST']) $_SESSION['referrer'] = $referrer['host'];
?>
<?php if ($_COOKIE['test_cookie_approval'] == 'yes' && $_SESSION['authorized'] && $_SESSION['authorized'][$_SESSION['referrer']]): ?>
<html>
<script>
var redirect = window.name;
window.name = "automatic";
window.location = redirect + "#xauth=1";
</script>
</html>
<?php elseif ($_COOKIE['test_cookie_approval'] == 'yes' && $_POST['authorize']): ?>
<?php $_SESSION['authorized'][$_SESSION['referrer']] = true; ?>
<html>
<script>
var redirect = window.name;
window.name = "approved";
window.location = redirect + "#xauth=1";
</script>
</html>
<?php elseif ($_COOKIE['test_cookie_approval'] == 'yes'): ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<body>
		<form method="POST" action="test_cookie_approval.php">
			<p>Authorize?</p>
			<input type="submit" name="authorize" value="Yes">
			<input type="submit" name="deny" value="No">
		</form>
	</body>
</html>
<?php else: ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<body>
		<p>Log in <a href="test_cookie_approval_popup.php" target="_new">here</a> and then click "Continue".</p>
		<form method="POST" action="test_cookie_approval.php">
			<input type="submit" name="continue" value="Continue" />
		</form>
	</body>
</html>
<?php endif; ?>