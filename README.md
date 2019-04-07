# dmrs-image-hasher-api
api used to hash and store images and returning their hash

## how to install it
```
composer install
php artisan key:generate
php artisan storage:link
php artisan serve
```
# request format
post request to
/upload 
with a file attribute 

# response format 
json response with ( hash ) property which contains the hash followed by the file extension so you can get it without an effort

# how to get the images
(host)/storage/files/{hash}

