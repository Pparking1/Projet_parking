/*
  Modbus TCP server
 
  Created December 2021
  by Tutoduino
*/
 
#include <SPI.h>
#include <Ethernet.h>
#include <ArduinoRS485.h> // ArduinoModbus depends on the ArduinoRS485 library
#include <ArduinoModbus.h>
#include <Servo.h>
#include "rgb_lcd.h"

rgb_lcd lcd;
const int colorR = 255;
const int colorG = 0;
const int colorB = 0;
 
// MAC address of the Ethernet Shield
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xAF };
 
// IP address of the Ethernet Shield
IPAddress ip(172, 16, 154, 200);
 
// We use the default TCP port (502) of ModbusTcp
EthernetServer ethServer(5007);
ModbusTCPServer modbusTCPServer;

Servo barriere_entree;
Servo barriere_sortie;
 
const int feuVert = 5;
const int feuRouge = 4;
const int presenceBarriereSortie = 8;

const int captEntBar = 22;
const int captEnt = A8;

int old_etat_barriere_entree = 0;
int old_etat_barriere_sortie = 0;
 
int counter = 0;
 
void setup() {
   
  Serial.begin(115200); 
  pinMode(captEntBar, INPUT_PULLUP);
  Serial.println("Ethernet Modbus TCP Example");
  Serial.println("DHCP Start");
  // start the Ethernet connection
  
  if (Ethernet.begin(mac) == 0) 
  {
    Serial.println("Failed to configure Ethernet using DHCP");
    // Check for Ethernet hardware present
    if (Ethernet.hardwareStatus() == EthernetNoHardware) 
    {
      Serial.println("Ethernet shield was not found.  Sorry, can't run without hardware. :(");
    } 
    else if (Ethernet.linkStatus() == LinkOFF) {
      Serial.println("Ethernet cable is not connected.");
    }
    else
    {
      Serial.println("Probleme DHCP");
      Ethernet.begin(mac, ip);
      Serial.println(Ethernet.localIP());
    }
  }
  else
  {
    Serial.println("Adresse IP obtenue:");
    Serial.println(Ethernet.localIP());
  }
  
lcd.begin(16, 2);

lcd.setRGB(colorR, colorG, colorB);
lcd.print("Demarrage ^_^ <3");
delay(2000);
lcd.clear();
delay(1000);
lcd.setCursor(0,0);
// Print a message to the LCD.
lcd.print("Adresse IP");
delay(1000);
lcd.setCursor(0, 1);
lcd.print(Ethernet.localIP());

  
  // start the Ethernet server
  ethServer.begin();
   
  // start the Modbus TCP server
  if (!modbusTCPServer.begin()) {
    Serial.println("Failed to start Modbus TCP Server!");
    while (true) {
      delay(1); // do nothing, no point running without Modbus server
    }
  }
  else
  {
    Serial.println("Serveur Modbus OK !");
  }
 
  // configure 1 holding starting at address 0x00
  // coil adresse 0 => barriere entree
  // coil adresse 1 => barriere sortie
  // coil adresse 2 => presence barriere entree
  // coil adresse 3 => presence sous barriere entree
  // coil adresse 4 => presence barriere sortie
  // coil adresse 5 => presence sous barriere sortie
  // coil adresse 6 => feux rouge
  // coil adresse 7 => feux vert
  
  Serial.println(modbusTCPServer.configureCoils(0x00, 8));  

  barriere_entree.attach(3);
  barriere_sortie.attach(2);
  barriere_entree.write(2);
  barriere_sortie.write(2);

  pinMode(feuVert,OUTPUT);
  pinMode(feuRouge,OUTPUT);
  pinMode(presenceBarriereSortie, INPUT); 
}
 
void loop() {
  unsigned int sensorValue = digitalRead(22);
 // Serial.println(sensorValue);
 
  // listen for incoming clients
  EthernetClient client = ethServer.available();
   
  if (client) {
    // a new client connected
    Serial.println("new client");
 
    // let the Modbus TCP accept the connection 
    modbusTCPServer.accept(client);
 
    // loop while the client is connected
    while (client.connected()) {
 
      // Increment internal counter, while client is connected
      counter++;
       
      // poll for Modbus TCP requests, while client connected
      modbusTCPServer.poll();
 
      // update registers
      updateRegisters();
    }
 
    Serial.println("client disconnected");
  }
  
}
 
void updateRegisters() {
 
   // read the current value of the coil
  int etat_barriere_entree = modbusTCPServer.coilRead(0x00);
  int etat_barriere_sortie = modbusTCPServer.coilRead(0x01);

  int etat_feu_vert = modbusTCPServer.coilRead(0x07);
  int etat_feu_rouge = modbusTCPServer.coilRead(0x06);

  
  //Serial.println(modbusTCPServer.holdingRegisterRead(0x00));
  if (etat_barriere_entree == 1 && old_etat_barriere_entree == 0) {
    
    for (int i = 0 ; i <= 80 ; i = i + 5) 
    {
      barriere_entree.write(i);    
      Serial.println(i);
      delay(100);
    }
   
    //barriere_entree.write(80);
  }
  else if (etat_barriere_entree == 0 && old_etat_barriere_entree == 1)
  {
    
    for (int i = 80 ; i >= 2 ; i = i - 5)
    {
      barriere_entree.write(i);
      Serial.println(i);
      delay(100);
    }
    //barriere_entree.write(2);
  }

  if (etat_barriere_sortie == 1 && old_etat_barriere_sortie == 0) 
  {
    for (int i = 0 ; i <= 80 ; i = i + 5) 
    {
      barriere_sortie.write(i);    
      Serial.println(i);
      delay(100);
    }
    //barriere_sortie.write(80);
  } 
  else if(etat_barriere_sortie == 0 && old_etat_barriere_sortie == 1)
  {
    for (int i = 80 ; i >= 2 ; i = i - 5)
    {
      barriere_sortie.write(i);
      Serial.println(i);
      delay(100);
    }
    //barriere_sortie.write(2);
  }

  if (etat_feu_vert == 1) {
   digitalWrite(feuVert,HIGH);
  } else {
    digitalWrite(feuVert,LOW);
  }

if (etat_feu_rouge == 1) {
   digitalWrite(feuRouge,HIGH);
  } else {
    digitalWrite(feuRouge,LOW);
  }
  
  // test etat presence


  int etat_ent=analogRead(captEnt);
  if(etat_ent < 80)
    modbusTCPServer.coilWrite(0x02,1);
  else
    modbusTCPServer.coilWrite(0x02,0);
  
  int etat_bar_ent=digitalRead(captEntBar);
  if(etat_bar_ent == 0)
    modbusTCPServer.coilWrite(0x03,1);
  else
    modbusTCPServer.coilWrite(0x03,0);

  int etat_bar_sortie = digitalRead(presenceBarriereSortie);
  if(etat_bar_sortie == 1)
    {
        modbusTCPServer.coilWrite(0x04,1);
    }
    else
    {
      
      modbusTCPServer.coilWrite(0x04,0);
    }
 old_etat_barriere_entree = etat_barriere_entree;
 old_etat_barriere_sortie = etat_barriere_sortie;
}
