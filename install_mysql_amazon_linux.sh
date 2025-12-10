#!/bin/bash
# Script to install MySQL/MariaDB on Amazon Linux
# Handles different Amazon Linux versions

echo "Detecting Amazon Linux version..."

# Check OS version
if [ -f /etc/os-release ]; then
    . /etc/os-release
    echo "OS: $NAME $VERSION"
fi

# Try different installation methods
echo ""
echo "Attempting to install MySQL/MariaDB..."

# Method 1: Try mariadb (without -server suffix)
if yum list available mariadb &>/dev/null; then
    echo "Installing mariadb..."
    sudo yum install -y mariadb mariadb-server
    sudo systemctl start mariadb
    sudo systemctl enable mariadb
    echo "✓ MariaDB installed"

# Method 2: Try MySQL 8.0
elif yum list available mysql-server &>/dev/null; then
    echo "Installing MySQL server..."
    sudo yum install -y mysql-server
    sudo systemctl start mysqld
    sudo systemctl enable mysqld
    echo "✓ MySQL installed"

# Method 3: Try Amazon Linux 2023 (uses dnf)
elif command -v dnf &> /dev/null; then
    echo "Detected Amazon Linux 2023, using dnf..."
    sudo dnf install -y mariadb105-server
    sudo systemctl start mariadb
    sudo systemctl enable mariadb
    echo "✓ MariaDB 10.5 installed"

# Method 4: Try community MySQL
else
    echo "Trying alternative installation methods..."
    # Install MySQL from MySQL repository
    sudo yum install -y https://dev.mysql.com/get/mysql80-community-release-el7-3.noarch.rpm 2>/dev/null || \
    sudo yum install -y https://dev.mysql.com/get/mysql80-community-release-el8-1.noarch.rpm 2>/dev/null || \
    echo "Could not install MySQL repository"
    
    sudo yum install -y mysql-community-server
    sudo systemctl start mysqld
    sudo systemctl enable mysqld
    echo "✓ MySQL Community Server installed"
fi

# Check what was installed
echo ""
echo "Checking installed version..."
mysql --version 2>/dev/null || mariadb --version 2>/dev/null || echo "MySQL/MariaDB not found in PATH"

# Check if service is running
if sudo systemctl is-active --quiet mariadb || sudo systemctl is-active --quiet mysqld; then
    echo "✓ MySQL/MariaDB service is running"
else
    echo "⚠ Service is not running. Attempting to start..."
    sudo systemctl start mariadb 2>/dev/null || sudo systemctl start mysqld
fi

echo ""
echo "Setup complete! Next:"
echo "1. Set root password: sudo mysql -e \"ALTER USER 'root'@'localhost' IDENTIFIED BY 'Hannohinrich@12';\""
echo "2. Run: php setup_database.php"


