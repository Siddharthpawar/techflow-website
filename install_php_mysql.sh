#!/bin/bash
# Script to install PHP MySQL extensions on EC2
# Run this on your EC2 instance

echo "Installing PHP MySQL extensions..."

# For Amazon Linux 2
if command -v yum &> /dev/null; then
    echo "Detected Amazon Linux - installing php-mysqlnd..."
    sudo yum install -y php-mysqlnd
    
    # Also install php-pdo if not already installed
    sudo yum install -y php-pdo
    
    # Restart Apache
    sudo systemctl restart httpd
    
    echo "✓ PHP MySQL extensions installed"
    echo "✓ Apache restarted"
    
# For Ubuntu/Debian
elif command -v apt-get &> /dev/null; then
    echo "Detected Ubuntu/Debian - installing php-mysql..."
    sudo apt-get update
    sudo apt-get install -y php-mysql php-pdo-mysql
    
    # Restart Apache
    sudo systemctl restart apache2
    
    echo "✓ PHP MySQL extensions installed"
    echo "✓ Apache restarted"
else
    echo "❌ Could not detect package manager"
    exit 1
fi

# Verify installation
echo ""
echo "Verifying PHP extensions..."
php -m | grep -i pdo
php -m | grep -i mysql

echo ""
echo "Done! Try running php setup_database.php again"

