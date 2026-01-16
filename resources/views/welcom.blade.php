<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام الإدارة</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
            animation: fadeIn 0.8s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .logo {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 20px;
        }
        
        h1 {
            color: #333;
            margin-bottom: 10px;
            font-size: 1.8rem;
        }
        
        p {
            color: #666;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        
        .dashboard-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 16px 40px;
            font-size: 18px;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin: 0 auto;
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
        
        .dashboard-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(102, 126, 234, 0.4);
        }
        
        .dashboard-btn:active {
            transform: translateY(-1px);
        }
        
        .dashboard-btn i {
            font-size: 20px;
            transition: transform 0.3s ease;
        }
        
        .dashboard-btn:hover i {
            transform: translateX(5px);
        }
        
        .footer {
            margin-top: 30px;
            color: #999;
            font-size: 14px;
        }
        
        @media (max-width: 480px) {
            .card {
                padding: 30px 20px;
            }
            
            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="card">
        <div class="logo">
            <i class="fas fa-chart-line"></i>
        </div>
      
        <button class="dashboard-btn" onclick="goToDashboard()">
            <span>الانتقال للوحة التحكم</span>
            <i class="fas fa-arrow-left"></i>
        </button>
        
        <div class="footer">
            نظام الإدارة المتكامل © 2023
        </div>
    </div>

    <script>
        function goToDashboard() {
            // ضع رابط لوحة التحكم هنا
            window.location.href = "/dashboard";
            
            // يمكنك استخدام هذا إذا أردت نافذة جديدة
            // window.open('dashboard.html', '_blank');
        }
    </script>
</body>
</html>
