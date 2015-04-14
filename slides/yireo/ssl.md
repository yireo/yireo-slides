layout: true
<div class="slide-heading">Joomla &amp; SSL</div>
<div class="slide-footer">
    <span>www.yireo.com - slides.yireo.com</span>
</div>

---
class: center, middle
# Joomla & SSL
### overzicht van SSL binnen Joomla

---
# Jisse Reitsma
- Oprichter van Yireo
- Auteur van "Programming Joomla Plugins"
    - Engels-talig boek
    - Echt voor programmeurs
- Programmeur en ondernemer

---
# Missie
- Technologie openen voor anderen
- Alles wat simpel is moeilijk maken

---
# Joomla & SSL
- Basis van SSL
- Gebruik in Joomla
- Geavanceerd

---
class: center, middle
# Basis van SSL

---
# HTTPS en SSL
- HTTPS = HTTP Secure
- SSL = Secure Socket Layer
    * Bekende implementaties: OpenSSL, LibreSSL

---
# SSL en encryptie
* Twee typen van encryptie
    * Authenticatie van server (via een certificaat)
    * Encryptie van verkeer (key-exchange)
* Factoren
    * Aantal bits: 128, 256, 512, 1024, *2048*, 4092    
    * Ciphers:
        * Diffie-Helman (cert)
        * HMAC (TLS)
        * SHA / MD5 (SSL)

---
# Certificate Authorities (CA)
* Root CAs
    * bekend in eigen browser
* Intermediate CAs
    * bekend bij Root CAs (SSL chain)
* Jouw eigen certificaat
    * bekend bij commerciele CAs
* Self-signed certificaat
    * bekend bij niemand behalve jijzelf

---
# Wat heb je nodig?
* SSL-certificaat
    * CommonName = jouw domein naam
    * Geldig voor 1 of meerdere domeinen (wildcard)
    * Geldig tot een bepaalde datum
    * Soms een KvK check nodig
    * Derde partij
        * Seller: Networking4all
        * Vendor: GeoTrust, GlobalSign, Comodo, Thawte, TrustWave 
* Eigen IP-adres

---
class: center, middle
# Gebruik in Joomla

---
# Algemene Instellingen
* Server > Force SSL
* Geldig voor de hele site

---
# Gedeeltelijke SSL
* Forceer HTTPS op bepaalde paginas
* Forceer HTTP op alle andere pagina
* HTTPS paginas
    * Shop (VirtueMart, MageBridge, HikaShop)
    * Contact formulier
    * Forum paginas

---
# Het Google aspect
* Google gaat sites met HTTPS hoger waarderen
    * HTTPS Everywhere
* HSTS
    * HTTP Strict Transport Security
    * `Strict-Transport-Security` HTTP header

---
# Yireo SSLRedirect
* Gratis plugin
* Support voor gedeeltelijke SSL
* Vlaggetje voor HSTS

---
# SSL in je eigen code
* Gebruik de `//` protocol-prefix
    * `//joomla/pad/` ipv `https://joomla/pad/`
* Gebruik Joomla calls
    * `JHTML::stylesheet()` / `JHTML::script()`
    * `$document = JFactory::getDocument()`
    * `JRoute::_()`

---
# Veelvoorkomende fouten
* This page contains both secure and nonsecure items
    * Foute Joomla calls
    * Extern ingeladen scripts zonder SSL
* This connection is untrusted
    * Self-signed SSL-certificaat
    * SSL niet toepasbaar op domein

---
class: center, middle
# Geavanceerd

---
# SSL-certificaat aanmaken
* Genereer een private SSL-key + CSR
    * Private key = Goede backup maken
    * CSR = Certificaat Signing Request
* Gebruik CSR bij aanschaffen SSL-certificaat
* Installeer SSL-certificaat binnen server
    * SSL Private key
    * SSL certificaat
    * SSL Root CA certificaat
    * SSL chain-certificaat (intermediate CAs)

---
# Self-signed SSL-certificaat
* Genereer een private SSL-key
* Genereer een self-signed SSL-certificaat
* Installeer SSL-certificaat binnen server
    * SSL Private key
    * SSL certificaat

---
# SSL-certificaat installeren
* Apache
* Nginx
* Controle panels
    * DirectAdmin
    * Plesk
    * CPanel
    * hosting provider

---
# OpenSSL commandos
Generate a private SSL-key + CSR
```
$ openssl req -out foobar.csr -pubkey -new -keyout foobar.key
```

Inspect a certificate
```
$ openssl x509 -inform pem -in foobar.crt -noout -text
```

Creating a self-signed certificate
```
openssl req -x509 -nodes -days 365 -newkey rsa:2048 
-keyout foobar.key -out foobar.crt
```

---
# Veelvoorkomende Apache-directives
```
SSLEngine on
SSLCertificateKeyFile /etc/httpd/conf/ssl.key/server.key
SSLCertificateFile /etc/httpd/conf/ssl.crt/server.crt
SSLCertificateChainFile /etc/httpd/conf/ssl.crt/server-chain.crt
SSLCACertificateFile /etc/httpd/conf/ssl.crt/server-rootca.crt
```

---
# Extended Validation (EV)
Validatie van jouw bedrijf bij CA
* Registratie bij Kamer van Koophandel
* BKR gegevens
* Juridische issues

---
# Is SSL veilig?
* Hacking van CA-servers
* DNS hijacking
* Decryptie-aanvallen (SSLstrip, BREACH)
* Lekken in OpenSSL (Heartbleed, POODLE)

---
# SSL in het verleden
* Complexere ciphers
* Van SSL naar TLS
    * Meerdere certificaten per IP
    * TLS Extension Server Name Indication (SNI)
    * Apache 2.2.12> + OpenSSL 0.9.8j>

---
# SSL in de toekomst
* SPDY en HTTP/2 
    * Niet mogelijk zonder HTTPS (TLS)
    * SPDY vereist nu extra modules in webserver

---
class: center, middle
## thanks
### SSLRedirect: http://yir.io/ssl
