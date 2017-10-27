[Gallery 4](http://gallery4.pacificio.com): free software to run online photo sites
=====
![gallery4logo](assets/images/gallery4logo.png)
***
#### created by [Dan McKeown](http:/danmckeown.info) ####
#### based on [CodeIgniter](http://codeigniter.com) 3.1 & on [LoveBird](http://lovebird.pacificio.com) 0.9.9 ####
#### inspired by [Gallery](http://galleryproject.org) 3 ####
##### released under the [MIT License](LICENSE), copyright 2016-2017 #####

Gallery 4 is for showcasing photography on user-powered web sites.

### Setup ###
In order to install Gallery4, create a mySQL database and use the `gallery4.sql` file included in the root of the project folder to set up the schema.  Then copy the code to the root of a web server, after changing the data in `[/application/config/config.php](application/config/config.php)` to reflect the details of your site.

***Admin Accounts***

* **Default admin account**
When setting the site up using the gallery4.sql file, an admin user is automatically created.  When you have the site set up, you can go to your-site/account and log in with these credentials:

    - login:admin
    - password:d763c13613dcd272

Make sure to **change the password right away** the first time you log in, and update the admin user email address.

* **Creating admin accounts**
To create other admin users, change the constant "DEFAULT_NEW_USER_LEVEL" in your project's <code>[/application/config/config.php](application/config/config.php)</code> file to 10 [or desired level], then sign up for your account (and have any other admins sign up) and then once you have done that lower the "DEFAULT_NEW_USER_LEVEL" again, probably to 1.  The levels for access of users can be adjusted in the <code>users_levels</code> table in the database.

After that you can customize the site to your needs.  Edit the views that present the content so it looks the way you want, and modify the controllers for your purposes: visit the [CodeIgniter documentaion](https://www.codeigniter.com/user_guide/) and the [LoveBird homepage](http://lovebird.pacificio.com) to learn more about how to build out your site.

You can change the **watermark** in config.php on the line that starts with `define('WATERMARK_IMAGE_URL'`.  

### Links ###
- [gallery4guide](gallery4guide.md)
- [todo](todo.md)
- [web site](http://gallery4.pacificio.com)
- [GitHub](https://github.com/pacificpelican/gallery4)

#### Set up using [Xampp](https://www.apachefriends.org/index.html) or [MAMP](https://www.mamp.info/en/) ####
> The gallery4.sql file in the root of the project directory is the schema for the database.  From Xampp you want to get to phpMyAdmin (if Xampp is running its phpMyAdmin install should be available at something like [http://localhost:80/phpmyadmin](http://localhost:80/phpmyadmin) while MAMP will have a link to it from [http://localhost:8888/MAMP](http://localhost:8888/MAMP)), where you will want to create a new database with the name gallery4 and then use the import feature to upload the gallery4.sql file to that new database.  After that it may well work but you have to check that the database user and password in the application/configure/config.php match valid credentials in your Xampp mySQL server; MAMP creates a user root with password root for the whole db server but Xampp may have different defaults so you just need to make sure that the user and password fields match ones with permissions to modify the gallery4 database.
So the best way is probably to go on phpMyAdmin and see if there is a root user already, and if not go to User accounts > add user account, and then put root in the user field and password field and then make sure to check 'check all' in the global privileges section before you create.  If a root user exists you could create a new one with a different name but just make sure to change the (dev) db user name in the config.php.

> To make sure a user-created adminstrative account [in contrast to the pre-created "admin" account] has the expected privileges, after you have created it you can go into phpMyAdmin and change the integer [default 1] that corresponds to your user id (as found in the users table) in the users_levels table to 10 or higher.

> The Gallery4 app runs out of the [index.php](index.php) in the root of the project.  In your server's settings, point the document root to the top level folder of the project.

Gallery 4 is a fork of [Lovebird](http://lovebird.pacificio.com).  The LoveBird project was originally developed for [Jessica McKeown](http://jessica.sf3am.com) Photography.
