# Resource Downloader (Test Task)

## Requirements

- Git
- Docker

## Installation

First of all you need to install project:

``git clone https://github.com/weijinnx/portfolio-resource-downloader.git``

After that let's copy ``.env.example`` as ``.env`` and run ``php artisan key:generate``

Then you need go to the project directory and run init command:

``make init_dev``

Then

``make run``

This command will create docker containers and starts project on localhost on 2000 port.

After this command you need to migrate DB:

``make migrate_init`` or ``make migrate``  to just use new migrations.

Run ``php artisan storage:link``

That's it! Go to ``http://localhost:2000/`` to see the project.

### Start queue

If you want to start queue you need to go into Docker container (from the root of project directory):

``docker-compose exec downloader bash``

Now you need to start queue:

``php artisan queue:work``

### CLI Commands

You need to run them from the docker-compose like queue, because of MySQL connection. **Commands:**

1. ``php artisan aurox:list`` - list of resources
2. ``php artisan aurox:load`` - load new resource
3. ``php artisan aurox:load {url}`` - load new resource from specific URL

## Tests

Run tests with:

``phpunit``
