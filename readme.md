# What's done on this fork
## Original APP modifications
* To work with packages (task asks the code provided to be as a module...) and have migrations in them, laravel was upgraded to 5.3, sorry folks!
* App\Sale model was edited to fix not returning relations bug
* app.blade.php - added a link in user menu to loyalty.user_log route

## How to setup
1. follow original instruction if checked out as a new version
2. Or launch these:
```
$ composer install
$ composer dump-autoload
```
1. In both cases run:
```
$ php artisan migrate
```

## What else
* UI is quite intuitive, you'll find new menu item in user menu, from there you will see:
    * Logged in user points summary
    * List of all users
        * Points input + Add button to add some points to user, level won't change thought after adding them
        * Log button to see history of user loyalty
* Two Artisan commands
    * loyalty:sales - to convert all users sales to points
    * loyalty:levels - to recount all users level
        * this command is already scheduled to execute on first day of every month if you have Laravel Schedules set up and running
        * ... if no, add this command to crontab by frequency you want
* Adding new actions is simple, every time you want to implement adding points to user, just create new LoyaltyLog item and save it to DB, see LoyaltyController::addPoints for an example.

## Summary
I quite enjoyed writing my first non hello world style app with Laravel, tho upgrading to minor version is pain... That is what I hear a lot from colleagues and now I can see why. 
Also I'm not sure if it's good to place business logic in models...? :/ I didn't like that, but maybe one day you will show me how real stuff is done! ;)

# ----------------------------------
# Description

We have a cafe where people can buy some drinks. To motivate people to return to the cafe we want to implement a new loyalty program. A client will get points for their actions in our cafe(site) and will gain a "level" based on their actions last month that will enable discounts and such. At the moment these actions will only be purchases but we might add more in the future (say, points for logging in or for participating in the book club that we will open soon).
## Task

You need to implement a point system:
* already existing purchases from previous months have to be converted to points 
    * at the moment we are giving points just for purchases, for example
      * 1 purchase = 1 point
      * 5 points = 1 new level
* the clients should get the right level each month according to the points earned last month
* the loyalty program should be a separate module
    * as few changes as possible to existing code
    * adding new actions for gaining points has to be easy
    * you can and it is recommended to use the best practices and possibilities in Laravel
    
* a separate view for the cafe manager to 
   * see the point the clients currently have and their current level
   * add points manually 
   * no need to worry about security and rights at this point
* a client should be able to see their current level

* documentation/comments/explanations will be much appreciated :)

## How to run the cafe

1. git clone 
2. copy .env.example and rename to .env
3. run these commands
```
 composer install
 composer dump-autoload
 php artisan key:generate
 ``` 

4. For generating and rebuilding the database: 

   check that you have a plain file database.sqlite in /database folder
```
 php artisan migrate:refresh
 php artisan db:seed
 ```
 
 5. To show in localhost:
  ```
  php artisan serve
  ```