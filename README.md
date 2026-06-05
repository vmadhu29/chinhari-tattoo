# Chinhari Tattoo Studio

A modern, premium web application built for **Chinhari Tattoo Studio**, based in Raipur, Chhattisgarh. This platform provides an immersive experience for clients to explore artist portfolios, learn about tattoo styles, and securely book appointments online.

## 🚀 Features

- **Online Booking Wizard**: A seamless, step-by-step booking process powered by Livewire, ensuring users can easily pick services, artists, and dates.
- **Secure Payments**: Integrated with Razorpay to handle deposit payments securely during the booking process.
- **Responsive Design**: A stunning, mobile-first frontend built with Tailwind CSS, featuring smooth animations and a premium dark aesthetic.
- **Robust Backend**: Built on the Laravel framework, offering top-tier security, database transaction handling, and form validation.
- **Artist & Portfolio Showcase**: Dedicated sections to highlight the studio's award-winning artists and their best work.

## 💻 Tech Stack

- **Framework**: [Laravel](https://laravel.com/) (PHP)
- **Frontend Interactivity**: [Livewire](https://laravel-livewire.com/) & Alpine.js
- **Styling**: [Tailwind CSS](https://tailwindcss.com/)
- **Database**: MySQL
- **Payments**: Razorpay API

## 🛠️ Setup Instructions

To get this project up and running locally, follow these steps:

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd chinhari-tattoo
   ```

2. **Install PHP Dependencies**
   ```bash
   composer install
   ```

3. **Install Node Dependencies**
   ```bash
   npm install
   npm run build
   ```

4. **Environment Setup**
   Copy the example environment file and generate a new application key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Update your `.env` file with your database credentials and Razorpay API keys (`RAZORPAY_KEY` and `RAZORPAY_SECRET`).

5. **Database Migrations**
   Run the migrations and seeders to set up your database:
   ```bash
   php artisan migrate --seed
   ```

6. **Storage Link**
   Create a symbolic link for the storage directory to serve uploaded images (like portfolios and reference images):
   ```bash
   php artisan storage:link
   ```

7. **Run the Development Servers**
   Start both the Laravel development server and Vite:
   ```bash
   php artisan serve
   npm run dev
   ```

## 🔒 Security

This application follows strict security practices:
- All forms are protected against CSRF attacks.
- SQL injection is prevented via Eloquent ORM parameterized queries.
- User inputs are heavily validated on the server side.
- Payments and critical database updates are wrapped in secure transactions.

## 👨‍💻 Credits

**Designed & Developed by Madhu Verma**  
Built with passion, precision, and code.

---

*© Chinhari Tattoo Studio. All rights reserved. Raipur, Chhattisgarh.*
