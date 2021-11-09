# MAW 1.1 Looper by Mauro and Yannick

MAW 1.1 Copy of Looper project for ES dev technician formation.

## Requirements

| Tools                                         | Version            |
|-----------------------------------------------|--------------------|
| [PHP](https://www.php.net/downloads.php)      | 8.0.10             |
| [Composer](https://getcomposer.org/download/) | 2.1.6              |
| [MariaDB](https://mariadb.org/download/)      | 10.3.31-MariaDB    |

## Installation

Use the package manager [composer](https://getcomposer.org/download/).

```bash
git clone https://github.com/yannickcpnv/MAW-1.1-Mauro-and-Yannick.git
composer install
```

### Database

Run the scripts `create_model.sql` and `insert_data.sql` from the folder _sql_.

Create a new user for the application.

```sql
CREATE USER 'user_name'@'localhost' IDENTIFIED BY 'user_password';
GRANT ALL ON `dbname`.* TO 'user_name'@'localhost' WITH GRANT OPTION;
FLUSH PRIVILEGES;
```

## Usage

1. In the _config_ folder you can find a _.example.env_ file, rename it to _.env_.
   ```dotenv
   DB_SQL_DRIVER = mysql
   DB_HOSTNAME   = localhost
   DB_PORT       = 3306
   DB_CHARSET    = utf8
   DB_NAME       = dbname
   DB_USER_NAME  = username
   DB_USER_PWD   = password
   DB_DSN        = ${DB_SQL_DRIVER}:host=${DB_HOSTNAME};dbname=${DB_NAME};port=${DB_PORT};charset=${DB_CHARSET}   
   ```
2. Use your personal variables.
3. Enable php extensions in you php.ini :
    1. ext-pdo => Database access
