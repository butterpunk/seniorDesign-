#include <TinyGPS++.h>
#include <SoftwareSerial.h>
#include <Servo.h>
#include <math.h> //math library...?
#include <stdio.h>
#include <wire.h>

static const int RXPin = 5, TXPin = 3;
static const uint32_t GPSBaud = 9600;

double destLat;
double destLong;

static const double dummyLat = 31.19000;
static const double dummyLong = -91.2490;
static const uint32_t dummyCourse = 360; 

float currentLat; 
float currentLong;
uint32_t currentCourse; 

TinyGPSPlus gps;
Servo servo;
SoftwareSerial ss(RXPin, TXPin);

void setup()
{
  Serial.begin(115200); //Serial timer for console output and Servo
  ss.begin(GPSBaud);    //Serial for GPS 

  destLong = -91.1679;
  destLat = 30.500080;

  servo.attach(9);      //Servo is on wire 9 

  Serial.println(F("Senior Design GPS/servo configuration"));
  Serial.println(F("By: Blake Butterworth"));
}

void loop()
{
  //Receive data from arduino mega
  Wire.begin(9); 
  Wire.onReceive(receiveEvent);
  
  
  // This sketch displays information every time a new sentence is correctly encoded.
  while (ss.available() > 0)
    if (gps.encode(ss.read()))
      displayInfo();

  if (millis() > 5000 && gps.charsProcessed() < 10)
  {
    Serial.println(F("No GPS detected: check wiring."));
    while(true);
  }
}

void receiveEvent(recievebyte){
  dest = wire.read();
  //dest lat 
  
}


void displayInfo()
{
  Serial.print(F("Location: ")); 
  if (gps.location.isValid())
  {
    Serial.print(gps.location.lat(), 6);
    Serial.print(F(","));
    Serial.print(gps.location.lng(), 6);
    currentLat = gps.location.lat();
    currentLong = gps.location.lng();
    }
  else
  {
    Serial.print(F("INVALID "));
    currentLat=dummyLat; 
    currentLong=dummyLong;
    Serial.print(currentLat);
    Serial.print(F(" ,"));
    Serial.print(currentLong);
   }

  Serial.print(F(" Course: "));
  if (gps.course.isValid())
  {
    Serial.print(gps.course.deg(), 6); 
    Serial.print(F(","));  
    currentCourse=gps.course.deg();
  }
  else
  {
    Serial.print(F("INVALID"));
    currentCourse=dummyCourse;  
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
    servoMove();
 
  Serial.println();
}
void servoMove(){
    
    float courseChange=atan2(sin(currentLong)*cos(currentCourse),
    cos(destLat)*sin(destLat)-sin(currentLat)*cos(destLat)*cos(currentCourse)); //azimuth equation
    Serial.end();
    ss.end();
    servo.write(courseChange);
    delay(1000);
    servo.detach();
    Serial.begin(115200);
    ss.begin(GPSBaud);
  
  }
