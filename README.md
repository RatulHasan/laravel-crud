# CRUD System by laravel

Laravel CRUD system for laravel developers'. It's easy to install and run. 


### Installing

Run create-project command with composer to install this project.

Here is the full installation command -

```
composer create-project ratulhasan/laravel-crud:dev-master
```


Now Change this options bellow within your .env,

To rename .env.example, run 
```
php -r "copy('.env.example', '.env');"
```

```
DB_DATABASE=homestead // your database name 
DB_USERNAME=homestead // your database user name 
DB_PASSWORD=secret // your database password 
```

```
cd to/your/project/dir
```
Give this command again:

```
composer update
```
Change your .env.example to .env and make necessary changes in that file especially database configurations to avoid db error. Then

```
php artisan key:generate
```

run project.

### For Linux user 
The stream or file "/root/path/lara-crud/storage/logs/laravel.log" could not be opened: failed to open stream: Permission denied

if see this kind of Permission denied error 

just run this command from outside your project root directory to permit read and write

```
sudo chmod -R 777 [directory_name]
```
### For enable .htaccess

```
sudo gedit /etc/apache2/apache2.conf
```
Then find the line where there is

<Directory /var/www/>

     Options Indexes FollowSymLinks
     
     AllowOverride None
     
     Require all granted
     
</Directory>

replace "None" with "All"

AllowOverride All

### Happy coding

## Author

**<a href='https://besofty.com' target='_blank'>Ratul Hasan</a>** | **<a href='mailto:ratuljh@gmail.com'>Email</a>**

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE) file for details
