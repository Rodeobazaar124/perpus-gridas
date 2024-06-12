# Smart Library Management System

Smart Library is a project originally developed by Nandang Koswara. This repository aims to revive and update the project to adapt to the latest PHP version (currently 8.3) and integrate Composer for package management. Additionally, deprecated packages like Phpexcel have been replaced with PhpSpreadsheet for compatibility and improved functionality.

## Requirements
- MySQL/MariaDB
- PHP 8.x
- Apache/Nginx

For local development and testing, Laragon or XAMPP are recommended as they include all necessary components (Apache, MySQL/MariaDB, PHP). However, you may need to configure `php.ini` for production settings.

## Optimizing php.ini Settings for Production (This section is AI Generated)
    
<h3>1. Memory Limits:</h3>
<pre>
memory_limit = 256M
</pre>
<h3>2. Error Reporting:</h3>
<pre>
display_errors = Off
log_errors = On
error_log = /var/log/php_errors.log
</pre>

<h3>3. Timezone:</h3>
<pre>
date.timezone = "Your/Timezone"
</pre>
example: 
<pre>
date.timezone = "Asia/Jakarta"
</pre>
<h3>4. File Uploads:</h3>
<pre>
upload_max_filesize = 20M
post_max_size = 25M
</pre>
<h3>5. OPcache:</h3>
<pre>
[opcache]
opcache.enable = 1
opcache.memory_consumption = 128
opcache.interned_strings_buffer = 8
opcache.max_accelerated_files = 10000
opcache.validate_timestamps = 0
opcache.revalidate_freq = 0
opcache.fast_shutdown = 1
</pre>
<h3>6. Session Configuration:</h3>
<pre>
session.use_strict_mode = 1
session.cookie_httponly = 1
session.cookie_secure = 1
session.use_only_cookies = 1
session.gc_probability = 1
session.gc_divisor = 1000
session.gc_maxlifetime = 1440
</pre>
<h3>7. Security:</h3>
<pre>
disable_functions = exec,passthru,shell_exec,system,proc_open,popen,curl_multi_exec,parse_ini_file,show_source
max_execution_time = 30
</pre>
<h3>8. Other Considerations:</h3>
<pre>
register_globals = Off
</pre>
<p>Adjust <code>upload_max_filesize</code> and <code>post_max_size</code> as needed.</p>
    
<p>Enable Gzip Compression if supported and beneficial for your application.</p>
<h3>Applying Changes:</h3>
<p>After editing <code>php.ini</code>, restart your web server (e.g., Apache, Nginx) for the changes to take effect:</p>
<ul>
<li>Apache: <code>sudo systemctl restart apache2</code></li>
<li>Nginx: <code>sudo systemctl restart nginx</code></li>
</ul>    
<p>Ensure that you test your application thoroughly after making these changes to ensure compatibility and performance improvements.</p>

## How to Use
1. Clone this repository into your local web server directory (`www` or `htdocs`):
```shell
git clone https://github.com/Rodeobazaar124/perpus-gridas
```
2. Navigate to the cloned directory:
```shell
cd perpus-gridas;
```
3. Import the MySQL database:
```shell
mysql -u <username> -p db_perpus < database/db_perpus*.sql
```
Replace <username> with your MySQL username.
4. Configure your web server to point to the perpus-gridas directory.
5. Open your web browser and access the project.

## Acknowledgements
- Nandang Koswara - Original developer of Smart Library

