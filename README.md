# Library Book Lending System

Welcome to the Library Book Lending System! This repository contains the source code for a web-based library management system developed using HTML, CSS, JavaScript, and PHP.

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

## Introduction

The Library Book Lending System is designed to manage book borrowing and returning processes in a library. It allows users to browse available books, borrow them, and return them efficiently. The system also provides an admin interface for managing books, users, and lending records.

## Features

- **User Registration and Login:** Users can register and log in to access the system.
- **Book Browsing:** Users can browse available books and view their details.
- **Book Lending:** Registered users can borrow books from the library.
- **Book Returning:** Users can return borrowed books.
- **Admin Panel:** Admins can manage books, users, and lending records.
- **Search Functionality:** Users can search for books by title, author, or category.
- **Responsive Design:** The system is designed to be responsive and user-friendly on various devices.

## Technologies Used

- **Frontend:**
  - HTML
  - CSS
  - JavaScript
- **Backend:**
  - PHP
- **Database:**
  - MySQL

## Installation

To set up the Library Book Lending System locally, follow these steps:

1. **Clone the repository:**
   ```bash
   git clone https://github.com/timmileyin01/Book-Lending-System.git
   ```
2. **Navigate to the project directory:**
   ```bash
   cd Book-Lending-System
   ```
3. **Set up the database:**
   - Create a MySQL database.
   - Import the provided SQL file (`library.sql`) to set up the necessary tables.
4. **Configure the database connection:**
   - Open `connect.php` and update the database credentials:
     ```php
     <?php
     $servername = "your_server_name";
     $username = "your_username";
     $password = "your_password";
     $dbname = "your_database_name";
     ?>
     ```
5. **Start the local server:**
   - Use a local development server like XAMPP or WAMP to serve the project.

## Usage

1. **Open your web browser and navigate to the project URL (e.g., `http://localhost/Book-lending-system`).**
2. **Register a new user or log in with existing credentials.**
3. **Browse available books and borrow or return them as needed.**
4. **Admins can log in to the admin panel to manage the system.**

## Contributing

Contributions are welcome! If you would like to contribute to this project, please follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or bugfix:
   ```bash
   git checkout -b feature/your-feature-name
   ```
3. Make your changes and commit them:
   ```bash
   git commit -m "Add your message here"
   ```
4. Push your changes to your fork:
   ```bash
   git push origin feature/your-feature-name
   ```
5. Open a pull request on GitHub.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

---

Thank you for using the Library Book Lending System! If you have any questions or need assistance, feel free to open an issue or contact us.


### Authors

- [CodeCraver](https://github.com/timmileyin01)
- [Vinz](https://github.com/vinz)

Feel free to reach out to us for any inquiries or feedback.

---

Happy coding!
