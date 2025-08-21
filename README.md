# Greenwich AnswerHub

A comprehensive Q&A platform designed for the University of Greenwich community. This modern web application allows students and faculty to ask questions, provide answers, and engage in academic discussions in a structured, user-friendly environment with professional design and deployment capabilities.

## 🌟 Features

### User Management
- **User Registration & Authentication**: Secure signup and login system with bcrypt password hashing
- **User Profiles**: Modern profile pages with profile picture upload and user statistics
- **User Directory**: Browse and search through all registered users with pagination
- **Profile Management**: Edit personal details (username, email) and manage account settings
- **Achievement System**: Dynamic badges based on user activity and contributions

### Q&A System
- **Question Posting**: Users can ask questions with titles, detailed descriptions, and optional image attachments
- **Answer System**: Provide detailed answers with rich text support and edit/delete functionality
- **Categorization**: Organize questions by categories with visual category tags
- **Question Management**: Edit or delete your own questions with proper ownership validation
- **Image Support**: Upload images with questions for better context
- **Answer Management**: Edit and delete your own answers with confirmation dialogs

### Modern User Experience
- **Responsive Design**: Bootstrap 4-powered responsive UI that works on all devices
- **Clean URLs**: SEO-friendly URLs without .php extensions using mod_rewrite
- **Active Navigation**: Dynamic highlighting of current page in navigation
- **Professional Templates**: Modern card-based layouts with gradients and animations
- **Pagination**: Efficient browsing with modern pagination controls
- **Search & Filter**: Advanced filtering and search capabilities
- **User Statistics**: Comprehensive metrics including helpfulness scores

### Administration Panel
- **Admin Dashboard**: Complete administrative control panel with modern design
- **User Management**: Admin can view, edit, and delete user accounts
- **Question Moderation**: Review, edit, or remove questions and answers
- **Category Management**: Create, edit, and delete question categories
- **Content Oversight**: Full control over platform content and user interactions
- **Analytics**: User activity monitoring and platform statistics

### Security Features
- **Session Management**: Secure user sessions with proper authentication checks
- **Input Sanitization**: Protection against XSS and SQL injection attacks
- **Access Control**: Role-based access with user and admin permissions
- **Data Validation**: Comprehensive input validation and error handling
- **CSRF Protection**: Protection against cross-site request forgery
- **Password Security**: Bcrypt hashing with proper salt handling

### Deployment Features
- **Production Ready**: Optimized for cloud deployment on DigitalOcean, Railway, or similar platforms
- **Database Flexibility**: Works with both local MySQL and cloud database services
- **Environment Configuration**: Supports environment variables for different deployment stages
- **Auto-deployment**: GitHub webhook integration for automated deployments
- **SSL Ready**: Configured for HTTPS with Let's Encrypt integration

## 🛠️ Technology Stack

### Backend
- **PHP 8.1+**: Modern PHP with improved performance and security
- **MySQL 8.0+**: Robust database management system
- **PDO**: PHP Data Objects for secure database interactions
- **Nginx**: High-performance web server and reverse proxy

### Frontend
- **HTML5**: Semantic markup with modern standards
- **CSS3**: Custom styling with CSS Grid and Flexbox
- **Bootstrap 4.6**: Responsive UI framework with custom components
- **JavaScript**: Vanilla JS for interactive features
- **FontAwesome**: Professional icon library

### DevOps & Deployment
- **Git**: Version control with GitHub integration
- **Nginx**: Web server configuration with clean URL routing
- **PM2**: Process management for Node.js applications (if applicable)
- **Let's Encrypt**: Free SSL certificates
- **DigitalOcean**: Cloud hosting platform

### Architecture
- **MVC Pattern**: Clean Model-View-Controller architecture
- **Template System**: Separate templates for different user roles
- **Modular Design**: Reusable functions and components
- **Clean URLs**: SEO-friendly routing with .htaccess

## 📁 Project Structure

```
answerhub/
├── 📄 index.php                    # Landing page with modern design
├── 📄 login.php                    # User authentication
├── 📄 registration.php             # User signup with validation
├── 📄 questions.php                # Browse all questions with modern layout
├── 📄 question_page.php            # Individual question view
├── 📄 userlist.php                 # User directory with search
├── 📄 user_page.php                # User profile view with statistics
├── 📄 about.php                    # About page
├── 📄 404.php                      # Custom error page
├── 📄 incorrect.php                # Login error page
├── 📄 .htaccess                    # URL rewriting and security rules
│
├── 📁 includes/                    # Core system files
│   ├── 📄 DatabaseConnection.php  # Database configuration with environment support
│   ├── 📄 DatabaseFunctions.php   # Comprehensive database operations
│   ├── 📄 process.php              # Authentication processing
│   ├── 📄 session.php              # Session management
│   ├── 📄 check_session.php       # Session validation
│   └── 📄 redirect_logged_users.php # User redirection logic
│
├── 📁 templates/                   # Modern public view templates
│   ├── 📄 layout.html.php          # Main responsive layout
│   ├── 📄 home.html.php            # Homepage with hero section
│   ├── 📄 login.html.php           # Modern login form
│   ├── 📄 registration.html.php    # Registration with validation
│   ├── 📄 questions.html.php       # Questions listing with cards
│   ├── 📄 question_page.html.php   # Question detail with answers
│   ├── 📄 user_page.html.php       # User profile with statistics
│   ├── 📄 userlist.html.php        # User directory with pagination
│   ├── 📄 about.html.php           # About page template
│   ├── 📄 404.html.php             # Modern error page
│   ├── 📄 incorrect.html.php       # Login error with guidance
│   └── 📄 styles.css               # Custom CSS with modern design
│
├── 📁 user/                        # Authenticated user area
│   ├── 📄 user_index.php           # User dashboard with overview
│   ├── 📄 profile.php              # Profile management
│   ├── 📄 questions.php            # User's questions with modern layout
│   ├── 📄 question_page.php        # Question view with edit/delete
│   ├── 📄 new_question.php         # Create new question with rich editor
│   ├── 📄 question_edit.php        # Edit questions with validation
│   ├── 📄 question_delete.php      # Delete with confirmation
│   ├── 📄 answer_edit.php          # Edit answers functionality
│   ├── 📄 answer_delete.php        # Delete answers with confirmation
│   ├── 📄 user_page.php            # View other users (authenticated)
│   ├── 📄 userlist.php             # User directory (authenticated)
│   ├── 📄 details_edit.php         # Edit profile details
│   ├── 📄 upload_image.php         # Profile image upload
│   ├── 📄 delete.php               # Account deletion
│   ├── 📄 logout.php               # User logout
│   └── 📁 user_templates/          # User-specific modern templates
│
├── 📁 admin/                       # Administration panel
│   ├── 📄 home.php                 # Admin dashboard with analytics
│   ├── 📄 questions.php            # Manage all questions
│   ├── 📄 question_page.php        # Question management view
│   ├── 📄 question_edit.php        # Edit any question
│   ├── 📄 question_delete.php      # Delete any question
│   ├── 📄 userlist.php             # Manage all users
│   ├── 📄 user_page.php            # User management view
│   ├── 📄 delete_user.php          # Delete user accounts
│   ├── 📄 categories.php           # Category management
│   ├── 📄 category_edit.php        # Edit categories
│   ├── 📄 category_delete.php      # Delete categories
│   └── 📁 admin_templates/         # Admin-specific templates
│
├── 📁 images/                      # Static assets
│   ├── 📄 campus.png               # Campus image
│   ├── 📄 login_image.jpg          # Login page image
│   ├── 📄 registration_image.jpg   # Registration page image
│   ├── 📄 University-of-Greenwich.svg # University logo
│   └── 📄 imgs.jpg                 # Default profile image
│
└── 📁 deployment/                  # Deployment configurations
    ├── 📄 nginx.conf               # Nginx configuration
    ├── 📄 deploy.sh                # Deployment script
    └── 📄 ecosystem.config.js      # PM2 configuration (if needed)
```

## 🚀 Installation & Deployment

### Local Development (XAMPP)
```bash
# Clone the repository
git clone https://github.com/yourusername/answerhub.git
cd answerhub

# Start XAMPP and create database
# Import database schema (see Database Setup section)

# Configure database connection in includes/DatabaseConnection.php
# Access via http://localhost/answerhub
```

### Production Deployment (DigitalOcean Droplet)

#### Prerequisites
- **DigitalOcean Droplet**: $5/month (1GB RAM) minimum
- **Domain Name**: Optional but recommended
- **SSH Access**: Key-based authentication preferred

#### Quick Deployment
```bash
# Connect to your droplet
ssh root@your-droplet-ip

# Run the automated setup script
wget https://raw.githubusercontent.com/yourusername/answerhub/main/deployment/setup.sh
chmod +x setup.sh
./setup.sh

# Deploy your application
git clone https://github.com/yourusername/answerhub.git /var/www/answerhub
```

#### Manual Deployment Steps
```bash
# Update system
apt update && apt upgrade -y

# Install required packages
apt install nginx mysql-server php8.1-fpm php8.1-mysql php8.1-cli git -y

# Configure services
systemctl enable nginx mysql php8.1-fpm
systemctl start nginx mysql php8.1-fpm

# Set up database
mysql_secure_installation
# Create database and user (see Database Setup)

# Configure Nginx (see deployment/nginx.conf)
# Deploy application files
# Set up SSL with Let's Encrypt
```

### Cloud Deployment Alternatives

#### Railway (Recommended for PHP)
```toml
# railway.toml
[build]
builder = "nixpacks"

[deploy]
startCommand = "php -S 0.0.0.0:$PORT -t ."
```

#### Vercel + PlanetScale
- Deploy frontend on Vercel
- Use PlanetScale for MySQL database
- Serverless PHP functions for backend

## 🗄️ Database Setup

### Database Schema
```sql
-- Users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    profile_image LONGBLOB,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Categories table
CREATE TABLE category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    categoryName VARCHAR(255) NOT NULL
);

-- Questions table
CREATE TABLE question (
    id INT AUTO_INCREMENT PRIMARY KEY,
    questiontitle VARCHAR(255) NOT NULL,
    questiontext TEXT NOT NULL,
    questiondate DATE NOT NULL,
    imageData LONGBLOB,
    userid INT,
    categoryid INT,
    FOREIGN KEY (userid) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (categoryid) REFERENCES category(id)
);

-- Answers table
CREATE TABLE answer (
    id INT AUTO_INCREMENT PRIMARY KEY,
    answertext TEXT NOT NULL,
    answerdate DATE NOT NULL,
    questionid INT,
    userid INT,
    FOREIGN KEY (questionid) REFERENCES question(id) ON DELETE CASCADE,
    FOREIGN KEY (userid) REFERENCES users(id) ON DELETE CASCADE
);
```

### Environment Configuration
```php
// includes/DatabaseConnection.php for production
$host = $_ENV['DB_HOST'] ?? 'localhost';
$dbname = $_ENV['DB_NAME'] ?? 'answerhub';
$username = $_ENV['DB_USER'] ?? 'root';
$password = $_ENV['DB_PASSWORD'] ?? '';
```

## 🎯 Usage Guide

### For Students/Users
1. **Register**: Create account with username, email, and secure password
2. **Login**: Access personalized dashboard with statistics
3. **Ask Questions**: Post questions with rich text, images, and categories
4. **Answer Questions**: Provide helpful answers with edit/delete capabilities
5. **Manage Profile**: Update information, upload profile pictures, view achievements
6. **Browse Community**: Explore questions by category and user profiles

### For Administrators
1. Access admin panel at `/admin/home`
2. **User Management**: Comprehensive user account administration
3. **Content Moderation**: Question and answer management tools
4. **Category Organization**: Create and manage question categories
5. **Platform Analytics**: Monitor user activity and engagement metrics

## 🔧 Modern Features

### Clean URL System
- SEO-friendly URLs without .php extensions
- Automatic redirects from old URLs
- Consistent navigation experience

### Responsive Design
- Mobile-first approach with Bootstrap 4
- Professional card-based layouts
- Modern color schemes and typography

### User Experience Enhancements
- Active page highlighting in navigation
- Loading states and smooth transitions
- Error handling with user-friendly messages
- Confirmation dialogs for destructive actions

### Performance Optimizations
- Optimized database queries with pagination
- Efficient image handling and storage
- Cached templates and reduced server load

## 🛡️ Security Implementation

### Authentication & Authorization
- **Password Security**: Bcrypt hashing with salt
- **Session Management**: Secure session handling with timeout
- **Access Control**: Role-based permissions (User/Admin)
- **CSRF Protection**: Token-based request validation

### Data Protection
- **SQL Injection Prevention**: Prepared statements throughout
- **XSS Protection**: Input sanitization and output escaping
- **File Upload Security**: Type validation and size limits
- **Data Validation**: Server-side validation for all inputs

### Production Security
- **HTTPS Enforcement**: SSL/TLS encryption
- **Security Headers**: HSTS, CSP, and other security headers
- **Rate Limiting**: Protection against brute force attacks
- **Error Handling**: Secure error messages without information disclosure

## 📊 Performance Metrics

### Recommended Server Requirements
- **Minimum**: 1GB RAM, 1 vCPU, 25GB SSD ($5/month droplet)
- **Recommended**: 2GB RAM, 2 vCPU, 50GB SSD ($12/month droplet)
- **High Traffic**: 4GB RAM, 2 vCPU, 80GB SSD ($24/month droplet)

### Expected Performance
- **Response Time**: <500ms for most pages
- **Concurrent Users**: 50-100 users (1GB RAM), 200+ users (2GB RAM)
- **Database**: Optimized queries with proper indexing
- **Uptime**: 99.9% with proper hosting setup

## 🚀 Future Enhancements

### Planned Features
- **Real-time Notifications**: WebSocket integration for live updates
- **Advanced Search**: Full-text search with Elasticsearch
- **API Development**: RESTful API for mobile app integration
- **Social Features**: User following, question bookmarking
- **Analytics Dashboard**: Detailed user and content analytics

### Technical Improvements
- **Microservices**: Gradual migration to microservices architecture
- **CDN Integration**: Static asset delivery optimization
- **Caching Layer**: Redis/Memcached for improved performance
- **Docker Support**: Containerized deployment options

## 📝 Contributing

### Development Setup
```bash
# Fork and clone the repository
git clone https://github.com/st4977f/answerhub.git
cd answerhub

# Create feature branch
git checkout -b feature/your-feature-name

# Make changes and test locally
# Submit pull request with detailed description
```

### Code Standards
- PSR-12 coding standards for PHP
- Semantic HTML5 markup
- Mobile-first CSS approach
- Comprehensive inline documentation

## 📄 License

Copyright © 2025 - Suleman Tunkara

This project is developed for educational purposes at the University of Greenwich. All rights reserved.

## 🤝 Support & Contact

- **Developer**: Suleman Tunkara
- **Institution**: University of Greenwich
- **Project Type**: Academic Web Development Project
- **Technology Stack**: PHP, MySQL, Bootstrap, Modern Web Standards

---

**Note**: This platform is designed as a learning project showcasing modern web development practices, security implementation, and cloud deployment strategies.

