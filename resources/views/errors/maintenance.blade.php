<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>الموقع مؤقتًا خارج الخدمة</title>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
<style>
    :root{
        --bg: #0f1724;
        --accent: #ff6b6b;
        --text: #e6eef6;
        --card: rgba(255,255,255,0.05);
    }
    *{box-sizing:border-box;}
    body{
        margin:0;
        height:100vh;
        font-family:'Cairo', sans-serif;
        display:flex;
        justify-content:center;
        align-items:center;
        background: linear-gradient(135deg, #1e293b, #0f1724);
        color: var(--text);
    }
    .container{
        text-align:center;
        background: var(--card);
        padding: 50px 40px;
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.5);
        backdrop-filter: blur(8px);
        max-width: 400px;
        width: 90%;
    }
    .container svg{
        width: 120px;
        height: 120px;
        margin-bottom: 30px;
        animation: float 3s ease-in-out infinite;
    }
    @keyframes float{
        0%{transform: translateY(0);}
        50%{transform: translateY(-15px);}
        100%{transform: translateY(0);}
    }
    h2{
        font-size: 22px;
        margin-bottom: 15px;
        font-weight: 600;
    }
    p{
        font-size: 16px;
        margin-bottom: 25px;
        color: #b0b8c1;
        line-height: 1.5;
    }
    .btn{
        padding: 12px 25px;
        border:none;
        border-radius: 10px;
        cursor:pointer;
        font-weight:600;
        font-size:15px;
        transition: 0.3s;
    }
    .btn-primary{
        background: var(--accent);
        color: #fff;
    }
    .btn-primary:hover{
        opacity: 0.85;
    }
</style>
</head>
<body>
<div class="container">
    <!-- أيقونة SVG -->
    <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="32" cy="32" r="30" stroke="#ff6b6b" stroke-width="4"/>
        <line x1="32" y1="16" x2="32" y2="36" stroke="#ff6b6b" stroke-width="4" stroke-linecap="round"/>
        <circle cx="32" cy="46" r="2" fill="#ff6b6b"/>
    </svg>

    <h2>الموقع معطل مؤقتًا</h2>
    <p>نعتذر عن الإزعاج، نحن نعمل على صيانة الموقع وسيعود للعمل قريبًا.</p>
    <button class="btn btn-primary" onclick="location.reload();">حاول التحديث</button>
</div>
</body>
</html>
