#include<Ethernet.h>

byte My_MAC_address[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };  // ดูจาก MAC address บนบอร์ดของEthernet Shield

void setup()
{
  Serial.begin(9600);
  Serial.println("Starting...");

  // start the Ethernet connection:
  while (Ethernet.begin(My_MAC_address) != 1)
  {
    Serial.print(".");
  }
  Serial.print("My IP :");
  Serial.println(Ethernet.localIP());
}

void loop()
{

}

