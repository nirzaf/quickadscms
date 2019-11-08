Quickad Classified PhpScript Documentation
Version 6.4   Last Updated Documtation - 06 June 18

Welcome
Thank you for purchasing Quickad Classified. We covered almost everything in this document that how easily you can setup this script. If you have any questions that are beyond the scope of this help file, please feel free to use the free support forums.

Author : Bylancer

Demo : Quickad Demo

Installing Quickad Classified Script
Installation
Before install, Your server must match following requirements to run the script properly
PHP 5.6.0+
OpenSSL PHP Extension
Mbstring PHP Extension
PHP Fileinfo extension
PHP Zip Archive
PDO PHP Extension
XML PHP Extension
JSON PHP Extension
Rewrite Module (Apache or Nginx)
Please consider that some other php setting values might be required.

PHP.INI Requirements
open_basedir must be disabled
File and folder permissions
/includes/config.php        775
Create a new database on your mysql server, after unzpip the file you downloaded from CodeCanyon and upload the
contents of QUICKAD-CMS-VER folder to your server root, usually /path/to/www/ or /path/to/html/ or /path/to/public_html/.

Important: Make sure that .htaccess file got copied properly from the download to main QuickadClassified folder on your server.
Open your site in the browser.
It will redirect to /install directory (like http://mysite.com to http://mysite.com/install)
Step 1: Choose language and click next.
Step 2: Write codecanyon purchase code.
Step 3: Create a database with phpmyadmin.
Step 4: Enter database dbhostname,dbusername,dbpassword,dbname. and click Next
Step 5: Enter Admin login details. and click Next
All is done Installation completed. click on frontend and enjoy with Quickad
Installation
Upgrade
Step 1:- Go to Admin > Update page.
Step 2:- Upload there QUICKAD-CMS-VERSION.zip file in uploader.
Step 3:- After uploading completed you can see install button.
Step 4:- Click on install button and wait for complete
Step 5:- Done.
update
Change Theme
Go to Admin > Site Setting > Change Theme and choose your theme and click on activate button.

Change Theme
More Theme Coming Soon

Social Login
Facebook
To enable Facebook Login you just need Facebook App ID and App Secret.

This is a how to getting Facebook App ID and App Secret. Check this link.
How to Create Facebook App, App ID, and App Secret

Google
To enable Google Login you just need Google App ID and App Secret.

This is a How to Create Google Developers Console Project. Check this link.
How to Create Google Developers Console Project

Note : copy redirect url from Your Quickad admin > Setting > Social login setting social-login-redirecturl
After getting App Id and App Secret, you have to setup your admin panel:

Go to your Admin panel -> Setting -> Site Setting -> Social Login Setting
For Facebook: set 'Facebook App ID' and 'Facebook App Secret'
For Google: set 'Google app ID' and 'Google app Secret'
And save your changes.
Google Maps
How to setup Google map. (Get Key)
Admin panel setup

Go to your Admin panel -> Site Setting -> General Settings
Set ‘Google Map API Key‘
And save your changes.
gmap

Google Captcha
How to setup.
Visit https://www.google.com/recaptcha/admin
Follow as given in below image
gmap

Click on Register
You will now get your site key and secret key
gmap

Admin panel setup

Go to your Admin panel -> Site Setting -> Google reCAPTCHA tab
Enable reCaptcha‘
Add reCaptcha Site key (Public Key) and Secret key (Private key)‘
And save your changes.
gmap

Theme Features
How to Setup International setting.
Go to Admin > Site Setting > International

specific-country

How to setup home page.
Go to Admin > Site Setting > General

home-page

Manage Category
All demo category are pre inserted on theme activation. If you want to change it here is a category management tool. As you can see in following screenshot.

Go to Admin > Category.

manage-category

Manage Custom fields
We integrate a custom fields managment app in which you can easily create, drag-drop, edit, delete language translate on one page. You can set single custom fields for multi categories or assign to all categories.

Go to Admin > Custom Fields.

manage-custom fields
