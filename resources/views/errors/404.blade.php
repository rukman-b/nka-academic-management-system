<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        /* General Styles */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        .container {
            max-width: 600px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }

        h1 {
            font-size: 6rem;
            margin: 0;
            color: #4CAF50; /* Green accent */
        }

        h2 {
            font-size: 2rem;
            margin: 10px 0;
        }

        p {
            font-size: 1.2rem;
            margin: 20px 0;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            font-size: 1rem;
            color: #fff;
            background: #4CAF50; /* Green button */
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        a:hover {
            background: #45a049; /* Darker green on hover */
        }

        /* Animation for the 404 text */
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        h1 {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>404</h1>
        <h2>Oops! Page Not Found</h2>
        <p>
            The page you're looking for doesn't exist or has been moved.
            Let's get you back on track!
        </p>
        <a href="/">Go to Homepage</a>
    </div>
</body>
</html>