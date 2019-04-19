How to install Cygwin on Windows 10

1) Download cygwin from https://cygwin.com/install.html

2) Open 'File Explorer' and create a folder in your home directory called 'cygwin-installer'.  Next, move the cygwin install executable to the 'cygwin-installer' folder.

3) Run the installer executable:
  - Using 'File Explorer', double click setup-x86 or setup-x86_64 as the case may be.  For each section of the installer, do the following:
  
    <b>Cygwin Net Release Setup Program</b>
    - click 'Next'
    
    <b>Choose A Download Source</b>
    - Select 'Install from Internet', click 'Next'
    
    <b>Select Root Install Directory</b>
    - Choose the 'Root Directory' you want to install cygwin to, for example: c:\cygwin
    - 'Install for', leave 'All Users' selected (unless you specifically want to do otherwise)
    - Click 'Next'

    <b>Select Local Package Directory</b>
    - The 'cygwin-installer' folder should be selected
    - Click 'Next'
    
    <b>Select Your Internet Connection</b>
    - If you're unsure, 'Use System Proxy Settings' is likely the correct choice here
    - Click 'Next'
    
    <b>Choose A Download Site</b>
    - This is the location from which you'll download the Cygwin packages.  Ideally, select a mirror that is geographically close to you.  If unsure, choose any mirror.
    - Click 'Next'
    
    <b>Select Packages</b>
    - This may seem counter-intuitive but for now, lets not select any packages.
    - Click 'Next'
    
    <b>Review and confirm changes</b>
    - Click 'Next'
    
    <b>Progress</b>
    - Wait for install to complete
    
    <b>Create Icons</b>
    - Choose 'Create icon on Desktop'
    - Click 'Finish'
 
4) Confirm that Cygwin is installed
  - Double click 'Cygwin Terminal' on your desktop and confirm that the terminal launches.
