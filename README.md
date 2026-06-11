# School Homework Project

This is a web application project built for a school homework assignment, utilizing the powerful PHP framework Laravel. It features a fully custom-built Admin Panel and a Public E-Commerce storefront.

## 🚀 Tech Stack
- **Backend:** PHP 8.x, Laravel
- **Frontend:** HTML, CSS, JavaScript (Bootstrap 5, CKEditor 5)
- **Database:** SQLite (Default) / MySQL / PostgreSQL (Configure in `.env`)
- **File Storage:** Local Storage (for product images)
- **Testing:** PHPUnit / Pest

## 🌟 Key Features
- **Public Shop:** Browse products, filter by category, and search.
- **Admin Dashboard:** Statistical overview of products, categories, users, and low-stock alerts.
- **Product Management:** Full CRUD capabilities with image uploading and CKEditor 5 rich text descriptions.
- **Category Management:** Unlimited depth parent/child category hierarchy.
- **Authentication:** Custom Admin Middleware to protect backend routes.
- **Shopping Cart:** Add products to cart, update quantities, and calculate order totals.
- **Order System:** Seamless checkout process for customers to place orders.
- **Order Management:** Admin dashboard capabilities to view, process, and track customer orders.


## 📋 Prerequisites
Before you begin, ensure you have the following installed on your machine:
- PHP (v8.2 or higher recommended)
- Composer
- Database server (MySQL, PostgreSQL, or you can use the default SQLite)

## 🛠️ Installation & Setup
Follow these steps to get the project running on your local machine:

1. **Clone the repository** (if you haven't already):
   ```bash
   git clone https://github.com/bertan1262/LaravelProject.git
   cd LaravelProject
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Environment Configuration:** 
   Copy the example environment file. The defaults work perfectly for local development with SQLite.
   ```bash
   cp .env.example .env
   ```

4. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

5. **Link Storage (Crucial for Images):**
   Create a symbolic link to ensure uploaded product images are publicly accessible.
   ```bash
   php artisan storage:link
   ```

6. **Run Migrations:** 
   Create the necessary database tables. If you are using SQLite, this will create the database file for you.
   ```bash
   php artisan migrate
   ```

7. **Seed the Database:** 
   Populate the database with a pre-configured Admin account, 8 categories, and 18 products with rich data.
   ```bash
   php artisan db:seed --class=ProductSeeder
   ```

   **Admin Credentials:**
   - **Email:** `bertan@gmail.com`
   - **Password:** `bertan`

## 💻 Running the Application
To run the application locally, start the Laravel development server:

```bash
php artisan serve
```

- **Frontend (Shop):** `http://127.0.0.1:8000`
- **Admin Panel:** `http://127.0.0.1:8000/admin/giris`

## 🧪 Testing
To run the test suite and ensure everything is working correctly, you can use PHPUnit:
```bash
php artisan test
```

## 📖 About Laravel & PHP
PHP is a popular general-purpose scripting language that is especially suited to web development. Laravel is a web application framework with expressive, elegant syntax built on top of PHP. It provides a structure and starting point for creating your application, allowing you to focus on creating something amazing while it sweats the details.

Laravel takes the pain out of development by easing common tasks used in many web projects, such as:
- Simple, fast routing.
- Powerful dependency injection container.
- Expressive, intuitive database ORM (Eloquent).
- Database agnostic schema migrations.

## 🙌 Acknowledgements
This project’s frontend and admin interfaces were built from scratch utilizing **Bootstrap 5** and integrated with **CKEditor 5** for rich text editing.

## 🎓 Academic Information
This project is submitted as part of a school assignment, demonstrating proficiency in MVC architecture, relational databases, routing, and controller logic within the Laravel ecosystem.
