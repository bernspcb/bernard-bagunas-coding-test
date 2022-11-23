## How to Setup

* Clone the repository
* Go to the cloned file directory
* Install composer : `composer install`
* Copy `.env.example` and rename it as `.env`
* Generate app key: `php artisan key:generate`
* Create database: eg. `coding_test`
* Run migrations and seeders: `php artisan migrate:fresh --seed`

#### Answer the question below by updating this file.

Q: The management requested a new feature where in the fictional e-commerce app must have a "featured products" section.
How would you go about implementing this feature in the backend?

A: Assuming that there is a products table, I would create a column in products table named as featured and set it as a tinyInteger wherein 1 as true and 0 as false. Then will add an API route to update the product as featured and implement the necessary logics with it. TBA....
