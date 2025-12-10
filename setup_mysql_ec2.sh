#!/bin/bash
# Script to install MySQL on EC2 (matching local setup)
# Run this on your EC2 instance

echo "Setting up MySQL on EC2 to match local setup..."
echo ""

# Check if MySQL/MariaDB is already installed
if command -v mysql &> /dev/null; then
    echo "✓ MySQL/MariaDB is already installed"
    mysql --version
else
    echo "Installing MySQL (MariaDB - MySQL compatible)..."
    # For Amazon Linux 2
    if command -v yum &> /dev/null; then
        sudo yum install -y mariadb-server
        sudo systemctl start mariadb
        sudo systemctl enable mariadb
        echo "✓ MariaDB installed and started"
    # For Ubuntu/Debian
    elif command -v apt-get &> /dev/null; then
        sudo apt-get update
        sudo apt-get install -y mariadb-server
        sudo systemctl start mariadb
        sudo systemctl enable mariadb
        echo "✓ MariaDB installed and started"
    fi
fi

# Check if MySQL is running
if sudo systemctl is-active --quiet mariadb || sudo systemctl is-active --quiet mysqld; then
    echo "✓ MySQL/MariaDB is running"
else
    echo "Starting MySQL/MariaDB..."
    sudo systemctl start mariadb 2>/dev/null || sudo systemctl start mysqld
    sudo systemctl enable mariadb 2>/dev/null || sudo systemctl enable mysqld
    echo "✓ MySQL/MariaDB started"
fi

# Set root password to match local setup
echo ""
echo "Setting MySQL root password to match local setup..."
sudo mysql -e "ALTER USER 'root'@'localhost' IDENTIFIED BY 'Hannohinrich@12';" 2>/dev/null || \
sudo mysql -e "SET PASSWORD FOR 'root'@'localhost' = PASSWORD('Hannohinrich@12');" 2>/dev/null || \
echo "Note: Password may already be set or need manual configuration"

# Test connection
echo ""
echo "Testing MySQL connection..."
if mysql -u root -p'Hannohinrich@12' -e "SELECT 1;" &>/dev/null; then
    echo "✓ MySQL connection successful!"
    echo ""
    echo "MySQL setup complete!"
    echo ""
    echo "Next steps:"
    echo "1. Run: php setup_database.php"
    echo "2. Run: php migrate_update_rating_format.php"
else
    echo "⚠ Could not connect. You may need to:"
    echo "   sudo mysql_secure_installation"
    echo "   Or manually set password: sudo mysql -e \"ALTER USER 'root'@'localhost' IDENTIFIED BY 'Hannohinrich@12';\""
fi
