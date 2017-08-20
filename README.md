# s42-pxe-server
S42 PXE Server - PHP based Web Interface for PXE Server based on iPXE  
The Boot Menu will be provided by iPXE
## Requirements
* awk
* apache2
* php5
* mysql
* tftpd
* dnsmasq
* systemd
## Installation
1. Clone Repository to Webfolder
2. Import SQL File to Database
3. Edit config.php to meet your Settings
4. Add apache Service account to sudoers to allow System Configurations

```shell
apache ALL=(ALL) NOPASSWD: /usr/bin/systemctl 
apache ALL=(ALL) NOPASSWD: /usr/bin/shutdown
apache ALL=(ALL) NOPASSWD: /usr/bin/hostnamectl
```
## the Future
* PHP SUPERGLOBALS will be secured
* PHP MySQL Requests will be secured
* PHP Shell Injection will be hunted down and fixed
* Root Privileges of apache will be punched down to the needs as much as possible
* iPXE and syslinux Bootloaderfiles and configuration will be included
* LDAP AD Authentication & Group Image Assignments
* MAC Based Image Auto Boot
* DB Schema will be improved
* PHP Code will be cleaned
