<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Temporarily Locked</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* General Styling */
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: linear-gradient(135deg, #f0f4f8, #d9e2ec);
            font-family: 'Arial', sans-serif;
        }
        
        /* Container */
        .error-container {
            background: white;
            padding: 40px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 90%;
            animation: fadeIn 0.8s ease-in-out;
        }

        /* Headings */
        h1 {
            font-size: 26px;
            font-weight: bold;
            color: #d9534f;
        }

        /* Countdown Timer */
        .timer {
            font-size: 28px;
            font-weight: bold;
            color: #d9534f;
            margin-top: 10px;
        }

        /* Information Text */
        .info-text {
            font-size: 16px;
            color: #555;
            margin-bottom: 15px;
        }

        /* Buttons */
        .retry-btn, .home-btn {
            margin-top: 15px;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
        }

        /* Retry Button */
        .retry-btn {
            background-color: #0275d8;
            color: white;
            border: none;
        }

        .retry-btn:hover {
            background-color: #025aa5;
        }

        .retry-btn:disabled {
            background-color: #a0a0a0;
            cursor: not-allowed;
        }

        /* Home Button */
        .home-btn {
            background-color: #5bc0de;
            color: white;
            text-decoration: none;
            display: inline-block;
        }

        .home-btn:hover {
            background-color: #31b0d5;
        }

        /* Fade-in Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>Account Temporarily Locked</h1>
        <p class="info-text">
            Your account has been temporarily locked due to multiple incorrect login attempts.  
            For security reasons, you must wait before trying again.
        </p>
        <p class="info-text">You can retry logging in after:</p>
        <div class="timer" id="countdown"></div>

        <!-- Buttons -->
        <button class="btn retry-btn" id="retryButton" disabled>Try Again</button>
        <br>
        <a href="{{ url('/') }}" class="btn home-btn">Return Home</a>

        <br><br>
        <p class="info-text">If you need immediate assistance, please contact <a class="text-decoration-none" href="mailto:support@apgcl.org">support@apgcl.org</a>.</p>
    </div>

    <script>
        let timeLeft = {{ session('throttle_seconds', 60) }};
        let countdownElement = document.getElementById('countdown');
        let retryButton = document.getElementById('retryButton');

        function formatTime(seconds) {
            let days = Math.floor(seconds / (24 * 60 * 60));
            let hours = Math.floor((seconds % (24 * 60 * 60)) / (60 * 60));
            let minutes = Math.floor((seconds % (60 * 60)) / 60);
            let sec = seconds % 60;

            let timeParts = [];
            if (days > 0) timeParts.push(`${days} ${days === 1 ? 'day' : 'days'}`);
            if (hours > 0) timeParts.push(`${hours} ${hours === 1 ? 'hour' : 'hours'}`);
            if (minutes > 0) timeParts.push(`${minutes} ${minutes === 1 ? 'minute' : 'minutes'}`);
            if (sec > 0 || timeParts.length === 0) timeParts.push(`${sec} ${sec === 1 ? 'second' : 'seconds'}`);

            return timeParts.join(', ');
        }

        function updateCountdown() {
            if (timeLeft > 0) {
                countdownElement.textContent = formatTime(timeLeft);
                timeLeft--;
            } else {
                countdownElement.textContent = "You can now try again!";
                retryButton.disabled = false;
                retryButton.addEventListener("click", function() {
                    window.location.href = "/login";
                });
            }
        }

        updateCountdown(); // Initial display
        setInterval(updateCountdown, 1000);
    </script>
</body>
</html>
