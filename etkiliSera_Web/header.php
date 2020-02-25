<!DOCTYPE html>
<html>
<head>
<style>
* {
  box-sizing: border-box;
}
body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
  background-color: rgb(141,203,255);
  font-family: cursive;
}

.header {
  padding: 30px;
  text-align: center;
  background: #00c000;
  color: white;
}

.header h1 {
  font-size: 40px;
}

.menu ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

.menu li {
  float: left;
}

.menu li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.menu li a:hover {
  background-color: #111;
}
</style>
</head>
<body>
<div class="header">
  <h1>Etkili Sera</h1>
</div>
<div class="menu">
	<ul>
	  <li><a href="index.php">Anasayfa</a></li>
	  <li><a href="index.php?sayfa=seralar">Seralar</a></li>
	  <li><a href="index.php?sayfa=mail">İletişim</a></li>
	</ul>
</div>

</body>
</html>
