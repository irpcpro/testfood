<h1>TestFood</h1>
<br/>


#for running project
cd ./public <br/>
php -S localhost:8000


#for initiate state
php artisan migrate <br/>
php artisan db:seed DatabaseSeeder


#for testing reports
php artisan db:seed ReportDataSeeder

