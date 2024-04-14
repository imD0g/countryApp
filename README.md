# CountryApp
![PHP](https://img.shields.io/badge/PHP-7.x-blue?style=for-the-badge&logo=php)
![Slim](https://img.shields.io/badge/Slim-4.x-green?style=for-the-badge&logo=slim)
![Twig](https://img.shields.io/badge/Twig-3.x-orange?style=for-the-badge&logo=twig)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6-yellow?style=for-the-badge&logo=javascript)
![HTML](https://img.shields.io/badge/HTML5-red?style=for-the-badge&logo=html5)
![CSS](https://img.shields.io/badge/CSS3-blue?style=for-the-badge&logo=css3)

Welcome to CountryApp! This web application allows users to input countries and retrieve information about them using the [Rest Countries API](https://restcountries.com/).

## Overview

CountryApp is built using PHP, Twig and the Slim framework. It provides a simple and user-friendly interface for querying country data. There are also unit tests within this to handle different scenarios.
There is also some basic error handling to ensure that the application remains workable even when it encounters an unexpected issue.

## Routes / Features:
- This app has the following routes:
- `/countries` -> This shows some basic information of a given country
- `/currency` -> This shows the currency of of a given country
- `/capital-city` -> This shows the capital city of a given country
- `/calling-code` -> This shows the calling code of a given country


## Getting Started

1. **Clone the Repository:** Clone this repository to your local machine

2. **Install Dependencies:** Navigate to the project directory and install the required dependencies using Composer:

   ```bash
   cd [AppLocation]
   composer install
   ```

3. **Set Up Environment:** Rename the `.env.example` file to `.env` and update the configuration settings as needed.

4. **Run the Application:** Start the PHP built-in server or use Docker to run the application:

   ```bash
   # Using PHP built-in server
   php -S localhost:8000 -t public

   # Using Docker
   docker-compose up -d
   ```

5. **Access the Application:** Open your web browser and navigate to `http://localhost:{exposedPort}`

## Contributing

Contributions are welcome! If you have suggestions for improving the application or would like to add new features, feel free to open an issue or submit a pull request.
