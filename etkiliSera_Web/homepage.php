<!DOCTYPE html>
<html>
<head>
<style>

#data {
  margin: auto;
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 35%;
}

#data td, #data th {
  border: 1px solid grey;
  padding: 8px;
}

#data tr:hover {background-color: #ddd;}

#data tr{background-color: lightgrey;}

#data th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}

.gostergeler{
  width: 80%;
  margin: 0 auto;
  padding: 40px;
}

.footer{
  background-color: #292c2f;
  box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.12);
  box-sizing: border-box;
  width: 100%;
  text-align: left;
  font: bold 16px sans-serif;
 
  padding: 55px 50px 30px 100px;
}
 
.footer .footer-sol,
.footer .footer-orta,
.footer .footer-sag{
  display: inline-block;
  vertical-align: top;
}
 
.footer .footer-sol{
  width: 40%;
}
 
.footer h3{
  color:  #ffffff;
  font: normal 26px 'Cookie', cursive;
  margin: 0;
}
 
.footer .footer-linkler{
  color:#949798;
  margin: 20px 0 12px;
  padding: 0;
}
 
.footer .footer-linkler a{
  display:inline-block;
  line-height: 1.8;
  text-decoration: none;
  color:inherit;
}

.footer .footer-orta{
  width: 35%;
}
 
.footer .footer-orta p{
  color:#949798;
  text-decoration: none;
}
 
.footer .footer-right{
  width: 20%;
}

.footer .footer-ikonlar{
  margin-top: 25px;
}

#kare {
  margin: 20px auto;
  width: 500px;
  height: 375px;
}
#video {
  border: 10px #333 solid;
  width: 500px;
  height: 375px;
  background-color: #666;
}

</style>
</head>
<body>

<br>
<center><h2>Veriler</h2></center>
<table id="data">
  <tr>
    <th>Sensörler</th>
    <th>Sensör Değerleri</th>
  </tr>
  <tr>
    <td>Toprak Nem</td>
    <td id="demo" >NaN</td>
  </tr>
  <tr>
    <td>Su Seviyesi</td>
    <td id="demo1" >NaN</td>
  </tr>
  <tr>
    <td>Yağmur</td>
    <td id="demo2" >NaN</td>
  </tr>
    <tr>
    <td>Gaz</td>
    <td id="demo3" >NaN</td>
  </tr>
    <tr>
    <td>Sıcaklık</td>
    <td id="demo4" >NaN</td>
  </tr>
    <tr>
    <td>Nem</td>
    <td id="demo5" >NaN</td>
  </tr>
    <tr>
    <td>Isı</td>
    <td id="demo6" >NaN</td>
  </tr>
  <tr>
    <td>Işık</td>
    <td id="demo7" >NaN</td>
  </tr>    
</table>
<br>
<hr>

<center><h2>Göstergeler</h2></center>
<div class="gostergeler">
  <div id="gauge_div" style="float: left; margin-right: 50px;"></div>
  <div id="gauge_div1" style="float: left; margin-right: 50px;"></div>
  <div id="gauge_div8" style="float: left; margin-right: 50px;"></div>
  <div id="gauge_div3"></div>
</div>

<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>
<script type='text/javascript' src='https://www.google.com/jsapi'></script>
<script type='text/javascript'>

  var channel_id = 964325;
  var api_key = '7RFMQKO71ODPH70D';
  var max_gauge_value = 1023;
  var gauge_name = 'Toprak Nem';
  var gauge_name1 = 'Su Seviyesi';
  var gauge_name3 = 'Gaz Seviyesi';
  var gauge_name8 = 'Işık Değeri';


  var chart, data,chart1, data1, chart3, data3, chart8, data8;

  // load the google gauge visualization
  google.load('visualization', '1', {packages:['gauge']});
  google.setOnLoadCallback(initChart);

  // display the data
  function displayData(point, point1, point3, point8) {
    data.setValue(0, 0, gauge_name);
    data.setValue(0, 1, point);
    chart.draw(data, options);

    data1.setValue(0, 0, gauge_name1);
    data1.setValue(0, 1, point1);
    chart1.draw(data1, options1);

    data3.setValue(0, 0, gauge_name3);
    data3.setValue(0, 1, point3);
    chart3.draw(data3, options3);

    data8.setValue(0, 0, gauge_name8);
    data8.setValue(0, 1, point8);
    chart8.draw(data8, options8);
  }

  // load the data
  function loadData() {
    // variable for the data point
    var p;

    // get the data from thingspeak
    $.getJSON('https://api.thingspeak.com/channels/' + channel_id + '/feed/last.json?api_key=' + api_key, function(data) {

      // get the data point
      p = data.field1;
      p1 = data.field2;
      p2 = data.field3; //yagmur
      p3 = data.field4; //gaz
      p4 = data.field5; //sicaklik
      p5 = data.field6; //nem
      p6 = data.field7; //sicaklikDeger
      p7 = data.field8; //isik

      document.getElementById("demo").innerHTML = p;
      document.getElementById("demo1").innerHTML = p1;
      document.getElementById("demo2").innerHTML = p2;
      document.getElementById("demo3").innerHTML = p3;
      document.getElementById("demo4").innerHTML = p4;
      document.getElementById("demo5").innerHTML = p5;
      document.getElementById("demo6").innerHTML = p6;
      document.getElementById("demo7").innerHTML = p7;

      // if there is a data point display it
      if (p) {
        p = Math.round((p / max_gauge_value) * 100);
        p1 = Math.round((p1 / max_gauge_value) * 100);
        p3 = Math.round((p3 / max_gauge_value) * 100);
        p7 = Math.round((p7 / max_gauge_value) * 100);
        displayData(p,p1,p3,p7);
      }

    });
  }

  // initialize the chart
  function initChart() {

    data = new google.visualization.DataTable();
    data.addColumn('string', 'Label');
    data.addColumn('number', 'Value');
    data.addRows(1);

    data1 = new google.visualization.DataTable();
    data1.addColumn('string', 'Label');
    data1.addColumn('number', 'Value');
    data1.addRows(1);

    data3 = new google.visualization.DataTable();
    data3.addColumn('string', 'Label');
    data3.addColumn('number', 'Value');
    data3.addRows(1);
    
    data8 = new google.visualization.DataTable();
    data8.addColumn('string', 'Label');
    data8.addColumn('number', 'Value');
    data8.addRows(1);

    chart = new google.visualization.Gauge(document.getElementById('gauge_div'));
    options = {width: 200, height: 200, redFrom: 90, redTo: 100, yellowFrom:75, yellowTo: 90, minorTicks: 5};

    chart1 = new google.visualization.Gauge(document.getElementById('gauge_div1'));
    options1 = {width: 200, height: 200, redFrom: 90, redTo: 100, yellowFrom:75, yellowTo: 90, minorTicks: 5};

    chart3 = new google.visualization.Gauge(document.getElementById('gauge_div3'));
    options3 = {width: 200, height: 200, redFrom: 90, redTo: 100, yellowFrom:75, yellowTo: 90, minorTicks: 5};

    chart8 = new google.visualization.Gauge(document.getElementById('gauge_div8'));
    options8 = {width: 200, height: 200, redFrom: 90, redTo: 100, yellowFrom:75, yellowTo: 90, minorTicks: 5};

    loadData();

    // load new data every 15 seconds
    setInterval('loadData()', 15000);
  }

</script>
<br>
<hr>

<center><h2>Kamera Görüntüsü</h2></center>
<div id="kare">
  <video autoplay="true" id="video"></video>
</div>
<script>
var video = document.querySelector("#video");

if (navigator.mediaDevices.getUserMedia) {
  navigator.mediaDevices.getUserMedia({ video: true })
    .then(function (stream) {
      video.srcObject = stream;
    })
    .catch(function (error) {
      console.log("HATA!!!");
    });
}

function dur(e) {
  var akim = video.srcObject;
  var izle = akim.getTracks();

  for (var i = 0; i < izle.length; i++) {
    var track = izle[i];
    track.dur();
  }
  video.srcObject = null;
}
</script>

<center><h1><a href="http://192.168.1.8/">asd</a></h1></center>

<br>

<footer class="footer">

    <div class="footer-sol">
    <h3>Sayfalar</h3>
    <p class="footer-linkler">
      <a href="index.php">Anasayfa</a><br />
      <a href="index.php?sayfa=seralar">Seralar</a><br />
      <a href="index.php?sayfa=mail">İletişim</a><br />
    </p>
    </div>
 
    <div class="footer-orta">
      <h3>İletişim</h3>
      <p>Yusuf Ulaş Dağ</p>
      <p>Ramazan Furkan Çınar</p>
      <p>Kocaeli, Türkiye</p>
      <p>0553 760 4147</p>
      <p>yusufulasd@gmail.com</p>
    </div>
 
    <div class="footer-sag">
        <h3>Etkili Sera</h3>
        <p style="color:grey;">Bitkileriniz için temel ihtiyaçları<br> otomatik karşılayın <br>
        ve değerleri kontrol edin.</p>
    </div>

  <hr>

    <p style="color: white;">&copy; 2020, tüm hakları saklıdır. </p>
</footer>

</body>
</html>


   





