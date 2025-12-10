#!/bin/bash
# Script to fix git permissions on EC2
# Run this on your EC2 instance

echo "Fixing git permissions..."

# Change ownership of .git directory to ec2-user
sudo chown -R ec2-user:ec2-user .git

# Also fix ownership of the entire directory if needed
sudo chown -R ec2-user:ec2-user .

# Set proper permissions
chmod -R 755 .
chmod -R 700 .git

echo "✓ Permissions fixed! You can now run 'git pull'"

