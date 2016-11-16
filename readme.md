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