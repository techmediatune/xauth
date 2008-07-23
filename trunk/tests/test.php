<?php
session_start();
$referrer = parse_url($_SERVER['HTTP_REFERER']);
if (!$_SESSION['referrer']) $_SESSION['referrer'] = $referrer['host'];
?>
<?php if ($_COOKIE['token'] == 'yes' && $_SESSION['authorized'] && $_SESSION['authorized'][$_SESSION['referrer']]): ?>
<html>
<script>
var l = window.name;
window.name = "1automatic";
window.location = l;
</script>
</html>
<?php elseif ($_COOKIE['token'] == 'yes' && $_POST['authorize']): ?>
<?php $_SESSION['authorized'][$_SESSION['referrer']] = true; ?>
<html>
<script>
var l = window.name;
window.name = "1authorized";
window.location = l;
</script>
</html>
<?php elseif ($_COOKIE['token'] == 'yes' && $_POST['deny']): ?>
<?php $_COOKIE['token'] = ''; ?>
<html>
<script>
var l = window.name;
window.name = "0";
window.location = l;
</script>
</html>
<?php elseif ($_COOKIE['token'] == 'yes'): ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<body>
		<form method="POST" action="test.php">
			<p>Authorize?</p>
			<input type="submit" name="authorize" value="Yes">
			<input type="submit" name="deny" value="No">
		</form>
	</body>
</html>
<?php elseif ($_POST['username'] == 'invader' && $_POST['password'] == 'zim'): ?>
<?php setcookie('token', 'yes'); ?>
<?php $_SESSION['authorized'][$_SESSION['referrer']] = true; ?>
<html>
<script>
var l = window.name;
window.name = "1login";
window.location = l;
</script>
</html>
<?php else: ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<body>
		<p>Enter invader/zim for username/password (if you want)</p>
		<form method="POST" action="test.php">
			<label>Username: <input name="username" /></label><br />
			<label>Password: <input type="password" name="password" /></label><br />
			<input type="submit" value="Login" />
		</form>
	</body>
</html>
<?php endif; ?>