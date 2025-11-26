<?php
// Cookie management for product tracking
define('RECENT_COOKIE', 'recently_viewed_products');
define('POPULAR_COOKIE', 'popular_products');
define('COOKIE_DURATION', 60 * 60 * 24 * 30); // 30 days

function track_product_view($product_id) {
    $recent = get_recently_viewed();
    if (($key = array_search($product_id, $recent)) !== false) {
        unset($recent[$key]);
    }
    array_unshift($recent, $product_id);
    $recent = array_slice($recent, 0, 5); // Keep only last 5
    setcookie(RECENT_COOKIE, json_encode($recent), time() + COOKIE_DURATION, '/');

    $popular = get_most_visited();
    if (!isset($popular[$product_id])) {
        $popular[$product_id] = 0;
    }
    $popular[$product_id]++;
    
    arsort($popular);
    $popular = array_slice($popular, 0, 5, preserve_keys: true);
    setcookie(POPULAR_COOKIE, json_encode($popular), time() + COOKIE_DURATION, '/');
}

function get_recently_viewed() {
    if (isset($_COOKIE[RECENT_COOKIE])) {
        return json_decode($_COOKIE[RECENT_COOKIE], true) ?: [];
    }
    return [];
}

function get_most_visited() {
    if (isset($_COOKIE[POPULAR_COOKIE])) {
        return json_decode($_COOKIE[POPULAR_COOKIE], true) ?: [];
    }
    return [];
}

// Product data (in a real app, this would be in a database)
function get_product_data($product_id = null) {
    $products = [
        'web-dev' => [
            'title' => 'Web Development',
            'price' => '$2,500+',
            'image' => '🌐',
            'description' => 'Custom web applications built with modern frameworks and technologies. Our web development service delivers responsive, scalable, and secure solutions tailored to your business needs.',
            'features' => [
                'Responsive Design',
                'E-commerce Integration',
                'CMS Development',
                'API Integration',
                'SEO Optimization'
            ]
        ],
        'mobile-dev' => [
            'title' => 'Mobile App Development',
            'price' => '$5,000+',
            'image' => '📱',
            'description' => 'Native and cross-platform mobile applications for iOS and Android. We create engaging, high-performance mobile experiences that users love.',
            'features' => [
                'iOS & Android Development',
                'Cross-platform Solutions',
                'UI/UX Design',
                'App Store Optimization',
                'Push Notifications'
            ]
        ],
        'cloud-services' => [
            'title' => 'Cloud Solutions',
            'price' => '$3,000+',
            'image' => '☁️',
            'description' => 'Comprehensive cloud infrastructure and migration services. We help businesses leverage the power of cloud computing for better scalability and reliability.',
            'features' => [
                'Cloud Migration',
                'AWS/Azure/GCP Setup',
                'Cloud Security',
                'Performance Optimization',
                'Disaster Recovery'
            ]
        ],
        'ai-ml' => [
            'title' => 'AI & Machine Learning',
            'price' => '$4,000+',
            'image' => '🤖',
            'description' => 'Cutting-edge AI and machine learning solutions that help businesses automate processes and gain valuable insights from their data.',
            'features' => [
                'Predictive Analytics',
                'Natural Language Processing',
                'Computer Vision',
                'Recommendation Systems',
                'Automated Decision Making'
            ]
        ],
        'cybersecurity' => [
            'title' => 'Cybersecurity Services',
            'price' => '$2,500+',
            'image' => '🔒',
            'description' => 'Comprehensive security solutions to protect your digital assets. We ensure your systems and data are protected against modern threats.',
            'features' => [
                'Security Audits',
                'Penetration Testing',
                'Incident Response',
                'Security Training',
                'Compliance Management'
            ]
        ],
        'devops' => [
            'title' => 'DevOps Solutions',
            'price' => '$3,500+',
            'image' => '⚙️',
            'description' => 'Streamline your development and operations with our DevOps services. We help teams collaborate better and deploy faster.',
            'features' => [
                'CI/CD Implementation',
                'Infrastructure as Code',
                'Container Orchestration',
                'Monitoring & Logging',
                'Automation Solutions'
            ]
        ],
        'data-analytics' => [
            'title' => 'Data Analytics',
            'price' => '$3,000+',
            'image' => '📊',
            'description' => 'Transform your data into actionable insights. Our analytics services help you make data-driven decisions with confidence.',
            'features' => [
                'Business Intelligence',
                'Data Visualization',
                'Statistical Analysis',
                'Real-time Analytics',
                'Custom Dashboards'
            ]
        ],
        'blockchain' => [
            'title' => 'Blockchain Development',
            'price' => '$6,000+',
            'image' => '🔗',
            'description' => 'Innovative blockchain solutions for modern businesses. We help implement secure, transparent, and efficient blockchain systems.',
            'features' => [
                'Smart Contracts',
                'DApp Development',
                'Token Creation',
                'Blockchain Integration',
                'Consensus Mechanisms'
            ]
        ],
        'iot-solutions' => [
            'title' => 'IoT Solutions',
            'price' => '$4,500+',
            'image' => '🔌',
            'description' => 'Connect and control your devices with our IoT solutions. We build secure and scalable IoT systems for various industries.',
            'features' => [
                'IoT Architecture',
                'Sensor Integration',
                'Real-time Monitoring',
                'Edge Computing',
                'IoT Security'
            ]
        ],
        'consulting' => [
            'title' => 'IT Consulting',
            'price' => '$150/hour',
            'image' => '💡',
            'description' => 'Expert guidance for your technology initiatives. Our consultants help you make informed decisions and implement effective solutions.',
            'features' => [
                'Technology Assessment',
                'Digital Transformation',
                'Project Management',
                'Risk Management',
                'Strategic Planning'
            ]
        ]
    ];
    if ($product_id) {
        return isset($products[$product_id]) ? $products[$product_id] : null;
    }
    return $products;
}

?>