# Gully Web Shop - E-commerce Platform

A modern e-commerce platform built with vanilla PHP, featuring product management, user authentication, shopping cart functionality, and AI-powered product comparison.

## 🚀 Features

- **Product Management**: Add, edit, and manage products with categories
- **User Authentication**: Secure user registration and login system
- **Shopping Cart**: Full cart functionality with session management
- **AI Product Comparison**: Intelligent product comparison using AI
- **Admin Panel**: Complete admin interface for managing products and categories
- **Payment Integration**: Xendit payment gateway integration
- **Responsive Design**: Bootstrap-based responsive UI
- **Image Management**: Product image upload and management

## 📋 Prerequisites

Before you begin, ensure you have the following installed:

- **Docker** (version 20.10 or higher)
- **Docker Compose** (version 2.0 or higher)
- **Git** (for version control)

### Installing Docker

#### Windows

1. Download Docker Desktop from [https://www.docker.com/products/docker-desktop](https://www.docker.com/products/docker-desktop)
2. Install and restart your computer
3. Start Docker Desktop

#### macOS

1. Download Docker Desktop from [https://www.docker.com/products/docker-desktop](https://www.docker.com/products/docker-desktop)
2. Install and start Docker Desktop

#### Linux (Ubuntu/Debian)

```bash
# Update package index
sudo apt-get update

# Install prerequisites
sudo apt-get install apt-transport-https ca-certificates curl gnupg lsb-release

# Add Docker's official GPG key
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg

# Add Docker repository
echo "deb [arch=amd64 signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null

# Install Docker
sudo apt-get update
sudo apt-get install docker-ce docker-ce-cli containerd.io docker-compose-plugin

# Add user to docker group
sudo usermod -aG docker $USER

# Start Docker service
sudo systemctl start docker
sudo systemctl enable docker
```

## 🚀 Quick Start (5 Minutes)

### 1. Clone and Navigate

```bash
# Clone the repository
git clone <repository-url>
cd gullywebshop

# Or if you already have the project locally
cd gullywebshop
```

### 2. Start the Application

```bash
# Make the helper script executable
chmod +x docker-scripts.sh

# Start all services
./docker-scripts.sh start
```

### 3. Access Your Application

- **Main Application**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081
  - Username: `root`
  - Password: `gully_password`

### 4. Default Access

- **Admin Panel**: http://localhost:8080/admin_area/
- **User Registration**: http://localhost:8080/users_area/user_registration.php

## 🛠️ Detailed Installation & Setup

### Prerequisites

Before you begin, ensure you have the following installed:

- **Docker** (version 20.10 or higher)
- **Docker Compose** (version 2.0 or higher)
- **Git** (for version control)

### Installing Docker

#### Windows

1. Download Docker Desktop from [https://www.docker.com/products/docker-desktop](https://www.docker.com/products/docker-desktop)
2. Install and restart your computer
3. Start Docker Desktop

#### macOS

1. Download Docker Desktop from [https://www.docker.com/products/docker-desktop](https://www.docker.com/products/docker-desktop)
2. Install and start Docker Desktop

#### Linux (Ubuntu/Debian)

```bash
# Update package index
sudo apt-get update

# Install prerequisites
sudo apt-get install apt-transport-https ca-certificates curl gnupg lsb-release

# Add Docker's official GPG key
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg

# Add Docker repository
echo "deb [arch=amd64 signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null

# Install Docker
sudo apt-get update
sudo apt-get install docker-ce docker-ce-cli containerd.io docker-compose-plugin

# Add user to docker group
sudo usermod -aG docker $USER

# Start Docker service
sudo systemctl start docker
sudo systemctl enable docker
```

### Manual Start (Alternative)

```bash
# Build and start all containers
docker-compose up -d

# Or build and start with logs
docker-compose up -d --build
```

## 🐳 Docker Commands

### Using Helper Scripts

The project includes a helper script (`docker-scripts.sh`) for common operations:

```bash
# Start the application
./docker-scripts.sh start

# Stop the application
./docker-scripts.sh stop

# Restart the application
./docker-scripts.sh restart

# View logs
./docker-scripts.sh logs

# Rebuild containers
./docker-scripts.sh rebuild

# Access web container shell
./docker-scripts.sh shell

# Access database shell
./docker-scripts.sh db-shell

# Check container status
./docker-scripts.sh status

# Clean up everything
./docker-scripts.sh clean
```

### Direct Docker Commands

```bash
# Start services
docker-compose up -d

# Stop services
docker-compose down

# View logs
docker-compose logs -f

# View logs for specific service
docker-compose logs -f web
docker-compose logs -f db

# Rebuild containers
docker-compose up -d --build

# Access container shell
docker-compose exec web bash
docker-compose exec db mysql -u root -pgully_password gullydb

# Check container status
docker-compose ps

# Stop and remove volumes
docker-compose down -v
```

## 🔧 Development Workflow

### 1. Making Changes

1. **Start the development environment:**

   ```bash
   ./docker-scripts.sh start
   ```

2. **Make your changes** to the PHP files in your local directory

   - Changes are automatically reflected due to volume mounting
   - No need to rebuild containers for PHP file changes

3. **For database changes:**
   - Use phpMyAdmin at http://localhost:8081
   - Or connect directly to MySQL at localhost:3306

### 2. Adding Dependencies

If you need to add new PHP dependencies:

1. **Add to composer.json:**

   ```json
   {
     "require": {
       "new-package/name": "^1.0"
     }
   }
   ```

2. **Rebuild the container:**
   ```bash
   ./docker-scripts.sh rebuild
   ```

### 3. Database Changes

For database schema changes:

1. **Export current schema:**

   ```bash
   docker-compose exec db mysqldump -u root -pgully_password gullydb > new_schema.sql
   ```

2. **Update gully.sql** with your changes

3. **Rebuild containers** to apply changes:
   ```bash
   ./docker-scripts.sh rebuild
   ```

## 📝 Git Workflow

### Initial Setup

```bash
# Initialize git repository (if not already done)
git init

# Add all files
git add .

# Make initial commit
git commit -m "Initial commit: Gully Web Shop e-commerce platform"
```

### Daily Development Workflow

```bash
# 1. Pull latest changes
git pull origin main

# 2. Create a new branch for your feature
git checkout -b feature/your-feature-name

# 3. Make your changes and commit them
git add .
git commit -m "Add feature: description of changes"

# 4. Push your branch
git push origin feature/your-feature-name

# 5. Create a pull request (if using GitHub/GitLab)
# Or merge locally
git checkout main
git merge feature/your-feature-name
git push origin main
```

### Commit Guidelines

Use conventional commit messages:

```bash
# Feature additions
git commit -m "feat: add user registration functionality"

# Bug fixes
git commit -m "fix: resolve database connection issue"

# Documentation
git commit -m "docs: update README with Docker setup"

# Refactoring
git commit -m "refactor: improve database query performance"

# Breaking changes
git commit -m "feat!: change database schema structure"
```

## 🗄️ Database Management

### Accessing the Database

1. **phpMyAdmin (Web Interface):**

   - URL: http://localhost:8081
   - Username: `root`
   - Password: `gully_password`

2. **Direct MySQL Connection:**

   ```bash
   docker-compose exec db mysql -u root -pgully_password gullydb
   ```

3. **External MySQL Client:**
   - Host: `localhost`
   - Port: `3306`
   - Username: `root`
   - Password: `gully_password`
   - Database: `gullydb`

### Database Backup

```bash
# Create backup
docker-compose exec db mysqldump -u root -pgully_password gullydb > backup_$(date +%Y%m%d_%H%M%S).sql

# Restore backup
docker-compose exec -T db mysql -u root -pgully_password gullydb < backup_file.sql
```

## 🔍 Troubleshooting

### Common Issues

#### 1. Port Already in Use

```bash
# Check what's using the port
netstat -tulpn | grep :8080

# Kill the process or change ports in docker-compose.yml
```

#### 2. Database Connection Issues

```bash
# Check if database container is running
docker-compose ps

# Check database logs
docker-compose logs db

# Restart database container
docker-compose restart db
```

#### 3. Permission Issues

```bash
# Fix file permissions
docker-compose exec web chown -R www-data:www-data /var/www/html
```

#### 4. Container Build Issues

```bash
# Clean build
docker-compose down
docker system prune -f
docker-compose up -d --build
```

### Debugging

#### View Application Logs

```bash
# All services
docker-compose logs -f

# Specific service
docker-compose logs -f web
docker-compose logs -f db
```

#### Access Container Shell

```bash
# Web container
docker-compose exec web bash

# Database container
docker-compose exec db bash
```

#### Check Container Status

```bash
docker-compose ps
docker stats
```

### Quick Commands Reference

```bash
# Start the app
./docker-scripts.sh start

# Stop the app
./docker-scripts.sh stop

# View logs
./docker-scripts.sh logs

# Restart
./docker-scripts.sh restart

# Check status
./docker-scripts.sh status

# Rebuild
./docker-scripts.sh rebuild

# Clean everything
./docker-scripts.sh clean
```

## 🚀 Deployment

### Production Deployment

1. **Update Environment Variables:**

   ```bash
   # Create .env file for production
   cp .env.example .env
   # Edit .env with production values
   ```

2. **Update docker-compose.yml** with production settings:

   - Change default passwords
   - Configure SSL certificates
   - Set up proper volume mounts

3. **Deploy:**
   ```bash
   docker-compose -f docker-compose.prod.yml up -d
   ```

### Environment Variables

Create a `.env` file for custom configuration:

```env
# Database Configuration
DB_HOST=db
DB_USER=root
DB_PASSWORD=your_secure_password
DB_NAME=gullydb

# Application Configuration
APP_ENV=production
APP_DEBUG=false
```

## 📁 Project Structure

```
gullywebshop/
├── admin_area/              # Admin panel files
│   ├── index.php           # Admin dashboard
│   ├── insert_product.php  # Add products
│   ├── view_products.php   # View products
│   └── product_images/     # Admin uploaded images
├── users_area/             # User management
│   ├── user_login.php      # User login
│   ├── user_registration.php # User registration
│   ├── profile.php         # User profile
│   └── user_images/        # User uploaded images
├── includes/               # Shared includes
│   ├── connect.php         # Database connection
│   └── footer.php          # Footer template
├── functions/              # Common functions
│   └── common_function.php # Shared PHP functions
├── images/                 # Product images
├── vendor/                 # Composer dependencies
├── Dockerfile              # PHP container configuration
├── docker-compose.yml      # Multi-container setup
├── docker-scripts.sh       # Helper scripts
├── .dockerignore          # Docker ignore file
├── composer.json           # PHP dependencies
├── gully.sql              # Database schema
└── README.md              # This file
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 🆘 Support

For support and questions:

1. Check the troubleshooting section above
2. Review the logs using `./docker-scripts.sh logs`
3. Create an issue in the repository
4. Contact the development team

## 🔄 Updates and Maintenance

### Updating Dependencies

```bash
# Update Composer dependencies
docker-compose exec web composer update

# Rebuild container to apply changes
./docker-scripts.sh rebuild
```

### Updating Docker Images

```bash
# Pull latest images
docker-compose pull

# Rebuild with new images
./docker-scripts.sh rebuild
```

### Regular Maintenance

```bash
# Clean up unused Docker resources
docker system prune -f

# Update Docker images
docker-compose pull

# Backup database
docker-compose exec db mysqldump -u root -pgully_password gullydb > backup.sql
```

---

**Happy Coding! 🎉**
