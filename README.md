# ManishaEnterprise E-Commerce Platform

A modern, feature-rich e-commerce platform built with PHP, MySQL, and Tailwind CSS.

## 🌟 Features

### User Features
- User registration and authentication
- Secure password management with OTP verification
- Product browsing and search functionality
- Shopping cart management
- Secure checkout process
- Order tracking
- User profile management

### Admin Features
- Comprehensive dashboard
- Product management
- Order management
- User management
- Category management
- Settings configuration
- Data export capabilities
- Security settings

## 🛠️ Tech Stack

- **Frontend:**
  - HTML5
  - Tailwind CSS
  - JavaScript
  - Font Awesome Icons
  - Google Fonts (Poppins)

- **Backend:**
  - PHP
  - MySQL
  - Session Management
  - OTP Verification

- **Security:**
  - Password Hashing
  - Session Protection
  - Input Validation
  - XSS Prevention

## 📁 Project Structure

```
FULLSTACK/
├── admin/              # Admin panel files
│   ├── mystore.php     # Admin dashboard
│   ├── export.php      # Data export functionality
│   ├── settings.php    # System settings
│   └── ...            # Other admin features
├── user/               # User interface files
│   ├── form.php/       # User forms
│   │   ├── login.php
│   │   ├── register.php
│   │   ├── forgot_password.php
│   │   └── otp.php
│   └── ...            # Other user features
├── payment.php         # Payment processing
├── checkout.php        # Checkout system
├── product_search.php  # Product search functionality
└── sendEmail.php       # Email service
```

## 🚀 Getting Started

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- Composer (for PHP dependencies)

### Installation

1. Clone the repository:
   ```bash
   git clone [repository-url]
   ```

2. Configure your database:
   - Create a MySQL database
   - Import the database schema
   - Update database credentials in config files

3. Set up your web server:
   - Point your web server to the project directory
   - Ensure proper permissions are set

4. Install dependencies:
   ```bash
   npm install
   ```

5. Configure environment variables:
   - Set up your database credentials
   - Configure email settings
   - Set up payment gateway credentials

## 🔒 Security Features

- Secure password hashing
- OTP-based authentication
- Session management
- CSRF protection
- Input validation
- XSS prevention
- SQL injection protection

## 📱 Responsive Design

The platform features a fully responsive design that works seamlessly across:
- Desktop computers
- Tablets
- Mobile devices

## 🎨 UI/UX Features

- Modern, clean interface
- Intuitive navigation
- Beautiful animations
- Loading states
- Error handling
- Success notifications
- Form validation
- Responsive layouts

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👥 Authors

- Raj Kushwaha - Initial work

## 🙏 Acknowledgments

- Font Awesome for icons
- Google Fonts for typography
- Tailwind CSS for styling
- All contributors who have helped shape this project

## 📞 Support

For support, email [rk209402maurya@gmail.com] or open an issue in the repository. 