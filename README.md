
<br/>
<div align="center">

<h3 align="center">Campus Placement System Secure - CA II</h3>
<p align="center">
Apply to the companies in a click 

<br/>
<br/>
<a href="https://youtu.be/txrPvWNJmuA">Video Presentation.</a>  


</p>
</div>

# About The Project

The Website named campus placement system is a web application for colleges and universities which is designed for students to keep a track on college placement activities so that student don’t miss any opportunities and directly apply on the website itself.  The companies can directly create an account and post vacancies on the portal and student can apply to these vacancies. The admin portal can view the data of the student, vacancies, companies at one place. The primary objective of this project is to implement strong security measures to protect the data of the users and ensure data privacy and ensure system integrity. 

# Features and Security Objective
- Major Functionalities
    - User Registration and Login
        - Student registration
        - Company registration
        - Admin login

    - Profile Management
        - Student profile creation and editing
        - Company profile creation and editing
    - Job Posting and Application
        - Companies can post job listings
        - Students can view and apply for jobs
    -  Application Tracking
        - Students can view their application status
        - Companies can manage received applications
    - Admin Dashboard
        - System statistics and reports

- Security Improvements
    - HTTPS Implementaion
    - SQL Injection Protection
    - Secure Cookies 
    - Input Validation 
    - Password Hashing
    - CSRF Tokens

# Project Structure 
- index.html : The Initital Landing page where you can login and register. 
- login.php : Contains all the login logics, the secuirty implementation are mostly coded here like secure cookies, MFA etc. This Page also has the login redirects based on roles, and verification of password which is stored in hash. 
- admin_dash.php : The implementation of admin dashboard where we can view all the data, Admin has rightes to delete a company or a student.
- register.html : This is where the index.html redirects when user clicks on New Student register. Basically its a student registration front-end page
- student.php : This is a php page for student registered where the data is collected, passwords are hashed and are send to database. 
- Student_dash.php : this is where all the data is retrived from database students table. 
- company_dash.php : this is where all the data is retrived from database companys table. 
- company_register.html : This is where the index.html redirects when user clicks on New Company register. Basically its a Company registration front-end page
- company.php : This is a php page for student registered where the data is collected, passwords are hashed and are send to database. 
- js/csrf.js : Implementation of Cross-Site Request Forgery (CSRF) attacks protection. 
- js/password_validation.js : Strong Password requirements validations.

## Built With

Software Architecture 

- [PHP](https://www.php.net/)
- [HTML](https://www.w3schools.com/html/)
- [CSS](https://www.w3schools.com/css/)
- [JavaScript](https://javascript.info/)
- [PostgreSQL](https://www.postgresql.org/)

## Getting Started
Downloading the required softwares

1. Download and install git module                                
[https://git-scm.com/downloads](https://git-scm.com/downloads)

1. Download and install XAMPP [https://www.apachefriends.org/](https://www.apachefriends.org/)

3. Download and install PSQL [https://www.postgresql.org/download/](https://www.postgresql.org/download/)

Set the installation path to C:\xampp\pgsql\<version> (the pgsql folder will need to be created, the folder named \<version> needs to be created, based on the current postgres version).
for example C:\xampp\pgsql\17

### 3.1 - Modify php ConfigPermalink
Navigate to C:\xampp\php and open php.ini with an editor like VSCode or Notepad++.

Uncomment (by removing the preceding ;) the lines extension=pgsql and extension=pdo_pgsql.

### 3.2 Download the master branch from the https://github.com/ReimuHakurei/phpPgAdmin (Code > Download ZIP).

Extract the contents of the folder into any other folder.

Get the all of the contents (CTRL + A) of the extracted folder and move them into `C:\xampp\phpPgAdmin` (the folder phpPgAdmin will need to be created).

### 3.3 Modify PhpPgAdmin Config:
Go to `C:\xampp\phpPgAdmin\conf` and rename `config.inc.php-dist to config.inc.php` .

Open `config.inc.php` (again with Notepad++, VSCode or whatever).

Change the line `$conf['servers'][0]['host'] = '';`  to `$conf['servers'][0]['host'] = 'localhost';` .

Change the lines `$conf['servers'][0]['pg_dump_path'] = '/usr/bin/pg_dump';` and `$conf['servers'][0]['pg_dumpall_path'] = '/usr/bin/pg_dumpall';` to `$conf['servers'][0]['pg_dump_path'] = 'C:\\xampp\\pgsql\\17\\bin\\pg_dump.exe';` and `$conf['servers'][0]['pg_dump_path'] = 'C:\\xampp\\pgsql\\17\\bin\\pg_dumpall.exe';.`

Change the line $conf['extra_login_security'] = true; to $conf['extra_login_security'] = false;.

Save the file.


### 3.4 Search for the file httpd-xampp.conf and open it.

Right before the line <IfModule alias_module> insert this code snippet:

`Alias /phpPgAdmin "C:/xampp/phpPgAdmin"
<directory "C:/xampp/phpPgAdmin">
AllowOverride AuthConfig
Require all granted
</directory>`

### 3.5 Check if everything went smoothly by going to `http://localhost/phpPgAdmin/` .

Click on the PostgreSQL server in the sidebar.

Login with the username postgres and the password you specified during PostgreSQL installation.

# Installation

1. Install Composer [https://getcomposer.org/](https://getcomposer.org/)

2. Get RobThree/TwoFactorAuth library  
```php composer.phar require robthree/twofactorauth```

3. Get bacon-qr-code library  
```composer require bacon/bacon-qr-code ^2.0``` .

4. Setup HTTPS configuration 
Guide: [https://dev.to/iahtisham/how-to-enable-https-on-xampp-server-mb1](https://dev.to/iahtisham/how-to-enable-https-on-xampp-server-mb1)
### Usage

1. open git terminal

2. Get Web Application Source Code
```git clone https://github.com/AryanKedare/NCI_H9SWD-PlacementSystemSecure.git -b main C:\xampp\htdocs\PSS ```

3. Open PgAdmin 4.  
   7.1. Setup database with credentials of your choice.
   7.2 Edit conn.php in C:\xampp\htdocs\PSS as per the credentials your created. 

4. Start Apache server in XAMPP Control Panel. 

5. Head towards [https://localhost/PSS](https://localhost/PSS) .

6. Create a student account by clicking Student Registration: Fill up the register form and login from the homepage. Once Logged-in enroll MFA. 
7. Create a company account by clicking Company Registration. Fill up the register form and login from the homepage. Once Logged-in enroll MFA.
8. Once logged in on company_dash using MFA, Create a Vacancy as per your needs from CREATE Vacancy button, once done logout and login back to student account where you
should be able to see the company and vancany. 
9. Login to admin dashbaord via using admin@tpc.com as the username and admin123 as password. 
see the registed students and companies as well as the other reports. 

# Secuiry Improvements. 
The key security improvements are
- HTTPS Implementaion : Although HTTPS is implemented on web sever application.

- SQL Injection Protection : No SQL injection prevention was implemented which could potentially destroy the database or get the user information
For Example: userid = aryan OR 1=1
The above statement would be same as The above statement would be same as SELECT UserId, Name, Password FROM Users WHERE userid = aryan OR 1=1 which could just print the existing data. SQL injection can be prevented by using prepared statement for passing the data to the database

- Secure Cookies : No Secure Cookies were implemented due to which the web application was vulnerable to interception attacks like Man-in-the Middle. Network Sniffing and Session Hijacking. To fix this implement Secure Cookies which will prevent cookies being observed by unauthorised parties within the HTTP response.

- Input Validation : This is implemented to prevent users or the attacks to send arbitary commands or malicious code to the server. 

- Password Hashing : To prevent the password being exposed during a cyber attack or being able to view to the data base admin. 
- CSRF Tokens : The web application was vulnerable to Cross-Site Request Forgery (CSRF) attacks which could lead to unauthorised transactions, data breaches etc.
To prevent this CSRF token are implemented, the web application generated unique code on every new sessions and verifies it

- MFA : To add an additional layer of security Multi Factor Authentication is implemented.

# Testings
## 5.1 Security Vulnerability

To test the code quality and vulnerabilities, Bearer SAST testing was used:

| Issue | Description | Remediation | Occurrence |
|-------|-------------|-------------|------------|
| Unsensitized user input in RAW HTML strings<br>CWE-79 - HIGH | Although user inputs are validated using js, these are stored as raw data | Use htmlspecialchars while storing the data | 34 |
| Hardcoded database connections<br>CWE 798 – CRITICAL | Since this is a testing and project environment, the database credentials are stored and are very weak | Fetch database credentials from different location which is not exposed to HTTPS server | 1 |

## 5.2 Functional Tests

| Description | Test Case | Conditions | Steps | Test Data | Expected Results | Actual Results | Status |
|-------------|-----------|------------|-------|-----------|------------------|----------------|--------|
| Password Hashing | Enter the information and password in the registration form | - | Enter information and password and submit the form | Password from the user | Password should be in hash form in the database | Password is stored in hash form in the database | PASS |
| SecureCookies | Whenever users logs in start the secure cookies | Website should be hosted on HTTPS | Enter username and password and click login | - | Secure cookies should be started | Secure cookies are started with the set parameter | PASS |
| MFA Implementation | Check whether the user is able to login to their account using one time code generated by authenticator app | MFA should be set | 1. Enter Login Credentials and click login<br>2. The MFA window should be popped up | MFA code, username, password | User should be able to login if MFA code is correct and shouldn't be able to login if MFA code is incorrect | Users are able to login using correct MFA code and it gives error if MFA code is invalid | PASS |
| Input Validation | Don't Allow users to input the characters that are not allowed | - | Try entering some special characters which could potentially harm the database | - | Invalid Characters shouldn't be allowed | Invalid characters are not allowed while registration and doesn't proceed ahead unless they are fixed | PASS |

## Contributions and references :
Original Repo : https://github.com/AryanKedare/FC_CSC3609_2022-PlacementSystem 
Libraries Used: RobThree/TwoFactorAuth https://github.com/RobThree/TwoFactorAuth 