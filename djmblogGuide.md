Gallery 4 docs
copyright June 2017 by Dan McKeown
based on lovebirdsconsulting.com cms docs
[version number in config/config.php]
by Dan McKeown
copyright Febrary-March-May 2016
http://danmckeown.info

Steps to Deployment
-before uploading code:
--change name, URL and like data in config file
--change CI encryption key in congfig file
--delete .htaccess based on htaccess.zip [testing] and unzip htaccess-ssl.zip to replace it [deployment]
--change Stripe API keys to the appropriate live keys in config file
--make sure site url constant in config is correct [e.g. change from http://localhost:8888 to https://djmblog.com]
--clear database of sample content
--change the DB info in the config file to the correct deployment DB info
--change the SUPERCOiN constant for credit card encryption [deprecated]
--create an admin user (can use any name) [users table] with user level 10 or higher [users_levels table]
--set default permission levels for users in config
--probably have some products pre-loaded if using the store module
--make sure a directory called /assets/files exists, as it is ignored in Git but needed for user uploads
--check that the nav_bootstrap_view has the right links in it
--consider removing the Tests controller

Concepts
--Controllers are (largely) severable
	--If the deployer has no need to for the Blogs controller, it can be removed--be sure to remove it from the nav bar (or create a new nav bar partial).  The same should be true for Dropboxs, Pages, Pays.  
	--The Users controller is required for all other controllers to work.  In addition the User model and users helper are necessary for most or all of them.
--Models are used for some database interactions but not all.  The Pay model all plays a key role in making its controller work but may not be the only place where queries are done.  CodeIgniter's loose (optional) model structure has led me to both use controllers for some data operations and use helpers for some functions--to the point where their roles are not entirely defined as it relates to the User model and users helper.  No controller will cross-rely on any model other then Users--so for example the only controller invoking the Store model is Stores.
--Login is checked for in the web session.  When a user logs in or registers the two variables are placed in the session: 'logged' is set to 1 when a user is logged in by the site and 'login' is set to the user's login.  One or both of these are checked at times to see whether a user is logged in.  In addition to those variables a third variable is sometimes put into the session: one that shows the intended page the user wants after they log in or register: this variable is 'page'.  The pattern used mostly in controllers is to check for login and then redirect the user to the /login page if they are not logged in (after which they will be redirected to 'page' if it exists or to somewhere like /account or the front page otherwise).  If they are logged in, the functionality requested is allowed (provided they pass any users_levels check that may exist) (whether that is opening a page like /messages or /blackjack or honoring a commadn like adding an item to the store).

Accounts and Access
--Admin users are based on the users_levels table.  In order to access the store admin page a user must have an entry in the users table (based on signing up) and a level of 10 or more in the users_levels table (users are initally given a level of 1)
--Regular users must have at least a level of 1 on the users_levels tables [although the minimum user levels required are usuallu set in the config file] as well as a key-matching entry in the users table to be able to log in
--In order to post to the blog the user must have a level of 3 or more [by default--changeable in config]
--The user level required to do a range of task is set at a number; however these numbers can easily be changed in the config.php file where they are set as constants for use throughout the app
--Passwords can be reset using this URL, provided the user entering in the URL is a store admin:
http://example.com/accounts/password_reset(username)

Files
--files can be uploaded using the Dropboxs controller.  The UI for uploading can be found at /files/upload and the files of a particular logged-in user are listed at /files
--user level of 6 or above [by default; can be changed in config file] is required to use the file upload feature
--files are uploaded into the ../assets/files directory which has a .gitignore directive in the root .gitignore to keep its contents fron getting into the repo

Pay
--users can send money directly to the site at the /pay page, also available at /contribute and /donate
--users are told in terms and conditions that the may be responsible for use tax on money given and it's not tax deductible

Blog
--the blog tool is available to users with level 3 or above [by default and can be changed in the config file] and new posts can be created at /write
--the blog is available to /blog and the current site supports a single blog w/multiple authors--author login is currently noted in the HTML inside a span tag but is not exposed in the UI
--the optional enclosure field in the blog creation and editing screen allows the post to become a podcast
--the site generates an RSS feed at /feed and /rss which supports the podcast enclosures when present
--a post can be edited by putting /edit after its URL and the user can see a list of their posts for editing or deletion at /edit/posts

Pages
--the pages controller serves a few specialized pages (front page, 404 page) and also allows creation of arbitrary pages
--the pages are relatively plain and unstyled so they can be used for numerous purposes
--the pages serve based on the alias or title with hyphens instead of spaces, e.g. https://example.com/page/Work-Sheet
--new pages can be created at /create/pages and can be deleted at edit/pages
--users with the level required for blog posting can also create and delete their one pages

SQL security
In preparation for getting the 0.9.0 version out of beta, a security audit has been done.  Now by the release and deployment to djmblog.com of that version, any raw SQL queries that contain user provided data should be either using the query builder class or use the query bindings (prepared statements) pattern
