<?php
$nama = "John Doe";
$profesi = "Web Developer";
$umur = 25;
$email = "john.doe@email.com";
$tentang = "Saya adalah seorang web developer yang passionate dalam menciptakan solusi digital yang inovatif dan user-friendly.";
$skills = ["PHP", "JavaScript", "HTML/CSS", "MySQL", "Laravel"];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $nama ?> - <?= $profesi ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .profile-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-top: 50px;
        }
        
        .header {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            text-align: center;
            padding: 60px 40px;
        }
        
        .avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            border: 4px solid rgba(255,255,255,0.3);
        }
        
        .name {
            font-size: 2.5em;
            margin-bottom: 10px;
            font-weight: 300;
        }
        
        .title {
            font-size: 1.2em;
            opacity: 0.9;
        }
        
        .content {
            padding: 40px;
        }
        
        .section {
            margin-bottom: 30px;
        }
        
        .section h3 {
            color: #667eea;
            margin-bottom: 15px;
            font-size: 1.3em;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 5px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .info-item {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        
        .info-item strong {
            display: block;
            color: #667eea;
            margin-bottom: 5px;
        }
        
        .skills {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .skill-tag {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9em;
        }
        
        .contact-btn {
            display: inline-block;
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 25px;
            margin-top: 20px;
            transition: transform 0.3s ease;
        }
        
        .contact-btn:hover {
            transform: translateY(-2px);
        }
        
        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }
            
            .header {
                padding: 40px 20px;
            }
            
            .name {
                font-size: 2em;
            }
            
            .content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-card">
            <div class="header">
                <div class="avatar">
                    <?= strtoupper(substr($nama, 0, 1)) ?>
                </div>
                <h1 class="name"><?= $nama ?></h1>
                <p class="title"><?= $profesi ?></p>
            </div>
            
            <div class="content">
                <div class="info-grid">
                    <div class="info-item">
                        <strong>Umur</strong>
                        <?= $umur ?> tahun
                    </div>
                    <div class="info-item">
                        <strong>Email</strong>
                        <?= $email ?>
                    </div>
                </div>
                
                <div class="section">
                    <h3>Tentang Saya</h3>
                    <p><?= $tentang ?></p>
                </div>
                
                <div class="section">
                    <h3>Keahlian</h3>
                    <div class="skills">
                        <?php foreach($skills as $skill): ?>
                            <span class="skill-tag"><?= $skill ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <div class="section">
                    <a href="mailto:<?= $email ?>" class="contact-btn">Hubungi Saya</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>