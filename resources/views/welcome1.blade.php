<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <div style="display:flex; justify-content: center; align-items: center; height: 800px; gap: 50px;">
        <div><a href="{{ route('login') }}">Login</a></div>
        <div><a href="{{ route('register') }}">Register</a></a></div>
        <div><a href="{{ route('student.login') }}">Student Login</a></div>
        <div><a href="{{ route('employer.login') }}">Employer Login</a></div>
    </div>
    
</body>
</html>