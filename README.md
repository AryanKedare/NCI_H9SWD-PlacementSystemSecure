
<br/>
<div align="center">

<h3 align="center">Campus Placement System Secure - CA II</h3>
<p align="center">
Apply to the companies in a click 

<br/>
<br/>
<a href="placeholder">View Demo .</a>  


</p>
</div>

## About The Project

The Website named campus placement system is a web application for colleges and universities which is designed for students to keep a track on college placement activities so that student don’t miss any opportunities and directly apply on the website itself.  The companies can directly create an account and post vacancies on the portal and student can apply to these vacancies. The admin portal can view the data of the student, vacancies, companies at one place. The primary objective of this project is to implement strong security measures to protect the data of the users and ensure data privacy and ensure system integrity. 
### Built With

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
### Installation

1. Install Composer [https://getcomposer.org/](https://getcomposer.org/)

2. Get RobThree/TwoFactorAuth library  
```php composer.phar require robthree/twofactorauth```

3. Get bacon-qr-code library  
```composer require bacon/bacon-qr-code ^2.0``` .

4. Setup HTTPS configuration 
Guide: [https://dev.to/iahtisham/how-to-enable-https-on-xampp-server-mb1](https://dev.to/iahtisham/how-to-enable-https-on-xampp-server-mb1)
## Usage

1. open git terminal

2. Get Web Application Source Code
```git clone https://github.com/AryanKedare/NCI_H9SWD-PlacementSystemSecure.git -b main C:\xampp\htdocs\PSS ```

3. Open PgAdmin 4.  
   7.1. Setup database with credentials of your choice.
   7.2 Edit conn.php in C:\xampp\htdocs\PSS as per the credentials your created. 

4. Start Apache server in XAMPP Control Panel. 

5. Head towards [https://localhost/PSS](https://localhost/PSS) .
## Roadmap

- [x] Add Changelog
- [x] Add back to top links
- [ ] Add Additional Templates w/ Examples
- [ ] Add "components" document to easily copy & paste sections of the readme
- [ ] Multi-language Support
  - [ ] Chinese
  - [ ] Spanish

See the [open issues](https://github.com/ShaanCoding/ReadME-Generator/issues) for a full list of proposed features (and known issues).
## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement".
Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request
## License

Distributed under the MIT License. See [MIT License](https://opensource.org/licenses/MIT) for more information.
## Contact

Your Name - [@your_twitter](https://twitter.com/your_username) - email@example.com

Project Link: [https://github.com/your_username/repo_name](https://github.com/your_username/repo_name)
## Acknowledgments

Use this space to list resources you find helpful and would like to give credit to. I've included a few of my favorites to kick things off!


- [makeread.me](https://github.com/ShaanCoding/ReadME-Generator)
- [othneildrew](https://github.com/othneildrew/Best-README-Template)