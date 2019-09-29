# Event Organizer
Web application to help you organize events.  
Created using LAMP stack **(Linux ,Apache, MySQL, PHP)**

# Status 
Just started the boilerplate code.  
The configuration files are messy.  

# How To Use 
## Linux (For Ubuntu 18.04 and higher)

### Installing LAMP stack (Skip to configure database if you have this ready)  

First you must install the LAMP stack
```
sudo apt-get update
sudo apt-get install apache2 mysql-server php libapache2-mod-php php-mysql
```
Next you must configure MySQL  
First secure MySQL (It is higly recommended you do so)
```
sudo mysql_secure_installation
```
Press y | Y for everything you want and finally set the root password.
It is the user with the highest privileges.  
   
Next Create your user account with which you will access the database.  
First secure the root user.
```
sudo mysql
```
Now inside the mysql shell
```
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'password';
```
Replace password with your root password.  
Then in the same shell.
```
CREATE DATABASE event_organizer;
CREATE USER 'newuser'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON event_organizer.* TO 'username'@'localhost' IDENTIFIED BY 'password';
```
Make sure you replace 'newuser' and 'password'.  

In Future  
To login to root user on mysql shell
```
mysql -u root -p<password here>
```
To login to 'user' on mysql shell
```
mysql -u 'user' -p<password here>
```
Do not leave space between p and password.  
If that isnt intuitive then you can execute 
```
mysql -u 'user' -p
```
and then enter password  
  

### Configure Databases
```
pip3 install pymysql
```
I will keep updating this whenever i change database and table layouts.
So run this again whenever you pull
```
python3 configure.py -u 'username' -p 'password'
```
Replace 'username' and 'password'

## To restart /start the server
```
sudo service apache2 restart
sudo service mysql restart
```









