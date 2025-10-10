<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graphic Art - TechFlow Solutions</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Navigation */
        nav {
            background: #2c3e50;
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        nav ul li {
            margin: 0 1rem;
        }
        
        nav ul li a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background 0.3s;
        }
        
        nav ul li a:hover, nav ul li a.active {
            background: #34495e;
        }
        
        /* Page Header */
        .page-header {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            padding: 2rem 0;
            text-align: center;
            backdrop-filter: blur(10px);
        }
        
        .page-header h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        /* Canvas Section */
        .canvas-section {
            padding: 3rem 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .canvas-container {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            margin-bottom: 2rem;
        }
        
        canvas {
            border: 3px solid #2c3e50;
            border-radius: 15px;
            display: block;
            margin: 0 auto;
        }
        
        .canvas-info {
            background: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            max-width: 600px;
            backdrop-filter: blur(10px);
        }
        
        .canvas-info h3 {
            color: #2c3e50;
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }
        
        .canvas-info p {
            color: #666;
            margin-bottom: 1rem;
        }
        
        .tech-details {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
            margin-top: 1rem;
        }
        
        .tech-details h4 {
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }
        
        .tech-details ul {
            list-style: none;
            padding-left: 0;
        }
        
        .tech-details li {
            padding: 0.3rem 0;
            color: #555;
        }
        
        .tech-details li:before {
            content: "🎨 ";
            margin-right: 0.5rem;
        }
        
        /* Controls */
        .controls {
            margin-top: 2rem;
            text-align: center;
        }
        
        .btn {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            margin: 0.5rem;
            transition: all 0.3s;
        }
        
        .btn:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }
        
        /* Footer */
        footer {
            background: rgba(44, 62, 80, 0.9);
            color: white;
            text-align: center;
            padding: 2rem 0;
            backdrop-filter: blur(10px);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            canvas {
                max-width: 100%;
                height: auto;
            }
            
            .page-header h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="products.php">Products/Services</a></li>
                <li><a href="news.php">News</a></li>
                <li><a href="contacts.php">Contacts</a></li>
                <li><a href="graphic.php" class="active">Graphic</a></li>
            </ul>
        </div>
    </nav>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>🎨 Graphic Art Gallery</h1>
            <p>HTML5 Canvas Animal Drawing</p>
        </div>
    </section>

    <!-- Canvas Section -->
    <section class="canvas-section">
        <div class="container">
            <div class="canvas-container">
                <canvas id="animalCanvas" width="600" height="400"></canvas>
            </div>
            
            <div class="canvas-info">
                <h3>🐱 Meet Fluffy - Our Canvas Cat!</h3>
                <p>This adorable cat was drawn using HTML5 Canvas API with JavaScript. No images were imported - everything is created programmatically using shapes, curves, and gradients.</p>
                
                <div class="tech-details">
                    <h4>Technical Implementation:</h4>
                    <ul>
                        <li>HTML5 Canvas Element (600x400 pixels)</li>
                        <li>JavaScript Drawing API</li>
                        <li>Bezier Curves for smooth shapes</li>
                        <li>Linear and Radial Gradients</li>
                        <li>Shadow Effects and Transparency</li>
                        <li>Arc and Path Drawing</li>
                        <li>Color Manipulation</li>
                    </ul>
                </div>
                
                <div class="controls">
                    <button class="btn" onclick="redrawCat()">🔄 Redraw Cat</button>
                    <button class="btn" onclick="animateCat()">✨ Animate</button>
                    <button class="btn" onclick="changeColors()">🎨 Change Colors</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2024 TechFlow Solutions. All rights reserved. | <a href="contacts.php" style="color: #3498db;">Contact Us</a></p>
        </div>
    </footer>

    <script>
        const canvas = document.getElementById('animalCanvas');
        const ctx = canvas.getContext('2d');
        
        // Color schemes
        const colorSchemes = [
            { body: '#FF6B6B', ears: '#FF8E8E', nose: '#FF4757', eyes: '#2F3542' },
            { body: '#4ECDC4', ears: '#7EDDD8', nose: '#26A69A', eyes: '#1A237E' },
            { body: '#45B7D1', ears: '#74C0FC', nose: '#1976D2', eyes: '#0D47A1' },
            { body: '#96CEB4', ears: '#A8D5BA', nose: '#66BB6A', eyes: '#1B5E20' }
        ];
        
        let currentColorScheme = 0;
        let animationId = null;
        
        function drawCat() {
            // Clear canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            const colors = colorSchemes[currentColorScheme];
            
            // Cat body (main shape)
            ctx.beginPath();
            ctx.fillStyle = colors.body;
            ctx.shadowColor = 'rgba(0,0,0,0.3)';
            ctx.shadowBlur = 10;
            ctx.shadowOffsetX = 5;
            ctx.shadowOffsetY = 5;
            
            // Body using bezier curves
            ctx.moveTo(200, 300);
            ctx.bezierCurveTo(150, 280, 100, 250, 100, 200);
            ctx.bezierCurveTo(100, 150, 150, 120, 200, 130);
            ctx.bezierCurveTo(250, 120, 300, 150, 300, 200);
            ctx.bezierCurveTo(300, 250, 250, 280, 200, 300);
            ctx.closePath();
            ctx.fill();
            
            // Reset shadow
            ctx.shadowBlur = 0;
            
            // Cat head
            ctx.beginPath();
            ctx.fillStyle = colors.body;
            ctx.arc(200, 180, 60, 0, Math.PI * 2);
            ctx.fill();
            
            // Ears
            ctx.beginPath();
            ctx.fillStyle = colors.ears;
            ctx.moveTo(160, 140);
            ctx.lineTo(150, 100);
            ctx.lineTo(180, 120);
            ctx.closePath();
            ctx.fill();
            
            ctx.beginPath();
            ctx.moveTo(240, 140);
            ctx.lineTo(250, 100);
            ctx.lineTo(220, 120);
            ctx.closePath();
            ctx.fill();
            
            // Inner ears
            ctx.beginPath();
            ctx.fillStyle = '#FFB6C1';
            ctx.moveTo(165, 130);
            ctx.lineTo(160, 110);
            ctx.lineTo(175, 120);
            ctx.closePath();
            ctx.fill();
            
            ctx.beginPath();
            ctx.moveTo(235, 130);
            ctx.lineTo(240, 110);
            ctx.lineTo(225, 120);
            ctx.closePath();
            ctx.fill();
            
            // Eyes
            ctx.beginPath();
            ctx.fillStyle = colors.eyes;
            ctx.arc(180, 170, 8, 0, Math.PI * 2);
            ctx.fill();
            
            ctx.beginPath();
            ctx.arc(220, 170, 8, 0, Math.PI * 2);
            ctx.fill();
            
            // Eye highlights
            ctx.beginPath();
            ctx.fillStyle = 'white';
            ctx.arc(182, 168, 3, 0, Math.PI * 2);
            ctx.fill();
            
            ctx.beginPath();
            ctx.arc(222, 168, 3, 0, Math.PI * 2);
            ctx.fill();
            
            // Nose
            ctx.beginPath();
            ctx.fillStyle = colors.nose;
            ctx.moveTo(200, 185);
            ctx.lineTo(195, 195);
            ctx.lineTo(205, 195);
            ctx.closePath();
            ctx.fill();
            
            // Mouth
            ctx.beginPath();
            ctx.strokeStyle = colors.nose;
            ctx.lineWidth = 2;
            ctx.moveTo(200, 195);
            ctx.lineTo(200, 210);
            ctx.moveTo(200, 210);
            ctx.lineTo(185, 215);
            ctx.moveTo(200, 210);
            ctx.lineTo(215, 215);
            ctx.stroke();
            
            // Whiskers
            ctx.beginPath();
            ctx.strokeStyle = '#8B4513';
            ctx.lineWidth = 1;
            // Left whiskers
            ctx.moveTo(150, 180);
            ctx.lineTo(120, 175);
            ctx.moveTo(150, 185);
            ctx.lineTo(120, 185);
            ctx.moveTo(150, 190);
            ctx.lineTo(120, 195);
            // Right whiskers
            ctx.moveTo(250, 180);
            ctx.lineTo(280, 175);
            ctx.moveTo(250, 185);
            ctx.lineTo(280, 185);
            ctx.moveTo(250, 190);
            ctx.lineTo(280, 195);
            ctx.stroke();
            
            // Tail
            ctx.beginPath();
            ctx.strokeStyle = colors.body;
            ctx.lineWidth = 15;
            ctx.lineCap = 'round';
            ctx.moveTo(100, 200);
            ctx.bezierCurveTo(50, 180, 30, 150, 50, 120);
            ctx.bezierCurveTo(70, 100, 100, 110, 120, 130);
            ctx.stroke();
            
            // Tail tip
            ctx.beginPath();
            ctx.fillStyle = colors.ears;
            ctx.arc(120, 130, 8, 0, Math.PI * 2);
            ctx.fill();
            
            // Paws
            ctx.beginPath();
            ctx.fillStyle = colors.body;
            ctx.arc(150, 300, 15, 0, Math.PI * 2);
            ctx.fill();
            
            ctx.beginPath();
            ctx.arc(200, 300, 15, 0, Math.PI * 2);
            ctx.fill();
            
            ctx.beginPath();
            ctx.arc(250, 300, 15, 0, Math.PI * 2);
            ctx.fill();
            
            // Paw details
            ctx.beginPath();
            ctx.fillStyle = '#FFB6C1';
            ctx.arc(150, 300, 8, 0, Math.PI * 2);
            ctx.fill();
            
            ctx.beginPath();
            ctx.arc(200, 300, 8, 0, Math.PI * 2);
            ctx.fill();
            
            ctx.beginPath();
            ctx.arc(250, 300, 8, 0, Math.PI * 2);
            ctx.fill();
        }
        
        function redrawCat() {
            drawCat();
        }
        
        function changeColors() {
            currentColorScheme = (currentColorScheme + 1) % colorSchemes.length;
            drawCat();
        }
        
        function animateCat() {
            if (animationId) {
                cancelAnimationFrame(animationId);
            }
            
            let frame = 0;
            function animate() {
                frame++;
                
                // Clear canvas
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                
                // Draw cat with slight movement
                const offsetX = Math.sin(frame * 0.1) * 5;
                const offsetY = Math.sin(frame * 0.15) * 3;
                
                ctx.save();
                ctx.translate(offsetX, offsetY);
                drawCat();
                ctx.restore();
                
                // Add sparkles
                for (let i = 0; i < 5; i++) {
                    const sparkleX = 100 + Math.random() * 400;
                    const sparkleY = 100 + Math.random() * 200;
                    const sparkleSize = Math.random() * 4 + 2;
                    
                    ctx.beginPath();
                    ctx.fillStyle = `rgba(255, 255, 255, ${Math.random()})`;
                    ctx.arc(sparkleX, sparkleY, sparkleSize, 0, Math.PI * 2);
                    ctx.fill();
                }
                
                animationId = requestAnimationFrame(animate);
                
                // Stop animation after 3 seconds
                if (frame > 180) {
                    cancelAnimationFrame(animationId);
                    drawCat(); // Return to static state
                }
            }
            
            animate();
        }
        
        // Draw the cat when page loads
        window.onload = function() {
            drawCat();
        };
    </script>
</body>
</html>
