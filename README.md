# Nordea FileTransfer PHP
This code is writen for PHP version 7.1

#Installation

## clone repository and install dependencies
```sh
git clone https://github.com/blackcodefan/nordea-filetransfer
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