<?php
// Product data store
$PRODUCTS = array(
    'web-dev' => array(
        'title' => 'Web Development',
        'image' => 'web-development.jpg',
        'summary' => 'Custom web applications built with modern frameworks.',
        'price' => '$2,500+',
        'description' => 'Transform your digital presence with our custom web development solutions. We create responsive, user-friendly websites that drive engagement and conversions.',
        'features' => array(
            'Responsive Design',
            'E-commerce Solutions',
            'Content Management Systems',
            'API Development',
            'SEO Optimization'
        ),
        'technologies' => 'HTML5, CSS3, JavaScript, PHP, React, Node.js'
    ),
    'mobile-dev' => array(
        'title' => 'Mobile App Development',
        'image' => 'mobile-development.jpg',
        'summary' => 'Native and cross-platform mobile applications.',
        'price' => '$5,000+',
        'description' => 'Reach your customers on any device with our mobile app development services. We build native and cross-platform apps that deliver exceptional user experiences.',
        'features' => array(
            'iOS & Android Development',
            'Cross-platform Solutions',
            'Push Notifications',
            'Offline Functionality',
            'App Store Optimization'
        ),
        'technologies' => 'Swift, Kotlin, React Native, Flutter'
    ),
    'cloud-services' => array(
        'title' => 'Cloud Solutions',
        'image' => 'cloud-services.jpg',
        'summary' => 'Scalable cloud infrastructure and migration.',
        'price' => '$3,000+',
        'description' => 'Modernize your infrastructure with our cloud solutions. We help businesses leverage the power of cloud computing for better scalability and reliability.',
        'features' => array(
            'Cloud Migration',
            'AWS/Azure/GCP Setup',
            'Serverless Architecture',
            'Auto-scaling Solutions',
            'Cloud Security'
        ),
        'technologies' => 'AWS, Azure, Google Cloud, Docker, Kubernetes'
    ),
    'ai-ml' => array(
        'title' => 'AI & Machine Learning',
        'image' => 'ai-ml.jpg',
        'summary' => 'Intelligent automation and data analysis.',
        'price' => '$4,000+',
        'description' => 'Harness the power of artificial intelligence to transform your business. Our AI solutions help you automate processes and gain valuable insights from your data.',
        'features' => array(
            'Predictive Analytics',
            'Natural Language Processing',
            'Computer Vision',
            'Chatbots',
            'Recommendation Systems'
        ),
        'technologies' => 'TensorFlow, PyTorch, scikit-learn, OpenAI'
    ),
    'cybersecurity' => array(
        'title' => 'Cybersecurity',
        'image' => 'cybersecurity.jpg',
        'summary' => 'Comprehensive security solutions.',
        'price' => '$2,500+',
        'description' => 'Protect your digital assets with our comprehensive security solutions. We help organizations identify and mitigate security risks.',
        'features' => array(
            'Security Audits',
            'Penetration Testing',
            'Incident Response',
            'Security Training',
            'Compliance Management'
        ),
        'technologies' => 'SIEM, IDS/IPS, Firewall, Encryption'
    ),
    'data-analytics' => array(
        'title' => 'Data Analytics',
        'image' => 'data-analytics.jpg',
        'summary' => 'Transform data into actionable insights.',
        'price' => '$3,000+',
        'description' => 'Turn your data into actionable insights with our analytics solutions. We help businesses make data-driven decisions with confidence.',
        'features' => array(
            'Business Intelligence',
            'Data Visualization',
            'Real-time Analytics',
            'Custom Dashboards',
            'Predictive Modeling'
        ),
        'technologies' => 'Python, R, Tableau, Power BI'
    ),
    'devops' => array(
        'title' => 'DevOps Solutions',
        'image' => 'devops.jpg',
        'summary' => 'Streamline development and operations.',
        'price' => '$3,500+',
        'description' => 'Accelerate your software delivery with our DevOps solutions. We help teams collaborate better and deploy faster with automated pipelines.',
        'features' => array(
            'CI/CD Implementation',
            'Infrastructure as Code',
            'Monitoring & Logging',
            'Container Orchestration',
            'Automated Testing'
        ),
        'technologies' => 'Jenkins, GitLab, Docker, Kubernetes'
    ),
    'blockchain' => array(
        'title' => 'Blockchain Development',
        'image' => 'blockchain.jpg',
        'summary' => 'Secure, distributed ledger solutions.',
        'price' => '$6,000+',
        'description' => 'Leverage blockchain technology for your business with our development services. We create secure, transparent, and efficient blockchain solutions.',
        'features' => array(
            'Smart Contracts',
            'DApp Development',
            'Token Creation',
            'Private Blockchains',
            'Wallet Integration'
        ),
        'technologies' => 'Ethereum, Solidity, Web3.js, Hyperledger'
    ),
    'iot' => array(
        'title' => 'IoT Solutions',
        'image' => 'iot.jpg',
        'summary' => 'Connected device solutions.',
        'price' => '$4,500+',
        'description' => 'Build connected solutions with our IoT development services. We help businesses implement secure and scalable IoT systems.',
        'features' => array(
            'Sensor Integration',
            'Real-time Monitoring',
            'Edge Computing',
            'IoT Security',
            'Data Analytics'
        ),
        'technologies' => 'Arduino, Raspberry Pi, MQTT, AWS IoT'
    ),
    'consulting' => array(
        'title' => 'IT Consulting',
        'image' => 'consulting.jpg',
        'summary' => 'Expert technology guidance.',
        'price' => '$150/hour',
        'description' => 'Get expert guidance for your technology initiatives. Our consultants help you make informed decisions and implement effective solutions.',
        'features' => array(
            'Technology Assessment',
            'Digital Transformation',
            'Project Management',
            'Risk Management',
            'Strategic Planning'
        ),
        'technologies' => 'Agile, ITIL, PMI, TOGAF'
    )
);

function get_product($id) {
    global $PRODUCTS;
    return isset($PRODUCTS[$id]) ? $PRODUCTS[$id] : null;
}

function get_all_products() {
    global $PRODUCTS;
    return $PRODUCTS;
}
?>