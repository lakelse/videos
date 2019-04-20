# How to install MySQL on Windows 10 via Cygwin
Installation instructions for: https://www.youtube.com/watch?v=w5TsNZRWBNE

1) Ensure that you have Cygwin installed.  These instructions assume that you've watched this video: https://www.youtube.com/watch?v=QonIPpKodCw (How to install Cygwin on Windows 10)

2) Start the cygwin terminal and 'cd' to the cygwin-installer directory or folder.

```bash
# remember to replace 'Jon' with your username
cd /cygdrive/c/Users/Jon/cygwin-installer
```

3) Run the command to install mysql:
```bash
./setup-x86.exe --packages mysql,mysql-server --quiet-mode
```

4) Once the install is complete, we need to setup the database:
```bash
mysql_install_db
```

5) Next, we'll start up the database:
```bash
mysqld_safe &
```

6) Load the timezone files:
```bash
mysql_tzinfo_to_sql /usr/share/zoneinfo | mysql --user root mysql
```

7) Test connection to server
```bash
mysql --user root
> select now();

> show databases;
> exit

```

8) Shutdown MySQL
```bash
mysqladmin --user root shutdown
```
