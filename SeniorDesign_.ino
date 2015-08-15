#include <Servo.h>

#include <TinyGPS++.h>
#include <SoftwareSerial.h>

static const int RXPin = 5, TXPin = 3;
static const uint32_t GPSBaud = 9600;

static const uint32_t destLat= 30.418080;
static const uint32_t destLong= -91.167420; 

TinyGPSPlus gps;
Servo servo; 
SoftwareSerial ss(RXPin, TXPin);

void setup()
{
  Serial.begin(115200);
  ss.begin(GPSBaud);

  Serial.println(F("Senior Design "));
  Serial.println(F("by Blake Butterworth test"));
  Serial.println();

   displayInfo();

   Serial.end();
   ss.end();
   
  servo.attach(9);
}

void loop() {
  
  

  servo.write(90);
 }

 
 // if (millis() > 5000 && gps.charsProcessed() < 10)
 // {
   // Serial.println(F("No GPS detected: check wiring."));
   // while(true);
 // }
  


void displayInfo()
{
  Serial.print(F("Location: ")); 
 
  if (gps.location.isValid())
  {
    Serial.print(gps.location.lat(), 6);
    Serial.print(F(","));
    Serial.print(gps.location.lng(), 6);
 
  
  }
  else
  {
    Serial.print(F("INVALID"));
   
  }

  Serial.print(F("  Date/Time: "));
  if (gps.date.isValid())
  {
    Serial.print(gps.date.month());
    Serial.print(F("/"));
    Serial.print(gps.date.day());
    Serial.print(F("/"));
    Serial.print(gps.date.year());
  }
  else
  {
    Serial.print(F("INVALID"));
    
  }

  Serial.print(F(" "));
  if (gps.time.isValid())
  {
    if (gps.time.hour() < 10) Serial.print(F("0"));
    Serial.print(gps.time.hour());
    Serial.print(F(":"));
    if (gps.time.minute() < 10) Serial.print(F("0"));
    Serial.print(gps.time.minute());
    Serial.print(F(":"));
    if (gps.time.second() < 10) Serial.print(F("0"));
    Serial.print(gps.time.second());
    Serial.print(F("."));
    if (gps.time.centisecond() < 10) Serial.print(F("0"));
    Serial.print(gps.time.centisecond());
  }
  else
  {
    Serial.print(F("INVALID"));
  }

  Serial.println();


}
