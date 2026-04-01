<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .welcome-container {
            text-align: center;
            max-width: 800px;
            padding: 20px;
        }
        .welcome-container h1 {
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            animation: slideDown 1s ease-out;
        }
        .welcome-container p {
            font-size: 1.2rem;
            margin-bottom: 40px;
            opacity: 0.95;
            animation: fadeIn 1s ease-out 0.2s both;
        }
        .btn-custom {
            padding: 12px 40px;
            font-size: 1.1rem;
            border-radius: 50px;
            font-weight: bold;
            transition: all 0.3s;
            border: none;
            animation: fadeIn 1s ease-out 0.4s both;
        }
        .btn-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        .features {
            margin-top: 60px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            animation: fadeIn 1s ease-out 0.6s both;
        }
        .feature-box {
            background: rgba(255,255,255,0.1);
            padding: 25px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            transition: all 0.3s;
            animation: scaleIn 1s ease-out;
        }
        .feature-box:hover {
            background: rgba(255,255,255,0.15);
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }
        .feature-box h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
        .feature-box p {
            font-size: 0.95rem;
            margin: 0;
            opacity: 0.9;
        }
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        .logo-emoji {
            font-size: 3rem;
            margin-bottom: 10px;
        }
    </style>
    <title>Student Management System</title>
</head>
<body>
    <div class="welcome-container">
        <div class="logo-emoji">📚</div>
        <h1>Student Management System</h1>
        <p>A comprehensive platform for managing students, teachers, grades, and attendance with ease and efficiency.</p>

        <div class="mb-4">
            <a href="/student" class="btn btn-light btn-custom me-2">Get Started ➢</a>
            <a href="/dashboard" class="btn btn-outline-light btn-custom">View Dashboard ➢</a>
        </div>

        <div class="features">
            <div class="feature-box">
                <h3>👥 Students</h3>
                <p>Manage student information, enrollment, and courses with a comprehensive database</p>
            </div>
            <div class="feature-box">
                <h3>👨‍🏫 Teachers</h3>
                <p>Track teacher profiles, qualifications, departments, and status</p>
            </div>
            <div class="feature-box">
                <h3>📊 Grades</h3>
                <p>Record, manage, and analyze student grades and academic performance</p>
            </div>
            <div class="feature-box">
                <h3>📋 Attendance</h3>
                <p>Track, report, and analyze student attendance records with ease</p>
            </div>
        </div>

        <div style="margin-top: 60px; opacity: 0.7; font-size: 0.9rem;">
            <p>Built with Laravel | Powered by Bootstrap 5</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
