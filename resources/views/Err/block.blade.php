<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .error-page {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f8f9fa;
            color: #343a40;
            text-align: center;
        }
        .error-content {
            animation: fadeIn 1s ease-in-out;
        }
        .error-code {
            font-size: 6rem;
            font-weight: bold;
            animation: bounce 1s infinite;
        }
        .error-message {
            font-size: 1.5rem;
            animation: fadeIn 2s ease-in-out;
        }
        .btn-home {
            margin-top: 20px;
            animation: fadeIn 3s ease-in-out;
        }
        .error-image {
            width: 100%;
            max-width: 400px;
            margin: 20px auto;
            animation: shake 1s infinite;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes shake {
            0% { transform: translate(1px, 1px) rotate(0deg); }
            10% { transform: translate(-1px, -2px) rotate(-1deg); }
            20% { transform: translate(-3px, 0px) rotate(1deg); }
            30% { transform: translate(3px, 2px) rotate(0deg); }
            40% { transform: translate(1px, -1px) rotate(1deg); }
            50% { transform: translate(-1px, 2px) rotate(-1deg); }
            60% { transform: translate(-3px, 1px) rotate(0deg); }
            70% { transform: translate(3px, 1px) rotate(-1deg); }
            80% { transform: translate(-1px, -1px) rotate(1deg); }
            90% { transform: translate(1px, 2px) rotate(0deg); }
            100% { transform: translate(1px, -2px) rotate(-1deg); }
        }
    </style>
</head>
<body>
    <div class="error-page">
        <div class="error-content">
            <img src="{{('/err.svg') }}" class="error-image" alt="Error Image">
            <div class="error-code">404</div>
            <div class="error-message">Oops! You Don't Have Access..</div>
            <!-- <a href="/" class="btn btn-primary btn-home"></a> -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>