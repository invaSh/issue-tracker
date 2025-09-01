# Issue Tracker

Laravel-based Issue Tracker application.

## Setup Instructions

### 1. Configure MySQL Connection
Edit your `.env` file and set your database credentials, for example:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=issue_tracker
DB_USERNAME=your_mysql_username
DB_PASSWORD=your_mysql_password
```


### 2. Run migrations
Run the migrations to setup all the tables:

php artisan migrate


### 3. Run seeders
Run the seeding files to add sample data:

php artisan db:seed --class=ProjectSeeder
php artisan db:seed --class=IssueSeeder
php artisan db:seed --class=TagSeeder


### 4. Run the app

php artisan serve


## Requirements

### Projects
List view - /projects page
Profile view - /projects/{id}
Create view - /projects/create page
Edit view - /projects/edit/{id} page
Delete -  /projects/{id} page

### Issues
List view - /issues page
Profile view - /issues/{id}
Create view - /issues/create page
Edit view - /issues/edit/{id} page
Delete -  /issues/{id} page

### Tags
List view - /tags page
Create view - /tags/create page
Attach/dettach - /issues/{id}

### Comments
List - /issues/{id} page

