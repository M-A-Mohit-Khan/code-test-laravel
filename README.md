# Code Test Laravel Project

Used tech, Vue Inertia with Laravel. Follow the steps below to set up and run the project on your local machine.


## Install dependencies

2. Install PHP and JavaScript dependencies using Composer and npm:
   ```bash
   composer install
   npm install


## Configure Environment

3. Copy the .env.example file to .env:

   ```bash
   cp .env.example .env

4. Generate a new application key:

    ```bash
   php artisan key:generates
Configure the database connection in the .env file.


## Run Database migrations

5. Run database migrations to create necessary tables:

   ```bash
   php artisan migrate


## Compile Assets

6. Compile frontend assets using Laravel Mix:

   ```bash
   npm run dev


## Serve the Application

7. Start the Laravel development server:

    ```bash
    php artisan serve 

8. Optional: Install Laravel Echo Server

If using broadcasting or real-time features, follow instructions to set up Laravel Echo Server.


## Troubleshooting

If you encounter issues during setup, refer to the project's documentation or README for troubleshooting steps.


## Credits

This project uses Vue Inertia with Laravel. Acknowledge libraries or resources used in the project here.