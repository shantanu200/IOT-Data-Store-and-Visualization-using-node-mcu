#ifdef ESP32
#include <WiFi.h>
#include <HTTPClient.h>
#else
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
#endif

#include <Wire.h>
#include "DHT.h"
#define DHTTYPE DHT11

#define dht_dpin D3
DHT dht(dht_dpin, DHTTYPE);

WiFiClient Client;

const char *ssid = "******";
const char *password = "*********";

const char *serverName = "http:

    String apiKeyValue = "tPmAT5Ab3j7F9";

String sensorName = "DHT11";
String sensorLocation = "Nagpur";

void setup()
{
    dht.begin();
    Serial.begin(9600);
    Serial.println("Humidity and temperature\n\n");
    delay(700);

    WiFi.begin(ssid, password);
    Serial.println("Connecting");
    while (WiFi.status() != WL_CONNECTED)
    {
        delay(500);
        Serial.print(".");
    }
    Serial.println("");
    Serial.print("Connected to WiFi network with IP Address: ");
    Serial.println(WiFi.localIP());
}
void loop()
{

    if (WiFi.status() == WL_CONNECTED)
    {
        HTTPClient http;

        http.begin(Client, serverName);

        http.addHeader("Content-Type", "application/x-www-form-urlencoded");

        String httpRequestData = "api_key=" + apiKeyValue + "&sensor=" + sensorName + "&location=" + sensorLocation + "&value1=" +
                                 String(dht.readTemperature()) + "&value2=" + String(dht.readHumidity()) + "";

        Serial.print("httpRequestData: ");
        Serial.println(httpRequestData);

        int httpResponseCode = http.POST(httpRequestData);

        if (httpResponseCode > 0)
        {
            Serial.print("HTTP Response code: ");
            Serial.println(httpResponseCode);
        }
        else
        {
            Serial.print("Error code: ");
            Serial.println(httpResponseCode);
        }

        http.end();
    }
    else
    {
        Serial.println("WiFi Disconnected");
    }

    delay(15000);
}