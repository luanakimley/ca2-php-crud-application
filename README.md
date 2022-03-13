# Expense Tracker PHP CRUD App

![Expense Tracker Logo](./vendor/images/expense-tracker-logo.png)
A PHP CRUD (Create, Read, Update, Delete) Application for users to track their daily expenses.

---

## Features

- View transactions :eyes:

  - #### Filter transactions by category :card_index_dividers:
    ![Expense Tracker Preview](https://media.giphy.com/media/nkbHMcyH77dkE98t5z/giphy.gif)

- ### Add transaction :heavy_plus_sign:

  ![add transaction](https://media.giphy.com/media/AJ9kCPpErJjUeQByaz/giphy.gif)

- ### Edit transaction :pencil2:

  ![edit transaction](https://media.giphy.com/media/WNpuyMVmPXUM56d5kf/giphy.gif)

- ### Delete transaction :wastebasket:

  ![delete transaction](https://media.giphy.com/media/l3GLG75b3iAwGTm4g2/giphy.gif)

- ### Search transactions :mag_right:

  ![search transaction](https://media.giphy.com/media/dYnJFcHyFlY9fruq5H/giphy.gif)

- ### Manage categories :gear:

  - #### View all categories :eyes:
    ![view all categories](https://media.giphy.com/media/cUEN8zRNO8h6jCFr7N/giphy.gif)
  - #### Add category :heavy_plus_sign:
    ![add category](https://media.giphy.com/media/xGrVVWi0gSxBZWaWiU/giphy.gif)
  - #### Edit category :pencil2:
    ![edit category](https://media.giphy.com/media/U61j0r6qAt5fTY2Es6/giphy.gif)
  - #### Delete category :wastebasket:
    ![delete category](https://media.giphy.com/media/HqU07XAKYH227znkCT/giphy.gif)

---

## Preview

#### To see this application running, click the link below:

[Expense Tracker PHP CRUP App](https://mysql06.comp.dkit.ie/D00234604/ca2-php-crud-application/index.php)

#### or alternatively, you can run the application locally by following the instructions below:

- Install [XAMPP](https://www.apachefriends.org/download.html) on your device if you don't have it already
- Open XAMPP control panel and run Apache Web Server and MySQL Database
  ![Run XAMPP servers](https://media.giphy.com/media/jExtldpiFhLXq8y5Zl/giphy.gif)
- Create a MySQL database called <strong>expense_tracker</strong> in [PHP MyAdmin](http://localhost/phpmyadmin)
  ![Create database PHP myAdmin](https://media.giphy.com/media/NDcQ82cMOvgKaEfZGQ/giphy.gif)
- Run the code in the expense_tracker_db.sql file in [PHP MyAdmin](http://localhost/phpmyadmin)
  ![Run SQL code in PHP myAdmin](https://media.giphy.com/media/TgwQZUudvwmdGwLOe4/giphy.gif)
- Move the PHP files in to your XAMPP htdocs folder so Apache can process the PHP code
- Configure the database.php file to connect to your SQL database by changing the username and password to yours, as seen here:
  ```
  $dsn = 'mysql:host=localhost;dbname=expense_tracker';
  $username = 'YOUR_USERNAME_HERE';
  $password = 'YOUR_PASSWORD_HERE';
  ```
