# CI4 Profile System

## Overview

CI4 Profile System is a web application built with CodeIgniter 4 that allows users to create and manage user profiles with profile pictures. The system demonstrates essential web development features including file upload validation, image storage, pagination, and search functionality.

## Purpose

This project was developed as a hands-on activity to demonstrate proficiency in:

- Building a user profile system with photo upload capabilities
- Implementing file validation and secure image storage
- Creating paginated data listings
- Integrating search filters with pagination

## Key Features

### User Registration
Users can create new profiles by providing their name, email address, and a profile picture. The form includes validation to ensure all required fields are properly filled.

### Profile Picture Upload
The system allows users to upload profile pictures with strict validation:
- Only image files are accepted (PNG, JPG, JPEG)
- Maximum file size is 2MB
- Images are renamed with unique identifiers to prevent conflicts
- Files are stored securely in the uploads directory

### User Listing
All registered users are displayed in a clean table format showing:
- User ID
- Profile picture (avatar)
- Full name
- Email address

### Pagination
The user list is paginated to display 5 users per page, making it easier to navigate through large numbers of records. Navigation links allow users to move between pages.

### Search Functionality
Users can search the directory by name or email address. The search results are also paginated, maintaining consistent performance regardless of the number of matching records.

## Technology Stack

- **Backend Framework:** CodeIgniter 4
- **Frontend:** HTML5, CSS3
- **Database:** MySQL
- **Server Requirements:** PHP 7.4 or higher

## Database Structure

The application uses a single table named 'users' with the following fields:
- id (auto-incrementing primary key)
- name (user's full name)
- email (user's email address)
- avatar (file path to the uploaded profile picture)
- created_at (timestamp of when the record was created)

## How It Works

### Creating a User
1. The user navigates to the create user form
2. They fill in their name and email address
3. They select an image file for their profile picture
4. Upon submission, the system validates all inputs
5. If validation passes, the image is uploaded and renamed
6. The user data is saved to the database
7. The user is redirected to the main listing page

### Viewing Users
1. The main page queries the database for user records
2. Results are paginated (5 per page)
3. Profile pictures are displayed as circular thumbnails
4. Navigation links appear at the bottom for browsing pages

### Searching Users
1. Users type a search term into the search box
2. The system searches both name and email fields
3. Matching results are displayed with pagination
4. The search term is preserved in the search box for convenience

## Installation Requirements

To run this application, you need:
- A web server with PHP 7.4 or higher
- MySQL database server
- Composer for dependency management
- CodeIgniter 4 framework

## Setup Instructions

1. Clone the repository to your web server directory
2. Install dependencies using Composer
3. Configure your database connection in the .env file
4. Create the users table using the provided SQL schema
5. Create the uploads directory with write permissions
6. Configure the routes in the Routes.php file
7. Start the development server or configure your web server

## Validation Rules

The application implements the following validation rules:

- Name field is required
- Email field is required and must be a valid email format
- Avatar file must be uploaded
- Avatar must be an image (PNG, JPG, JPEG)
- Avatar cannot exceed 2MB in size

## Error Handling

The system gracefully handles various error scenarios:
- Displaying validation errors when form inputs are invalid
- Showing upload failure messages when image processing fails
- Logging errors for debugging purposes
- Redirecting users back to forms with their previous input preserved

## Learning Outcomes

This project demonstrates understanding of:

- CodeIgniter 4 framework structure (MVC pattern)
- File upload handling and validation
- Image processing and storage
- Database operations using models
- Pagination implementation
- Search integration with pagination
- Session management for flash messages
- Security practices (CSRF protection, input escaping)

## Future Improvements

Potential enhancements for this project include:
- User profile editing and deletion
- Image cropping and resizing
- AJAX-based search without page reload
- User authentication and authorization
- Email notifications
- Profile picture preview before upload
- Additional user fields (bio, location, website)

## Submission Requirements

This project includes:
- Controller file (UserController.php)
- Model file (UserModel.php)
- View files (create.php, index.php)
- Routes configuration
- Database schema
- Screenshots of the working application
