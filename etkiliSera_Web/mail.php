<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="tasarim.css">
  <style type="text/css">
  
  .email{
    margin-left: 40px;
  }
  
  </style>
</head>
<body>

  <div class="email">
    <h2>Mail Gönderme</h2>
      <form action="https://formspree.io/xjvkwbba" method="POST" target="_blank">
        <label>
            Adınız: <br>
            <input type="text" name="ad" required>
        </label>  
        <br>
        <label>
          Soyadınız: <br>
          <input type="text" name="soyad" required>
        </label>
        <br>
        <label>
          Telefon Numaranız: <br>
          <input type="text" name="telefon numarası" required="">
        </label>
        <br>
        <label>
          Email Adresiniz: <br>
          <input type="email" name="email" required>
        </label>
        <br>
        <label>
          Mesajınız: <br>
          <textarea name="mesaj" rows="7" cols="44" required></textarea>
        </label>
        <br>
        <input type="submit" value="Gönder">
      </form>
  </div>

  <br>
</body>
</html>
