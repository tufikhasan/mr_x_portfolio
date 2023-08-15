# Laravel Simple Portfolio Website Documentation

## Table of Contents

-   Introduction
-   Installation and Setup
-   Authentication using Laravel Breeze Package
-   Role Management
-   Client-Side Rendering (CSR) with Axios
-   Dashboard CRUD Operations using AJAX
-   Laravel Pagination with AJAX (Without Page Load)
-   AJAX Search without Page Load or Press any button
-   Conclusion

### 1. Introduction

Welcome to the documentation for the Laravel Simple Website. This documentation provides an overview of the technologies used, installation instructions, and details about the various features implemented in the project.

### 2. Installation and Setup

To set up the Laravel Simple Website on your local machine, follow these steps:

-   Clone the repository from https://github.com/tufikhasan/mr_x_portfolio.
-   Navigate to the project directory using the command line.
-   Run `composer install` to install the project dependencies.
-   Run `npm install & npm run build` to install the project dependencies.
-   Create a copy of the `.env.example` file and rename it to `.env.` Update the database configuration and other settings as needed.
-   Generate a new application key using the command `php artisan key:generate`.
-   Run database migrations with `php artisan migrate` to create the necessary tables.
-   Start the development server using `php artisan serve`.

### 3. Authentication using Laravel Breeze Package

We have implemented user authentication using the Laravel Breeze package. This provides a simple and customizable way to handle user registration, login, and password reset functionalities.

-   **Registration:** Users can sign up for an account using the registration form.
-   **Login:** Registered users can log in to their accounts securely.
-   **Password Reset:** Users can reset their passwords if forgotten.

### 4. Role Management

Role management is an essential part of our application. It allows you to control access and permissions for different users.

-   **Roles:** Admin, User.
-   **Permissions:** Define custom permissions for each role.

### 5. Client-Side Rendering (CSR) with Axios

Client-Side Rendering (CSR) enhances the user experience by loading certain parts of the website dynamically without full-page reloads. We use Axios, a promise-based HTTP client, to make asynchronous requests to the server.

-   **Implementation:** We've integrated Axios for fetching and displaying data on the client side.
-   **Example:** Demonstrates how to retrieve and display user data using Axios.

### 6. Dashboard CRUD Operations using AJAX

Our dashboard allows users to perform CRUD (Create, Read, Update, Delete) operations seamlessly using AJAX (Asynchronous JavaScript and XML).

-   **Create:** Add new items to the dashboard without reloading the page.
-   **Read:** Display a list of items with search and pagination.
-   **Update:** Edit item details and save changes asynchronously.
-   **Delete:** Remove items from the dashboard without page refresh.

### 7. Laravel Pagination with AJAX (Without Page Load)

We've employed AJAX to facilitate seamless pagination without the need for page reloads, offering a smoother and more engaging user experience.

-   **Implementation:** Step-by-step instructions on how to achieve Laravel pagination through AJAX without any page load.

### 8. AJAX Search without Page Load or Press any button

The Laravel Simple Website's search functionality leverages AJAX to either load results on page load or upon a user-initiated button press.

-   **Implementation:** Detailed guidelines on integrating AJAX-powered search, allowing users to either load results as the page loads or through the press of a dedicated button.

### 9. Conclusion

Congratulations! You've successfully set up and explored the features of the Laravel Simple Website. This documentation provides a comprehensive guide to the technologies used and the functionalities implemented in the project.

If you have any questions or need further assistance, please don't hesitate to reach out to contact me.

![screencapture-tufikhasan-2023-07-07-06_13_01](https://github.com/tufikhasan/mr_x_portfolio/assets/52672268/fdcfded7-f690-4269-a296-be17c1535e17)
![screencapture-tufikhasan-hero-property-2023-07-07-06_14_02](https://github.com/tufikhasan/mr_x_portfolio/assets/52672268/18e61610-f6f9-49bd-9548-190d5261ce0b)
