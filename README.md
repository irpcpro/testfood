<h1>Test Food</h1>

**Version:**
<span>1.0.0</span>

<p>A project to get order and manage them ...</p>


<h2>System Design</h2>

![Test-Food](./DEVELOPMENT/system%20design/system-design.png)


<h2>Installation</h2>


Install this project via Composer:
```
composer create-project irpcpro/test-food
```
<br/>
<h6>Requires:</h6>

<ul>
    <li>php: "^8.1",</li>
    <li>MariaDB: "10.4.28"</li>
</ul>
<br/>

<b>:warning: Running Project</b><br/>
It's better to move to the `public` directory and run the command to set up a server on port `8000`
```bash
$ cd ./public
$ php -S localhost:8000
```
<br/>

<b>:warning: Initiate State</b><br/>
for setup the tables and mock data, you should run these two commands to create tables and data
```bash
$ php artisan migrate
$ php artisan db:seed DatabaseSeeder
```
<br/>

<b>:warning: Testing Reports</b><br/>
for testing the API of the `Report [weekly delays]` for having more data, you can run this command to fill the `order` and `delay_reports` tables about 300 data
```bash
$ php artisan db:seed ReportDataSeeder
```

