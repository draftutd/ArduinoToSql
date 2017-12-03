#include <SPI.h>
#include <Ethernet.h>
int sensorPin = A0;

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
IPAddress server(192,168,137,1);  // numeric IP for Google (no DNS)
IPAddress ip(192, 168, 0, 177);
EthernetClient client;
void setup() {
    Serial.begin(9600);
  while (!Serial) {
    ; 
  }
  if (Ethernet.begin(mac) == 0) {
    Serial.println("Failed to configure Ethernet using DHCP");
    Ethernet.begin(mac, ip);
  }
    delay(1000);
  Serial.println("connecting...");

 
}
void loop() {
 int datatemp = analogRead(sensorPin);
  // if there are incoming bytes available
  // from the server, read them and print them:
   if (client.connect(server, 80)) {
    Serial.print("connected Datatemp = ");
     Serial.println(datatemp);
    // Make a HTTP request:
    client.println("GET /temp/temp.php?temp=" +  String(datatemp) + " HTTP/1.1");
    client.println("Host: www.google.com");
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

    delay(1000);
  }

