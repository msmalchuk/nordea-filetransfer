# Nordea FileTransfer PHP Client
This code is writen for PHP version 7.1

# Installation

## clone repository and install dependencies
```sh
git clone https://github.com/msmalchuk/nordea-filetransfer
cd nordea-filetransfer
composer install
composer update
```

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

Open the output.pem file and copy & paste corrisponding part to each file.

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