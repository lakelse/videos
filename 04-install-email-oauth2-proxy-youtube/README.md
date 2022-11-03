# How to install Email OAuth 2.0 Proxy

These instructions walk through installing and configuring Email OAuth2 Proxy:
- https://github.com/simonrob/email-oauth2-proxy

## Setup an Application in AzureAD

1. Login to Azure: https://portal.azure.com
2. Click ***Azure Active Directory*** -> ***App Registrations*** -> ***New Registration***
    - Enter name, make sure single tenant
    - Click ***Register***
    - Copy Application ID (Client ID) and Directory (Tenant) ID into a text file.
3. Create client secret:
	  - Click ***Certificates & secrets*** -> ***New client secret***
    - Enter name
    - Copy secret 'value' to text file.
4. Add permissions:
    - Click ***API permissions*** -> ***Add permission*** -> ***APIs my organization uses***
    - Search for:
    ```
    Office 365 Exchange Online
    ```
    - Click ***Application permissions***
    - Search for and select:
    ```
    IMAP.AccessAsApp
    ```
    Click ***Add permissions***
    
    - Click ***Grant admin consent*** -> Click ***Yes***

## Configure Exchange

Start PowerShell as ***Administrator***
```powershell
Install-Module -Name AzureAD, ExchangeOnlineManagement
```
```powershell
Import-Module AzureAD, ExchangeOnlineManagement
```

Store the tenant id in a variable:
```powershell
$tenantId = "<replace with tenant id>"
```

```powershell
$clientId = "<replace with client id>"
```

```powershell
$mailbox = "<replace with email address of mailbox>"
```

```powershell
# Connect to Azure, if you have multiple tenants, specify Tenant ID
Connect-AzureAD -Tenant $tenantId
```

```powershell
# connect to Exchange, specifying the organization 
Connect-ExchangeOnline -Organization $tenantId

# Get the service principal from Azure Active Directory
$ServicePrincipal = Get-AzureADServicePrincipal -Filter "AppId eq '$clientId'"

# Configure Service Principal in Exchange
New-ServicePrincipal `
  -AppId $ServicePrincipal.AppID `
  -ServiceId $ServicePrincipal.ObjectId `
  -DisplayName "Service Principal for IMAP 'Email OAuth2.0 Proxy' Test"

# Give the Service Principal full access to the mailbox
Add-MailboxPermission -Identity "$mailbox" `
  -User $ServicePrincipal.ObjectId -AccessRights FullAccess
```

## Build development VM
If you wish, you can install a Virtual Machine to test with (VirtualBox and Vagrant required):
```bash
# provision and configure virtual machine
vagrant up
```

## Install Email OAuth 2.0 Proxy
```bash
# ssh into VM
./bin/ssh-vm
wget https://github.com/simonrob/email-oauth2-proxy/archive/refs/tags/2022-11-01.zip
unzip 2022-11-01.zip
cd email-oauth2-proxy-2022-11-01/
python3 -m pip install -r requirements-no-gui.txt
```

### Configure for Client Credentials Auth flow
```bash
# create config file from sample, edit w/ appropriate values
cd /vagrant
cp emailproxy.config-sample emailproxy.config
```
Create backup of original config and create a symbolic link to the new config file.
```bash
# create backup of original config file
cd ~/email-oauth2-proxy-2022-11-01
mv emailproxy.config emailproxy.config.orig

ln /vagrant/emailproxy.config
```

### Test Proxy w/ Apache PHP IMAP
```bash
# start up proxy
python3 emailproxy.py --no-gui --debug

# start up php test app
cd /vagrant
IMAP_USERNAME=<user-email> IMAP_PASSWORD=<password> ./bin/start-apache.sh
```

View php app: http://127.0.0.1:8080

### Encrypt client secret

- Stop proxy
- Clear out config added by proxy
- Set `encrypt_client_secret_on_first_use = True`
- Start proxy and view php app: http://127.0.0.1:8080

Notice how the config changes after use.  The `client_secret` is replaced with `encrypted_client_secret`.  The client secret is encrypted with the password and of course decrypted with it.