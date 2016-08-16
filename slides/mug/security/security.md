class: center, middle
# Security
### MUG &prime;s Hertogenbosch

---
# Security
- Exploits
- Best practices

---
# SSL
- Free via LetsEncrypt
- Check for configuration via SSL validators
- Versions
    - Outdated: SSLv2, SSLv3, TLSv1.0
    - Good: TLSv1.1, TLSv1.2
- Ciphers
    - Outdated: 
    - More bits = better

---
# SSL exploits
- DROWN
- FREAK
- POODLE
- Heartbleed

---
# ShellShock
- Bash bug vulnerability
- Numerous exploits following from this

---
# HTTPoxy
- Exploiting PHP variable HTTP_PROXY
- No vulnerabilities in Magento
    - But known issues in Guzzle (via composer)

---
# Magmi exploits
- Upload of evil PHP files
- Local file inclusion exploit
- Cross site scripting (XSS)
- SQL Injection

---
# Magento ShopLift
- POST to admin/Cms_Wysiwyg/directive
- Super Users with email @example.com
- Extension Magpleasure_Filesystem
- Core files modified

---
# Ransomware
- Mostly Windows software?

---
# Best practices
- Strong passwords
- Keep updating
- Good hosting environment
- Reporting

---
# Hosting environment
- Blocking exploits
    - mod_security, fixes
- Up2date software
- Git
- Intrusion detection system
- Blocking bruteforce attacks
    - DenyHosts, Fail2Ban

---
# Reporting
- MageReport
- rkhunder, chkrootkit, Lynis
- Log analysis

---
class: center, middle
### done
