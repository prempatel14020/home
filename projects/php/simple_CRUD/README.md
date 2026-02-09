# Lab 04 - CRUD Application with Secure Login

This Lab is worth 15% of your overall grade.

Please see D2L Brightspace for submission details and the final due date.

---

## Application Requirements

For this lab, you will create a simple CRUD application to store information about films and series you would like to track (AKA a Watch List). 

While you can focus on a specific theme (ex. horror films, video game adaptations, films where actors use botched British accents), **you must create a minimum of twenty (20) entries**.


### Basic Features

This application will have a home page that lists all of the titles currently stored in the database.

If the user is not logged in, they will not be able to access some of the more risky features (i.e. they will not be able to create, update, or delete any entries); however, they will be given the option to log in via a login form.

If the user is logged in, they will have full access to the application and all of its features. They will also have the option of logging out. Upon logging out, their $_SESSION will be destroyed and they will no longer have access to all of the application's features. 


### Home Page

The home page will list all of the available records in an easy-to-read, responsive, and user-friendly manner. For each record, you will need to print the values for each of your chosen columns (see Database Requirements for further details). 


### Administrative Area

While you do not need an explicit administrative landing page, users should only be able to access the add, edit, and delete pages when they are logged in. 


### Add Page

The add page will include a form with fields for each of the columns in the watch list table. Each field must be appropriate for the data type of each column. 

Additionally, the form must be validated and account for XSS attacks and SQL injections. 

Upon successful submission of the form, the new record will be inserted into the database and the user will be given a confirmation message stating that their record was added. 


### Edit Page

The user will be given a list of existing records in the database, including a button to edit each specific entry. 

Note: In order to make this user-friendly, only include a few things in this list or table, such as the name and category of the attraction. 

Upon clicking the edit link, the user is given a form, similar to the add page. This form will be prepopulated with all of the existing values in the database. The user will then be able to change the values and, upon successful validation and submission, the record will be updated. 


### Delete Page

The delete page will display list of existing records in the database, including a button to delete each specific entry. 

Note: In order to make this user-friendly, only include a few things in this list or table, such as the name and year. 

Before the deletion occurs, the user must be prompted for confirmation. 


#### Deletion Confirmation

You must prompt the user to confirm whether or not they mean to delete their chosen entry. You may choose to do this using various methods, including a pop-up modal, an alert, or as a separate confirmation page. 


## Database Requirements

For this application, you will need two tables. One table will be for the administrative login, while the other will be for all of the films and series in your watch list.

In order to receive credit for this portion of the lab, you must include a SQL file (ex. `init.sql`) that clearly demonstrates the table structure. 


### Login Credentials

For the administrative login, you will need the following columns:

- primary key
- username 
- hashed password

The username should be `instructor` and the plain text password should be `Password1!`. Please note that if your instructor cannot access the add, edit, and delete functions of your application that you will not receive credit for it. 

Note: You may reuse the `users` table created for our lesson on secure logins.


### Watch List Table 
  
Your table must be named using your student username, followed by `_watchlist`. For example, if your username is `jsmith1`, your table should be named **`jsmith1_watchlist`**.  

#### Required Columns  
Your table must include the following columns:  

1. **`id`** – A unique identifier for each entry (Primary Key).  
2. **`title`** – The title of the film or series.  
3. **`media_type`** – The type of media (ex. web series, made for streaming, television programme, feature-length film, etc.).
4. **`release_year`** – The year the film or series was released.  
5. **`genre1`** – The primary genre (stored as an ENUM).  
6. **`genre2`** – An optional secondary genre (stored as an ENUM, can be NULL).  
7. **`starring`** – The main actor(s) or notable cast members.  
8. **`summary`** – A brief description or the premise of the film or series.  
9. **`watched`** – A status field indicating whether you have watched it (`0` for not watched, `1` for watched).  
10. **`personal_rating`** – Your personal rating out of 5 (stored as an INT, can be NULL if not yet watched).  
11. **`streaming_url`** – A URL to where the film or series can be streamed in Canada.  

Each of these columns must have an appropriate data type and length. 


### Prepared Statements

Every time your application queries the database, it must do so using prepared statements. 

Note that even simple statements without values, such as `SELECT * FROM jsmith1_watchlist` can still use prepared statements; however, since there are no `?` in the statement, you do not need to bind any parameters and can skip right to `->execute()`.
