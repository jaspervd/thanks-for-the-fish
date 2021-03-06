<!DOCTYPE html>
<html>
<head>
  <base href="<?php echo $basePath; ?>/">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Login | Admin</title>
  <link rel="stylesheet" href="css/style_admin.css">
</head>
<body>
  <div class="cms-container">
    <div class="logo">&nbsp;</div>
    <section class="admin-login">
      <header>
        <h1>Admin Login</h1>
      </header>
      <form class="login-form">
        <p>
          <label for="admin-login">Gebruikersnaam of E-mail</label>
          <input type="text" name="entry" id="admin-login" required />
        </p>
        <p>
          <label for="admin-password">Wachtwoord</label>
          <input type="password" name="password" id="admin-password" required />
        </p>
        <p>
          <input type="submit" name="submit" value="Inloggen" />
        </p>
      </form>
    </section>
  </div>
  <script>
  window.app = window.app || {};
  window.app.basename = '<?php echo $basePath;?>';
  </script>
  <script src="js/adminLogin.js"></script>
</body>
</html>
