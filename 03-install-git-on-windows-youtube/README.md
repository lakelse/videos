# How to install Git on Windows 10 via Cygwin
Installation instructions for: ....

1) Ensure that you have Cygwin installed.  These instructions assume that you've watched this video: https://www.youtube.com/watch?v=QonIPpKodCw (How to install Cygwin on Windows 10)

2) Start the cygwin terminal.  We're going to first create 'bin' and 'dev' in our windows user's home and then create symbolic links to each from our 'cygwin home'.  This way, future scripts and development will be independent of the cygwin installation.

```bash
# remember to replace 'Jon' with your username
cd /cygdrive/c/Users/Jon
mkdir dev
mkdir bin
cd ~
ln -s /cygdrive/c/Users/Jon/dev
ln -s /cygdrive/c/Users/Jon/bin
```

3) Next we'll edit the .bash_profile script to put the cygwin user's bin directory on the PATH variable:
```bash
notepad.exe .bash_profile

# reload .bash_profile and confirm the PATH has been updated
source ~/.bash_profile

echo $PATH
```

4) Next we'll create a symbolic link from the bin folder to the cygwin-installer folder so that the installer is on the PATH:
```bash
cd bin
ln -s /cygdrive/c/Users/Jon/cygwin-installer/setup-x86_64.exe cygwin-installer
```

5) Next, install git
```bash
cygwin-installer --quiet-mode --packages git
```

6) Confirm git has been install correctly
```bash
cd dev
mkdir hello-git
cd hello-git
git init .
touch test.txt
git add .
git commit -m "Add test.txt"
notepad test.txt
git add .
git commit -m "Update test.txt"
git log
```
