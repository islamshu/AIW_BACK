<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 | تم تعطيل الموقع مؤقتًا</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
            direction: rtl;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1 class="display-1 text-danger fw-bold">403</h1>
        <h2 class="mb-3">تم تعطيل الموقع مؤقتًا</h2>
        <p class="text-muted">الرجاء المحاولة لاحقًا أو العودة إلى الصفحة الرئيسية.</p>
        <a href="{{ url('/') }}" class="btn btn-primary mt-3">العودة إلى الرئيسية</a>
    </div>

</body>
</html>
