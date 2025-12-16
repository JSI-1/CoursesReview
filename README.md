# Courses Review System

A Laravel-based web application for university students to review and rate college courses. Features bilingual support (English/Arabic) with RTL layout support, file uploads for reviews, and a modern, responsive design.

## Features

- ✅ **Bilingual Support**: English and Arabic with automatic RTL/LTR layout switching
- ✅ **Course Management**: Browse, search, and filter courses by department
- ✅ **Review System**: Rate and review courses with optional file attachments (JPG, PNG, PDF)
- ✅ **User Dashboard**: View and manage your reviews
- ✅ **File Uploads**: Attach files to reviews (max 5MB, JPG/PNG/PDF)
- ✅ **Responsive Design**: Modern, clean UI that works on all devices
- ✅ **Department Translations**: Departments display in the selected language

## Requirements

- PHP >= 8.1
- MySQL >= 5.7
- Composer
- Node.js & NPM (for asset compilation)

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/course-review-app.git
   cd course-review-app
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Update `.env` with your database credentials**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Run migrations and seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Create storage link**
   ```bash
   php artisan storage:link
   ```

7. **Build assets (optional)**
   ```bash
   npm run build
   ```

8. **Start development server**
   ```bash
   php artisan serve
   ```

   Or use the provided PowerShell script:
   ```powershell
   .\start.ps1
   ```

## Default Credentials

After seeding, you can use these test accounts:
- Email: `ahmed@example.com`
- Password: `password`

(Check `database/seeders/UserSeeder.php` for all test users)

## Project Structure

```
course-review-app/
├── app/                    # Application core
│   ├── Http/
│   │   ├── Controllers/    # Controllers
│   │   ├── Middleware/     # Custom middleware
│   │   └── Requests/       # Form requests
│   └── Models/             # Eloquent models
├── database/
│   ├── migrations/         # Database migrations
│   └── seeders/           # Database seeders
├── resources/
│   ├── lang/              # Translation files (en/ar)
│   ├── views/             # Blade templates
│   ├── css/               # Stylesheets
│   └── js/                # JavaScript files
├── routes/                # Route definitions
├── storage/               # File storage
└── public/                # Public assets
```

## Deployment

For deployment to InfinityFree or other shared hosting, see:
- `DEPLOYMENT_INFINITYFREE.md` - Detailed deployment guide
- `CLEANUP.md` - Pre-deployment cleanup checklist

## Technologies Used

- **Backend**: Laravel 10
- **Frontend**: Bootstrap 5, Custom CSS
- **Database**: MySQL
- **Languages**: PHP 8.1+, JavaScript
- **Localization**: Laravel Localization

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For issues and questions, please open an issue on GitHub.
