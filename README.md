<!-- GETTING STARTED -->
## Magento API based Product Management System
## Prerequisites

You will need Magento store, PHP, Composer and Node.js. For MacOS I recommend installing them with [Homebrew](https://brew.sh/). For Windows see instructions for [PHP](https://windows.php.net/download/), [Composer](https://getcomposer.org/doc/00-intro.md#installation-windows) and [Node](https://nodejs.org/en/download/).
## Installation

1. Run your Magento store server.
2. Clone this repo
   ```sh
   git clone https://github.com/nymeria-1/magento2-crud.git
   ```
3. Install Composer packages
   ```sh
   composer update --ignore-platform-reqs
   ```

4. Install NPM packages
   ```sh
   npm install
   ```
5. Create a mysql database file in the database folder, and update database name in .env 
6. Enter your API keys in `.env`
   ```
    MAGENTO_BASE_URL=
    MAGENTO_ACCESS_TOKEN=
   ```
7. Initilise the database
    ```sh
    php artisan migrate
    ```
8. Compile the webpages and run it
    ```sh
    npm run dev
    php artisan serve
    ```

