# SimpleFoodOrder
Frontend for user food/day selection with optional dessert etc, backend for adding food, printing order list, Corona edition\
\
Requirements:\
Apache/Nginx\
PHP\
MySQL (take a look in /admin/dbstructure.php for db creation)\
\
We needed a website for our canteen to limit the users to a predefined limit per timeframe.\
Every dish/date will be displayed as one tile.\
Optional dishes like desserts, salats can be selected in the second step.\
First/Lastname + Phone + eMail is required to order.\
(Needed if a new corona case is found to inform all affected people)\
Backend will print a list of all users per dish/date for the canteen to have an overview of the day.\
We added two languages, english and german.

If you want to adjust the look&feel then edit the index.php + /inc/html2.php and the files in /inc/css2 + /inc/js2.\
css/js and the html.php is used for the backend.
