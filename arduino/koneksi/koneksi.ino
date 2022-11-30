//Library For Connect To WiFi and Send To Server
#include <WiFi.h>
#include <HTTPClient.h>
#include <Wire.h>
#include <INA219.h>

int interval = 20000;
long previousMillis = 0;
long currentMillis = 0;

INA219 ina219;

float busvoltage = 0;
float current = 0;

//Setting WiFi
const char* ssid = "namawifi"; //Nama WiFi
const char* pass = "passwifi";        //Password WiFi

void setup() {
  Serial.begin(115200);
  ina219.begin();

  Serial.println("\n");
  Serial.print("Connecting to :  ");
  Serial.println(ssid);
  WiFi.begin(ssid,pass);
  //Koneksi Wifi
  while (WiFi.status() != WL_CONNECTED){
    delay(1000);
    Serial.println(".");
  }
  Serial.print("WiFi Connected");
  delay(2000);
  previousMillis = millis();
}

void loop() {
  currentMillis = millis();
  
  //Read Voltage and Current from Sensor
  suhu = ina219.suhu();
  kelembaban = ina219.kelembaban();
  getaran = ina219.getaran();
  
//  busvoltage = ina219.busVoltage();
//  current = ina219.shuntCurrent();
  
  //Tampilkan Nilai dari sensor
  Serial.print("Suhu:   "); Serial.print(suhu,2); Serial.println(" C");
  Serial.print("Kelembaban:       "); Serial.print(kelembaban,4); Serial.println(" F");
  Serial.print("Getaran:       "); Serial.print(getaran,4); Serial.println(" SR");
  Serial.println("======================================");
  delay(2000);

  //Send Data if Millis reach Interval
//  if(currentMillis - previousMillis > interval){
    if((suhu == 0) && (kelembaban == 0) && (getaran == 0)){
    HTTPClient http;
    String postData;
    postData = "suhu="+String(suhu)+"&kelembaban="+String(kelembaban,4)+"&getaran="+String(getaran,4); 
    //IP for Access Database Server
    //InsertDB is File php to Save/Insert Data to Database (PHPMySQL)
    http.begin("http://192.168.43.16/SIMonGe/InsertDB.php");
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    int httpCode = http.POST(postData); //Send the request
    String payload = http.getString();  //Get the response payload
    Serial.println(httpCode);   //Print HTTP return code
    Serial.println(payload);    //Print request response payload
    Serial.println("========================\n");
    http.end();
    previousMillis = currentMillis;
  }
  
}
