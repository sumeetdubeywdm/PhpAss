Develop user registration and login system implementation with **object oriented programming** in PHP. Use **sessions** to maintain a state of user.

Create `php.dv` virtualhost for this task.

Code will be committed to the **php** branch.

**Description:**

* **Generate a homepage which shows following two paragraphs. Let’s call it  `http://php.dv/home/`**

*Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus elementum*

*vehicula est vitae sollicitudin. Ut pulvinar ultricies posuere. Integer*

*ac iaculis dui, vel rhoncus erat. In tortor nisl, vulputate quis ante*

*vel, vestibulum luctus nunc. Phasellus id lectus ante. Vivamus ultrices,*

*nunc ut sollicitudin hendrerit, leo tellus lacinia nulla, at porta orci*

*orci eget eros. Nullam id ullamcorper mauris, sit amet cursus risus.*

*Nullam a commodo metus, et facilisis velit. Maecenas volutpat mattis*

*odio vel dignissim. Etiam ac fringilla diam, suscipit sodales ipsum. Nam*

*in velit quam. Nunc luctus tempor leo, vel rhoncus mi mattis nec. Lorem*

*ipsum dolor sit amet, consectetur adipiscing elit. Nullam felis massa,*

*ultrices sit amet turpis vel, accumsan blandit est. Etiam nec eros*

*commodo, cursus turpis pulvinar, volutpat odio.*

<br/>

*Sed vitae turpis ac nisi malesuada blandit. Quisque eu molestie eros. Donec*

*facilisis hendrerit augue, eu adipiscing sem lacinia non. Integer*

*sodales purus odio, non pharetra massa accumsan in. In vitae nunc non*

*erat posuere tempus a id ipsum. Suspendisse enim augue, bibendum eget*

*nunc in, lacinia ultrices tortor. Nam enim lorem, gravida eget varius*

*eu, euismod et purus. Etiam egestas sem eu nisi porttitor pharetra.*

*Donec eu libero eu lorem convallis porta. Nullam interdum vitae lorem*

*sit amet dignissim. Proin sit amet tortor ac odio varius dapibus nec at*

*Sem.*

* The second paragraph of above text will be shown only for logged in users.

* If user is not logged in, then he will see two buttons at the place of second paragraph i.e. **Login** or **Register**. (So at the place of second paragraph your text might go like: **To read more, please login or register**) .

**User visits `/home/`**

* **_If user logged in_***:* Show both paragraphs and also show **‘Edit account’** and **‘Logout’** link.

* **_If user is not logged in:_** Show only one paragraph and ask user to register/login to read second paragraph.

**When user clicks register link:**

* A new page will open showing a registration form (**`/register/`**). The  form will include Name(Full name support), username, phone number(Indian), gender, password, confirm password and email id.

* On successful registration, an email will go to the email id specified in registration form, user will be logged in automatically to system and then redirected to **`/home/`**. In this case, **`/home/`** will show both the paragraphs because user is logged in now.

* If registration is not successful, user will be taken back to **`/register/`** page, system will show the reason why user is not registered just above the registration form and user will be asked to register again.

**When user clicks Login link:**

* A new page will open showing a login form (**`/login/`**) which includes username and password field.

* On successful login, user will be redirected to **`/home/`**. Now **`/home/`** will show both the paragraphs. At the top of **`/home/`**, it should show the message **‘You are successfully logged in’**.

* If login is not successful, user will be taken back to **`/login/`**, system will **alert(see rules for alert)** why user is not logged in and user will be asked to login again.

* The login page will also have **‘Forgot Password’** link.

**When user clicks ‘Forgot Password’ link:**

* Below the login form, a new textbox should appear with button **‘Send me password’**. That textbox will take an email id of the person. Once email id is filled, user will click **‘Send me password’** button.

* After clicking **‘Send Me password’** button, system should send an email to that  person containing link of login page, username and new password for his account.

* Code for sending an email will be accessed via **`/ajax/send-password/`** url. System will pass the data to this **url** via **ajax**. That means when user clicks **‘Send Me password’** button, page will not be refreshed but it will send an email call via ajax.

* After sending an email successfully, user will be shown a *alert* **‘An email has been sent to you at _corresponding email_. Kindly check the email’** on the **`/login/`** page.

* If email id entered by user is not found, then appropriate *alert* should be shown.



**When user clicks ‘Edit Account’ link: (`/edit-account/`):**

* *If user is logged in:*

    * Show Edit account form containing fields like **Name**, **Phone number(Indian)**, Gender, Email, password, confirm password. **Username** should **not be editable**.

    * After editing the account, user will click **‘Update Account’** button and after clicking that button, system will show *alert* on edit account page like **‘Account Information is updated successfully’**.

    * There should also be a link on this edit account page which will take a user to homepage if it is clicked.



* *If user is not logged in:*

    * System should redirect user automatically to **`/home/`**

**When user clicks Log out link: (`/logout/`)**

* System should log the user out of system.

## Rules of the task and Related Tasks(Read This before Coding):

* **Routing and Autoloading:**

    * All the routing logic will be written in  the **`public\index.php`** file

    * Write rewrite rules in your .htaccess file inside **`public\`** folder to redirect all the url to the **index.php** file. Refer [Basic WP](https://wordpress.org/support/article/htaccess/#basic-wp) from wordpress. Write an explanation of it’s working on your ReadMe file of this task.

* **Standards and Object Oriented:**

    * The Task should be entirely done using Object Oriented approach.
    * You must follow psr-2 coding standards and psr-4 for autoloading (It's nice to have).

* **Database & PDO:**

    * **Setting File** and **DbConnection class** :-

        * All the database setting like( db-name, db-username, db-password  ) will be place inside a **`public\setting.php`** file. And will be used wherever required.

        * Create a **`DbConnection`** class that handle database connection. The class will have only one instance at any given point in time.

        * **_Interaction with database should be done using PHP data objects (PDO)_**
        * REF for [PDO](https://code.tutsplus.com/tutorials/why-you-should-be-using-phps-pdo-for-database-access--net-12059)

    * **Setting Up table**

        * Create a **`public\schema.php`** file. Write in code that will create schema for you in your database when we type in following command on the terminal.

        ```
        ../public$ php schema.php create-schema
        ```

        * **Also**

        ```
        ../public$ php schema.php delete-schema
        ```
        should delete all your tables.

        * Give proper permission to the file so that it is accessible only through terminal

* **Storage of Passwords**
   * Passwords should not be stored in plain text format in database.


* **phpmailer/phpmailer from composer for Mail**

    * For mailing use [phpmailer/phpmailer](https://packagist.org/packages/phpmailer/phpmailer) package form composer instead of php’s default [mail](http://php.net/manual/en/function.mail.php) function. Though you need to be aware of the default mail function.

    * Try to send mails initially using the **sendmail** server. Then configure it to send mail via gmail smtp server.

* **Alert:**

    * For all the alerts use [SweetAlert2](https://www.npmjs.com/package/sweetalert2) **npm** package. 

* **Validation and jQuery Validator**
    * For server side validation create all the validation rule in a `Validator` class.
    * Rules of validation are as follow:
      * username: only alpha numeric. It should be unique(uniquiness must not be handled in Validator class). min 4 char - max 10 char
      * name: alpha and spaces and ' to support some christian surnames.
      * phone number: rules and format for indian mobile number must be applied. it must support number format starting with (+91)(10 digit) or (0)(10 digit) or (nothing)(10 digit)
      * password: only strong passwords allowed. Strong password are password with atleast `one alph`, `one numeric` and `one special char from !@#$%^&*`. Spaces are not allowed. min 4 char max - 20 char.
      * Email: Validated for standard email formats.
      * gender: required.
      * required: all the above fields are maditory so there should be a validator rule for required.
    * You must do the same validation at client side using jQuery Validator.


* **Error and Access Logs**

    * Apache Access log and Error log on your **`resources/logs/server/apache/`** folder.
    * Your application's Error/Exception log must be created at  **`resources/logs/system/error/error.log`**
    * Format for the application error log is:  [ip] [date with time] [method in which error/exception occured] [error code] [error message]
    * You must also mainitan a Mail log at  **`resources/logs/system/mail/mail.log`** with the format, [ip] [from] [to (coma seperated if more than 1) ] [subject] [ first 3-4 words of message]
    * Just For Knowledge [Common Log Format or NCSA Common log format](https://en.wikipedia.org/wiki/Common_Log_Format)

* **UI and UX**

    * Try to use standard CSS framework like [Bootstrap](http://getbootstrap.com/)  or [Semantic-UI](https://semantic-ui.com/) for creation of pages.

    * Your site should look neat and modern. Choose color combinations & placements wisely.

* **Create 404 page for the domain**

    * Create a 404.php page for your virtualhost and make a inclusion for the same in your apache setting. This page will be shown when user try to access a wrong url inside your domain.


## Folder Structure


```html
├── composer.json
├── package.json
├── public
│   ├── assets\         ( same as previous tasks )
│   ├── controllers\    ( business logic for each route goes here, create seperate classes for each CRUD )
│   ├── includes\       ( additional helper classes goes here )
│   ├── models\         ( your database logics(insert,update,select....) goes here )
│   ├── views\          ( your display logic goes here)
│   └── index.php       ( index.php, your autoloading and routing scripts goes here )
├── README.md
└── resources
    ├── logs\           ( mail logs, server error logs, system error logs goes here )
    └── assets\         ( same as previous tasks )
```