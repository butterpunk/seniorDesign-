#include <SoftwareSerial.h>

#define rxPin 10
#define txPin 11
#define STATPIN 9
#define PWKPIN 7

SoftwareSerial mySerial(rxPin,txPin); // RX, TX

void setup(){

  pinMode(rxPin, INPUT);
  pinMode(txPin, OUTPUT);
  
  Serial.begin(9600);
  Serial.println("Arduino serial initialized!");
  delay(10);

  mySerial.begin(9600);
  Serial.println("Software serial initialized!");
  delay(10);
  
  //digitalWrite(PWKPIN, HIGH);
  //readSerial();
  delay(3000);
}

void loop(){
  
  //sendAT("AT");
  Serial.println("Ready to receieve AT commands.");
  
  while(true){
    readComputer();
    readResponse();
  }
}

void sendAT(String msg){
  issueCommand(msg);
  delay(500);
  readResponse();
  delay(500); 
}

void issueCommand(String msg){
  mySerial.println(msg);
  delay(10);
}

void readComputer(){
 String cmd = "";
 String tst = "";
 while (Serial.available())
  {
    tst = Serial.readString();
    cmd = cmd + tst;
    //Serial.print(tst);
    if (Serial.available() == 0)
      {
       Serial.println();
       sendAT(cmd); 
      }
  } 
}

void readResponse(){
  while (mySerial.available()){
    Serial.write(mySerial.read());
    delay(10);
  }
}
