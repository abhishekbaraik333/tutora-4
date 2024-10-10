<!DOCTYPE html>
<html lang="pt-BR">
<head>
<link rel="icon" href="../images/marriage.png"
type="image" sizes="16x16">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Login</title>
</head>
<body>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap');

body {
  margin: 0;
  font-family: 'Noto Sans', sans-serif;
}

body * {
  box-sizing: border-box;
}

.main-login {
  width: 100vw;
  height: 100vh;
  background: #F91974;
  display: flex;
  justify-content: center;
  align-items: center;
}

.left-login {
  width: 50vw;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}



.left-login-image {
  width: 35vw;
  border-radius: 15px; /* Curved corners */
  margin-bottom: 20px; /* Space between image and login form */
}

.right-login {
  width: 50vw;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

.card-login {
  width: 60%;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  padding: 30px 35px;
  background: #01013f;
  border-radius: 20px;
  box-shadow: 0px 10px 40px #00000056;
}

.card-login > h1 {
  color: white;
  font-weight: 800;
  margin: 0;
}

.textfield {
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: center;
  margin: 10px 0px;
}

.textfield > input {
  width: 100%;
  border: none;
  border-radius: 10px;
  padding: 15px;
  background: white;
  color: black;
  font-size: 12pt;
  box-shadow: 0px 10px 40px #2C2C2A;
  outline: none;
  box-sizing: border-box;
}

.textfield > label {
  color: white;
  margin-bottom: 10px;
}

.textfield > input::placeholder {
  color: black;
}

.btn-login {
  width: 40%;
  padding: 16px 0;
  margin: 25px;
  border: none;
  border-radius: 8px;
  outline: none;
  text-transform: uppercase;
  font-weight: 800;
  letter-spacing: 3px;
  color: black;
  background: #02D4D4;
  cursor: pointer;
  box-shadow: 0px 10px 40px -12px #302F2D;
}

@media only screen and (max-width: 950px){
  .card-login{
    width: 85%;
  }
}

@media only screen and (max-width: 600px){
  .main-login{
    flex-direction: column;
  }

  .left-login > h1 {
    display: none;
  }

  .left-login {
    width: 100%;
    height: auto;
  }

  .right-login {
    width: 100%;
    height: auto;
  }

  .left-login-image {
    width: 40vh;
    border-radius: 15px; /* Curved corners */
  margin-bottom: 20px; /* Space between image and login form */
  }

  .card-login {
    width: 90%;
  }
}
</style>
<form action="login_process.php" method="post">
  <div class="main-login">
    <div class="left-login">
      
      <img src="Tutora/logo/logo fond blanc.png" class="left-login-image" alt="">
    </div>
    <div class="right-login">
      <div class="card-login">
        <h1>Se connecter</h1>
        <div class="textfield">
          <label for="username_email">Email </label>
          <input type="text" name="username_email" id="username_email" required>
        </div>
        <div class="textfield">
          <label for="password">Mot de Passe</label>
          <input type="password" name="password" id="password" >
        </div>
        <button class="btn-login" type="submit" >Se connecter</button>
      </div>
    </div>
  </div>
</form>

</body>
</html>

