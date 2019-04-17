How to install Cygwin on Windows 10

1) Download cygwin from https://cygwin.com/install.html

2) Open up the command prompt in windows and change directory to where you downloaded the the cygwin executable.  Run the following:

setup-x86.exe --site http://muug.ca/mirror/cygwin --packages curl,git,tmux,vim --root c:\cygwin --quiet-mode
