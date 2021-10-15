# Login-and-SignUp-page
using mysql database

/*This is the first example of my work that I made when I was studying at university. but after learning 
PHP and HTML and CSS and JavaScript*/

/*this is a Login and SignUp page that takes the related information from the user and store them in mysql database. in Login mode, The entered information is transferred to a page 
with PHP structure and compared with the information in the database (mysql) and if there is no discrepancy,it is transferred to a page with the title (profile). Inside this page,
all the information that was taken from the user during registration is taken from the database and displayed in special boxes. However, if the login information is incorrect,
it will be redirected to the login page from the beginning and an error message will appear.
When the user is successfully transferred to the profile page, the cookies are checked first so that in case of any discrepancy, the user will be redirected to the login page.
This is because the profile is only active until the user has cleared their browser history. If you clear the browser memory by entering the address (profile) in the search bar,
the user is automatically redirected to the login page.
*/

/*In SignUp mode The entered information is transferred to a page with another PHP structure and stored in a database (mysql).
Then an email containing a link will be sent to the user automatically based on "Registration was successful" and then the email will show the username and password
that the user entered during registration and at the end of the email the active link Account creation. This link is time consuming and expires after a certain period of time.
After the user clicks on the link, it is transferred to another PHP page and (hash), (email) and (time) are taken from the clicked link,
 and if it has not expired, it activates the user's account and Transfers the user to the Login page.*/

/*
NOTe:
Currently only the login and registration page (inex.html) is running. Because the profile page receives information from cookies.
Cookies are also created by pages (PHP). But these pages take the user to a link called (demositte). I have already registered this domain but it is currently down.
The tables and database in (mysql) were also placed inside the external server connected to that domain, which is currently inactive. But you can access the codes.
*/

Thank you for your attention
