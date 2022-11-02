# How to install Email OAuth 2.0 Proxy

## Setup an Application in AzureAD

1. Login to Azure: https://portal.azure.com
2. Click ***Azure Active Directory*** -> ***App Registrations*** -> ***New Registration***
    - Enter name, make sure single tenant
    - Click ***Register***
    - Copy Application ID (Client ID) and Directory (Tenant) ID into a text file.
3. Create client secret:
	  - Click 'Certificates & secrets' -> New client secret
    - Enter name
    - Copy secret 'value' to text file.
4. Add permissions:
    - Click ***API permissions*** -> ***Add permission*** -> ***APIs my organization uses***
    - Search for:
    ```
    Office 365 Exchange Online
    ```
    - Click ***Application permissions***
    - Search for:
    ```
    IMAP.AccessAsApp
    ```
    select and click ***Add permissions***
    
    - Click ***Grant admin consent*** -> Click ***Yes***

## Configure Exchange

Start PowerShell as ***Administrator***
```powershell
Install-Module -Name AzureAD, ExchangeOnlineManagement
```
```powershell
Import-Module AzureAD, ExchangeOnlineManagement
```
```powershell
# Connect to Azure, if you have multiple tenants, specify Tenant ID
Connect-AzureAD -Tenant <tenant id>

# connect to Exchange, specifying the organization 
Connect-ExchangeOnline -Organization <tenant id>

# Get the service principal from Azure Active Directory
$MyApp = Get-AzureADServicePrincipal -SearchString "<enter name of azure app>"

# Configure Service Principal in Exchange
New-ServicePrincipal `
  -AppId $MyApp.AppID `
  -ServiceId $MyApp.ObjectId `
  -DisplayName "Service Principal for IMAP APP"

# Give the Service Principal full access to the mailbox
Add-MailboxPermission -Identity "<email address of account>" `
  -User $MyApp.ObjectId -AccessRights FullAccess
```

## Build development VM
If you wish, you can install a Virtual Machine if you have Virtual Box and Vagrant installed:
```bash
vagrant up
```

## Install Email OAuth 2.0 Proxy
```bash
vagrant ssh
wget https://github.com/simonrob/email-oauth2-proxy/archive/refs/tags/2022-11-01.zip
unzip 2022-11-01.zip
cd email-oauth2-proxy-2022-11-01/
python3 -m pip install -r requirements-no-gui.txt

mv emailproxy.config emailproxy.config.orig
cp /vagrant/emailproxy.config-sample emailproxy.config
```

### Configure for Client Credentials Auth flow

## Test Proxy w/ PHP IMAP
