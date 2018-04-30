# Ticket System

This is a ticket system, for a web-shop.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Installing

On your www directory clone the repo by entering this:

```
git clone https://github.com/timkolm/TicketSystem.git TicketSystem
```

Now cd to the newly created folder

```
cd TicketSystem
```

and install Laravel framework

```
composer install -vvv
```

create a .env file

```
cp .env.example .env
```

and generate an Application key

```
php artisan key:generate
```

Run migrations and optionally add --seed if you wish to have some dummy data in the database 

```
artisan migrate --seed
```

## Deployment

To enter the Analyze page put this into your browser's address line: www.yourdomain.com/list-tickets

## Built With

* [Laravel](https://laravel.com) - The web framework used

## Authors

* **Timkolm** - *Initial work* - [timkolm(doggie)real_name_of_the_google's_mail.and_so_on]
