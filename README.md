Shops Coding Challenge
======================

Shops Coding challenge **SYMFONY** API.

Setup
------

1.Clone project
````
git clone https://github.com/farouk2u/hf-shops-api.git
````

2.Install dependencies 
````
composer install 
````
3.Create Database and Schema
````
php bin/console doctrine:database:create
````
````
php bin/console doctrine:schema:update
````
4.Load fixtures for dump data (Shops, Users, oAuthClient)
```
php bin/console doctrine:fixtures:load
````
5.Install assets 
```
php bin/console assets:install --symlink
````

6.Get oAuth Credentials 
```
php bin/console doctrine:query:sql "SELECT concat(id, '_', random_id) as 'client_id', secret as 'client_secret' from client"
```

7.Enjoy 


Credits (Used Bundles)
----------------------
* FosUserBundle
* FosRestBundle
* FosOAuthServerBundle
* NelmioApiDocBundle
* NelmioCorsBundle

Inspirations
------------
* https://gist.github.com/tjamps/11d617a4b318d65ca583
* http://williamdurand.fr/2012/08/02/rest-apis-with-symfony2-the-right-way/