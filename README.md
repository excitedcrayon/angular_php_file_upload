# angular_php_file_upload
A simple file upload management application using AngularJS 1.6, PHP and MySQL

<a href="https://projects.bmkonto.fun/upload/" target="_blank">Demo</a>

## AngularJS 1.6
Before I tackle AngularJS 5/6, I wanted to solidify some fundamentals using the old ang tech. File uploading using AngularJS is somewhat difficult (unless you use some pre-made file-upload components out there). The app.js is responsible for handling all the JS code. 
File uploading is handled without a custom directive, with the data being pushed to PHP using FormData.

## PHP
I have created some config files in the inc folder, and some model files that interact directly with the database. These model files consist of 
upload.php - which takes the form data and uploads it to the remote MySQL database;
records.php - which gets the JSON data from the database to pass to the index view for presenting to the end user;
delete.php - which subsequently deletes the file on the server and the relational record in the database;

## Missing Features | Functionality
I have intentionally left out some features and functionality such as
- Custom Error Message Display (this is generally displayed in the browser console but I was never driven enough to render it for the UX)
- Checking against records if the file being uploaded is already uploaded. This is will case an issue where two or more records will have the same file and when one of them is deleted, it will cause an issue with other linked records.
- Checking the file size (ironically I placed the tag of max file size but I never did the computation on the PHP side to check if the file was greater than 10MB. I know PHP will handle the error but it would be nice for the end user to know that is going on behind the scenes).

- I have placed a check in the models/upload.php script to check for specific file types such as:
.php, .htaccess, .repo , .conf , .js, .css
- This is ensure the end user does not upload files that could potentially disrupt the workflow and file requests. The list could be longer but this can always be expanded on in the future.

## App 
![landing page](https://user-images.githubusercontent.com/33831343/43682659-d2d13cb0-98be-11e8-8cee-1fefcd45d8ae.PNG)
Landing Page
- It shows the form on the left hand side and a list on the right

Invalid Form
![form_invalid](https://user-images.githubusercontent.com/33831343/43682661-f2becd1c-98be-11e8-8833-75d5e2228a51.PNG)
- There is some form validation done using AngularJS ($invalid, $touched, $error etc)

Valid Form
![form_valid](https://user-images.githubusercontent.com/33831343/43682673-2c665968-98bf-11e8-9b1a-d8b10467b733.PNG)
- File Upload will appear once the title and category selection are validated and in place

File Uploaded
![file_uploaded](https://user-images.githubusercontent.com/33831343/43682679-4f5cd9a6-98bf-11e8-81a6-5a72ffea3fd5.png)
- List gets populated when a new file is uploaded

File Upload To Server
![file_server_location](https://user-images.githubusercontent.com/33831343/43682686-6885127c-98bf-11e8-978b-1ac066e3933b.PNG)
- File(s) get stored in the uploads folder. It is advised that you assign 777 permissions otherwise you might get an error when trying to move the file to your destination

File Database Records
![file_record_database](https://user-images.githubusercontent.com/33831343/43682692-954f4fde-98bf-11e8-8382-0486203c62c5.PNG)

Lastly when a file is deleted it removes the file from the server and the record from the database;
