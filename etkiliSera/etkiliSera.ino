//Wifi
#include <SoftwareSerial.h>
String agAdi = "HWVTR";
String agSifresi = "frkn9834";
int rxPin = 11;
int txPin = 12;
String ip = "184.106.153.149"; //Thingspeak ip adresi
SoftwareSerial esp(rxPin, txPin); //Seri haberleşme pin ayarlarını yapıyoruz.

// Sensörler
int topraknemi = A2;
int suseviyesi = A3;
int yagmur = A1;
const byte pot_pini = A0; // Servu motor kontrolü
int gaz = A4;

// sıcaklık
const int analogPin = A5;
float gerilimDeger = 0;
float sensorDeger = 0;
float sicaklikDeger;

// diğerleri
int pumpPin = 8; //Su motoru için

int fanPin = 6; //Fan için

#include<Servo.h> // servo motor
int pot_deger;
Servo sg90;

// Led - buton
#define Buton 9
#define Led 10

// Buzzer
int buzzerPin = 7;

// Işık
int isik = A6;

// dht11
#include <dht11.h>
int dht11Pin = 2;
dht11 DHT11;
float sicaklik, nem;

void setup() {
  // put your setup code here, to run once:
  
  Serial.begin(9600);  //Seri port ile haberleşmemizi başlatıyoruz.
  pinMode(pumpPin, OUTPUT);
  pinMode(fanPin, OUTPUT);
  sg90.attach(3);
  pinMode(Buton, INPUT);
  pinMode(Led, OUTPUT);
  pinMode(buzzerPin, OUTPUT); 
  Serial.println("Started");
  
  esp.begin(115200);             //ESP8266 ile seri haberleşmeyi başlatıyoruz.
  esp.println("AT");             //AT komutu ile modül kontrolünü yapıyoruz.
  Serial.println("AT Yollandı");
  while(!esp.find("OK")){          //Modül hazır olana kadar bekliyoruz.
    esp.println("AT");
    Serial.println("ESP8266 Bulunamadı.");
  }
  Serial.println("OK Komutu Alındı");
  esp.println("AT+CWMODE=1");        //ESP8266 modülünü client olarak ayarlıyoruz.
  while(!esp.find("OK")){            //Ayar yapılana kadar bekliyoruz.
    esp.println("AT+CWMODE=1");
    Serial.println("Ayar Yapılıyor....");
  }
  Serial.println("Client olarak ayarlandı");
  Serial.println("Aga Baglaniliyor...");
  esp.println("AT+CWJAP=\""+agAdi+"\",\""+agSifresi+"\"");    //Ağımıza bağlanıyoruz.
  while(!esp.find("OK"));                                     //Ağa bağlanana kadar bekliyoruz.
  Serial.println("Aga Baglandi.");

  esp.println("AT+CIFSR");
  delay(500);
}

void loop() {
  // put your main code here, to run repeatedly:

  esp.println("AT+CIPSTART=\"TCP\",\""+ip+"\",80");           //Thingspeak'e bağlanıyoruz.
  if(esp.find("Error")){                                      //Bağlantı hatası kontrolü yapıyoruz.
    Serial.println("AT+CIPSTART Error");
  }
  
  //Buton ile Led yakma
  if (digitalRead(Buton) == 1)
  digitalWrite(Led,HIGH);
  else
  digitalWrite(Led,LOW);
  
  // Yağmur ölçme
  yagmur = analogRead(A1);
  if(yagmur < 500){
    sg90.write(0);
    delay(25);
  }
  else{
    pot_deger = analogRead(pot_pini);
    int yeni_deger = map(pot_deger , 0, 1023, 0, 70);
    sg90.write(yeni_deger);
    delay(15);
  }
  
  //Su Seviyesi ölçme
  suseviyesi = analogRead(A3);
  delay(15);
  
  // Toprak Nemi
  topraknemi = analogRead(A2);
  if(topraknemi > 500 && suseviyesi > 500){
    digitalWrite(pumpPin, LOW);
    delay(50);
    }
  else{
    digitalWrite(pumpPin, HIGH);
    delay(50);
  }

  // Gaz - Buzzer
  gaz = analogRead(A4);
  if(gaz > 400){
    digitalWrite(buzzerPin, HIGH);
  }
  else{
    digitalWrite(buzzerPin, LOW);
  }
  delay(50);
  
  //Işık ölçme
  isik = analogRead(A0);
  delay(50);

  // Dht11
  DHT11.read(dht11Pin);
  sicaklik = (float)DHT11.temperature;
  nem = (float)DHT11.humidity;
  delay(50);

  // Sıcaklık - Fan
  sensorDeger = analogRead(analogPin);
  gerilimDeger = (sensorDeger/1023)*5000;
  sicaklikDeger = gerilimDeger / 10.0;
  delay(50);
  if(sicaklikDeger > 40){
    digitalWrite(fanPin, LOW);
    delay(50);
    }
  else{
    digitalWrite(fanPin, HIGH);
    delay(50);
  }

  String veri = "GET https://api.thingspeak.com/update?api_key=1382KF43YHSMCKYK";   //Thingspeak komutu. Key kısmına kendi api keyimizi yazıyoruz.
    veri += "&field1=";
  veri += String(topraknemi);
    veri += "&field2=";
  veri += String(suseviyesi);
    veri += "&field3=";
  veri += String(yagmur);
    veri += "&field4=";
  veri += String(gaz);
    veri += "&field5=";
  veri += String(sicaklik);
    veri += "&field6=";
  veri += String(nem);
    veri += "&field7=";
  veri += String(sicaklikDeger);
    veri += "&field8=";
  veri += String(isik);
  veri += "\r\n\r\n";
   
  esp.print("AT+CIPSEND=");                   //ESP'ye göndereceğimiz veri uzunluğunu veriyoruz.
  esp.println(veri.length()+2);
  delay(200);
  if(esp.find(">")){                          //ESP8266 hazır olduğunda içindeki komutlar çalışıyor.
    esp.print(veri);                          //Veriyi gönderiyoruz.
    Serial.println(veri);
    Serial.println("Veri gonderildi.");
    delay(100);
  }
  Serial.println("Baglantı Kapatildi.");
  esp.println("AT+CIPCLOSE");                  //Bağlantıyı kapatıyoruz
  delay(100);                                 //Yeni veri gönderimi için 1 dakika bekliyoruz.
}
