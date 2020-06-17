PRE-REQS:

We'll use PHP, MySQLi, HTML, CSS3, JavaScript and XAMPP to create this whole project

Recommended reference site for templates: https://codepen.io/

So do deploy this application it is required to have a WebServer with PHP and the MySQL database installed. It can be accomplished by XAMPP, but it actually can work with other servers.

After the servers environment setup, it will be needed to create a DataBase and tables as described below with the proper userid and password.

Another aspect to be remembered and considered are the paths for other files as functions and db conenctions for example.

- It is also required to have a PAYPAL individual account if you need to test it in real world.

https://www.paypal.com/br/webapps/mpp/account-selection

PayPal coding integration references can be found at the following address. The idea is to create test accounts allowed by PayPal to test the implementation:

developer.paypal.com -> Applications or Dashboard -> Sandbox accounts -> Two test accounts are required: personal to pay and business account to receive:

Country
Account Type
Email Address
Password
First Name
Last Name

Payment Methods -> PayPal balance in US Dollar


The sandbox site will be: www.sandbox.paypal.com (authentication using the methods mentioned above for each account).

----------------------------------------------------

XAMPP CONTROL PANEL

1- START THE APACHE SERVICE
2- START THE MYSQL SERVICE

TO SETUP THE DATABASE AND TABLES:

http://127.0.0.1/phpmyadmin/


----------------------------------

Including the PayPal appliance or rest api to use from the PHP:

developer.paypal.com -> Documentation -> Websites -> Add a payment button

Or from google.com: "paypal buy now button code"

"Single-item Payments - Buy Now Buttons"

"Sample HTML code for a Basic Buy Now Button"



SOLUTION ARCHITECTURE OVERVIEW:

1- Pages showing content from a database
(acomplished by accessing: http://127.0.0.1/ecommerceApp/index.php)
1.1- Search system using keywords
1.2- Items categorization

2- An userid authentication setup allowing to restrict certain operations

3- A cart where items can be included and managed by users

4- An Administration page that allows to add, edit or remove items from the databases
(acomplished by accessing: http://127.0.0.1/ecommerceApp/admin_area/login.php)


=========================================================================
=========================================================================



Install VISUAL STUDIO CODE, Install the extensions:

Auto Close Tag
HTML CSS Support
IntelliSense for CSS class names in HTML
PHP IntelliSense
JavaScript (ES6) code snippets
Path Autocomplete




STRUCTURE:


The Structure of the eCommerce is something like this:

Overall Structure of the Interfaces:

1) The public website for customers
2) The Cart & checkout system
3) Paypal Integratoin
4) Customer Account
5) Admin Panel

MySQL Database Structure:

Database: One Database with 8 tables

DATABASE NAME: ecommerce

TABLES:

IT CAN BE FOUND AT: 

MODELAGEM_DB_TABLES.jpg



PATH IN THE WEB SERVER TO SHOW THE PAGES:


..\XAAMP_installation\htdocs\ecommerceApp\


PROJECT FOLDERS TO BE CREATED:

Go to C: >> XAMPP >> htdocs >> and create the main folder for this project called "ecommerce", inside that create following folders for this project:

1) admin_area
2) customer
3) functions
4) images
5) includes
6) js
7) styles

The above are the main folders for the project which must be created inside the "ecommerce" folder.

Now inside the admin_area folder, create following sub-folders:

1) includes
2) product_images
3) images
4) styles

Inside the customer folder, create the following sub-folders:

1) customer_images
2) functions
3) images
4) includes
5) styles


WEBSITE LAYOUT STRUCTURE (TEXT VERSION)


Before creating the Website Layout for this project, keep in mind that:

--> Website layout is always created using CSS3 and HTML.

--> A basic website layout has 5 main sections which are following:

    The Header
    The Navigation Bar
    The Content Area (Body)
    The Sidebar
    The Footer


We'll use PHPMYADMIN that comes with XAAMP to model the database and tables.


	


