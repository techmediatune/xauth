<?php if ($_POST['username'] == 'invader' && $_POST['password'] == 'zim'): ?>
<?php setcookie('test_cookie_approval', 'yes'); ?>
<html>
<script>
window.close();
</script>
</html>
<?php else: ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<body>
		<p>Enter invader/zim for username/password (if you want)</p>
		<form method="POST" action="test_cookie_approval_popup.php">
			<label>Username: <input name="username" /></label><br />
			<label>Password: <input type="password" name="password" /></label><br />
			<input type="submit" value="Login" />
		</form>
	</body>
</html>
<?php endif; ?>