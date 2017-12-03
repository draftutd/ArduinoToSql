#include <SPI.h>     
#include <Ethernet.h>
#include <EthernetUdp.h>
#include "Dns.h"
byte mac[] = {  0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED};
unsigned int localPort = 80;        // local port to listen for UDP packets
IPAddress timeServer(193,92,150,3);     // time.nist.gov NTP server (fallback)
IPAddress server(192,168,160,30);
IPAddress ip(192, 168, 0, 177);
EthernetClient client;
const int NTP_PACKET_SIZE= 48;        // NTP time stamp is in the first 48 bytes of the message
byte packetBuffer[ NTP_PACKET_SIZE];      // buffer to hold incoming and outgoing packets 
const char* host = "nsath.forthnet.gr";     // Use random servers through DNS
EthernetUDP Udp;
DNSClient Dns;
IPAddress rem_add;
long int date;
int sensorPin = A0;
void setup() 
{
  Serial.begin(9600);
  while (!Serial) {
    ;
  }
  if (Ethernet.begin(mac) == 0) {
    Serial.println("Failed to configure Ethernet using DHCP");
    Ethernet.begin(mac, ip);
    while(true);
  }
  Udp.begin(localPort);
  Dns.begin(Ethernet.dnsServerIP() );
}

void loop()
{
  int datatemp = analogRead(sensorPin) + 100;
  if(Dns.getHostByName(host, rem_add) == 1 ){
    Serial.println("DNS resolve...");  
    sendNTPpacket(rem_add);
  }else{
    Serial.print("DNS fail...");
    Serial.print("time.nist.gov = ");
    Serial.println(timeServer); // fallback
    sendNTPpacket(timeServer);  // send an NTP packet to a time server
  }
  if ( Udp.parsePacket() ) {  
    
    Udp.read(packetBuffer,NTP_PACKET_SIZE);  // read the packet into the buffer
       
    unsigned long highWord = word(packetBuffer[40], packetBuffer[41]);
    unsigned long lowWord = word(packetBuffer[42], packetBuffer[43]);  
    unsigned long secsSince1900 = highWord << 16 | lowWord;  
    const unsigned long seventyYears = 2208988800UL;   
    unsigned long epoch = secsSince1900 - seventyYears;  
    Serial.print("epoch = ");
    Serial.println(epoch); 
    date = epoch;                
  }
   for(int i=0;i<60;i++){
   if(date>=10){
  
    if (client.connect(server, 80)) {
    Serial.print("connected Datatemp = ");
    Serial.println(datatemp);
    // Make a HTTP request:
    client.println("GET /Data/sensortwo.php?sensortwo=" + String(datatemp) +"&datecheck="+String(date)+ " HTTP/1.1");
    client.println("Host: 192,168,160,30");
    client.println("Connection: close");
    client.println();
  } else {
    Serial.println("connection failed");
  }
  if (client.available()) {
    char c = client.read();
    Serial.print(c);
  }
  client.stop();
    }
    Serial.println(date);
    date += 1; 
    delay(1000);
  }
  // wait ten seconds before asking for the time again
}

// send an NTP request to the time server at the given address 
unsigned long sendNTPpacket(IPAddress& address)
{
  // set all bytes in the buffer to 0
  memset(packetBuffer, 0, NTP_PACKET_SIZE); 
  // Initialize values needed to form NTP request
  // (see URL above for details on the packets)
  packetBuffer[0] = 0b11100011;   // LI, Version, Mode
  packetBuffer[1] = 0;     // Stratum, or type of clock
  packetBuffer[2] = 6;     // Polling Interval
  packetBuffer[3] = 0xEC;  // Peer Clock Precision
  // 8 bytes of zero for Root Delay & Root Dispersion
  packetBuffer[12]  = 49; 
  packetBuffer[13]  = 0x4E;
  packetBuffer[14]  = 49;
  packetBuffer[15]  = 52;
  
  // all NTP fields have been given values, now
  // you can send a packet requesting a timestamp: 
  
  Udp.beginPacket(address, 123); //NTP requests are to port 123
  Udp.write(packetBuffer,NTP_PACKET_SIZE);
  Udp.endPacket(); 
}

