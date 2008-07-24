<?php
session_start();
$referrer = parse_url($_SERVER['HTTP_REFERER']);
if ($referrer['host'] != $_SERVER['HTTP_HOST']) $_SESSION['referrer'] = $referrer['host'];
?>
<?php if ($_COOKIE['test_full_login'] == 'yes' && $_SESSION['authorized'] && $_SESSION['authorized'][$_SESSION['referrer']]): ?>
<html>
<script>
var redirect = window.name;
window.name = "automatic";
window.location = redirect + "#xauth=1";
</script>
</html>
<?php elseif ($_COOKIE['test_full_login'] == 'yes' && $_POST['authorize']): ?>
<?php $_SESSION['authorized'][$_SESSION['referrer']] = true; ?>
<html>
<script>
var redirect = window.name;
window.name = "authorized";
window.location = redirect + "#xauth=1";
</script>
</html>
<?php elseif ($_COOKIE['test_full_login'] == 'yes' && $_POST['deny']): ?>
<?php $_COOKIE['test_full_login'] = ''; ?>
<html>
<script>
var redirect = window.name;
window.name = "";
window.location = redirect + "#xauth=0";
</script>
</html>
<?php elseif ($_COOKIE['test_full_login'] == 'yes'): ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<body>
		<form method="POST" action="test_full_login.php">
			<p>Authorize?</p>
			<input type="submit" name="authorize" value="Yes">
			<input type="submit" name="deny" value="No">
		</form>
	</body>
</html>
<?php elseif ($_POST['username'] == 'invader' && $_POST['password'] == 'zim'): ?>
<?php setcookie('test_full_login', 'yes'); ?>
<?php $_SESSION['authorized'][$_SESSION['referrer']] = true; ?>
<html>
<script>
var redirect = window.name;
window.name = "login";
window.location = redirect + "#xauth=1";
</script>
</html>
<?php else: ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<body>
		<p>Enter invader/zim for username/password (if you want)</p>
		<form method="POST" action="test_full_login.php">
			<label>Username: <input name="username" /></label><br />
			<label>Password: <input type="password" name="password" /></label><br />
			<input type="submit" value="Login" />
		</form>
	</body>
</html>
<?php endif; ?>