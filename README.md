##Student Projects Platform - README
##Project Description
The Student Projects Platform is an integrated online system designed to showcase and manage academic projects from universities and colleges across India. This platform enables students to:

Upload and share their academic projects

Discover projects from other institutions

Collaborate through comments and likes

Maintain a centralized repository of innovative work

Built with Laravel 10, MySQL, and Bootstrap 5, this application follows MVC architecture with proper authentication and authorization.

##Features
Core Functionality
✅ User registration and authentication

✅ University profile management

✅ Project submission and management

✅ Commenting system

✅ Like/upvote functionality

Technical Features
RESTful API design

Database migrations and seeding

Form validation

Pagination

Search functionality

Responsive design

##Installation
Prerequisites
PHP 8.1+

Composer

MySQL 5.7+

Node.js 16+

npm/yarn

Setup Steps
Clone the repository:

bash
git clone https://github.com/srijana28/student-projects-platform.git
cd student-projects-platform
Install PHP dependencies:

bash
composer install
Install JavaScript dependencies:

bash
npm install
npm run dev
Create and configure .env file:

bash
cp .env.example .env
Generate application key:

bash
php artisan key:generate
Run database migrations and seed demo data:

bash
php artisan migrate --seed
Configuration
##Environment Variables
Update these key values in your .env file:

ini
APP_NAME="Student Projects Platform"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=student_projects
DB_USERNAME=root
DB_PASSWORD=
Email Configuration (for registration)
ini
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="no-reply@studentprojects.edu"
MAIL_FROM_NAME="Student Projects Platform"
Usage
Running the Application
Start the development server:

bash
php artisan serve
Access the application at:

http://localhost:8000
Default Accounts
Admin: admin@example.com / password

Regular User: user@example.com / password

##Key Functionalities
For Students
Register an account

Create a university profile (if your institution doesn't exist)

Submit projects with:

Title and description

GitHub/documentation links

Tags for discoverability

Engage with other projects through comments and likes

For Educators
Browse projects by university

Search for specific technologies or topics

Monitor project quality and innovation

##API Endpoints
The application provides these RESTful API endpoints:

Method	Endpoint	Description
GET	/api/projects	List all projects
POST	/api/projects	Create new project
GET	/api/projects/{id}	Get specific project
PUT	/api/projects/{id}	Update project
DELETE	/api/projects/{id}	Delete project
GET	/api/universities	List all universities
POST	/api/universities	Create new university
Testing
Run tests with:

bash
php artisan test
Test coverage includes:

Authentication tests

Project CRUD operations

University management

Comment and like functionality

Troubleshooting
Common issues and solutions:

"Class not found" errors

bash
composer dump-autoload
php artisan cache:clear
Database connection issues

Verify credentials in .env

Check MySQL service is running

Authentication problems

Clear session cookies

Verify user exists in database

Contributing
We welcome contributions! Please follow these steps:

Fork the repository

Create your feature branch (git checkout -b feature/AmazingFeature)

Commit your changes (git commit -m 'Add some AmazingFeature')

Push to the branch (git push origin feature/AmazingFeature)

Open a Pull Request

##License
This project is licensed under the MIT License - see the LICENSE file for details.

Developed by Srijana Gautam
Contact srijanagautam595@gmail.com
Institution Lovely Professional University
