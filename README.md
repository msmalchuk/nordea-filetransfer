# Nordea FileTransfer PHP Client
This code is writen for PHP version 7.1

# Installation

## PHP and Composer

### Install php 7.1

```bash
sudo apt install apt-transport-https lsb-release ca-certificates
sudo wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
sudo sh -c 'echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list'
sudo apt update

sudo apt install php7.1
```

And install additional packages
```bash
sudo apt install php7.1-curl php7.1-mbstring php7.1-xml php7.1-cli php7.1-json php7.1-soap
```

### Install composer  2.2

Follw [this instruction](https://www.digitalocean.com/community/tutorials/how-to-install-composer-on-debian-11-quickstart)

```bash
sudo apt update
sudo apt install curl php-cli php-mbstring git unzip
cd ~
curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php
HASH=`curl -sS https://composer.github.io/installer.sig`
php -r "if (hash_file('SHA384', '/tmp/composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
sudo php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer --2.2
```

## clone repository and install dependencies
```sh
git clone https://github.com/msmalchuk/nordea-filetransfer
cd nordea-filetransfer
composer install
composer update
```
!Important!
Do not run composer install as a root/superuser.

## Download demo certificate

You can download the nordea's demo certificate [here](https://www.nordea.fi/Images/147-487388/Certificate_PRODUCTION_DEMO2024Nov.zip).

## convert .p12 file to pem file

```bash
openssl pkcs12 -info -in <downloaded certificate file>.p12
openssl pkcs12 -in<downloaded certificate file>.p12 -out output.pem -nodes
```
You will be asked for the PIN. It's `WSNDEA1234`.

## Extract private key and certificate from .p12 file
When you get the output.pem file, it has private key and certificate together.

Create a directory called `cert` and create 2 fils `certificate.pem`, `privatekey.pem` in that directory.

```bash
/project_root/cert/certificate.pem
/project_root/cert/privatekey.pem
```

Open the output.pem file and copy & paste corresponding part to each file.

# Install Nordea SSL certificate

## Download the ssl certificate file
Download ssl certificate file from [here](https://www.nordea.fi/Images/147-526075/filetransfer.nordea.coma-2025.zip) and unzip.

## Install ROOT CA file to your server

At the moment, exact file name is `SSL.com TLS RSA Root CA 2022.crt`.

```bash
sudo cp <root ca file>.crt /usr/local/share/ca-certificates/
sudo update-ca-certificates
```

# Run the code
## GetUserInfo

```sh
php tests/getuserinfo.php
```

## DownloadFileList

```sh
php tests/downloadfilelist.php
```

## DownloadFile

```sh
php tests/downloadfile.php
```