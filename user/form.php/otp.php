<?php
session_start();
if(!isset($_SESSION['OTP'])) {
    header("Location: forgot_password.php");
    exit();
}

// Handle resend OTP request
if(isset($_POST['resend'])) {
    // Generate new OTP
    $_SESSION['OTP'] = rand(111111, 999999);
    echo json_encode(['success' => true]);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification - ManishaEnterprise</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .animate-gradient {
            background: linear-gradient(-45deg, #4f46e5, #7c3aed, #9333ea, #6366f1);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .otp-input {
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 1.5rem;
            margin: 0 4px;
            border-radius: 8px;
            border: 2px solid #e5e7eb;
            transition: all 0.3s ease;
        }
        .otp-input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
            outline: none;
        }
    </style>
</head>
<body class="animate-gradient min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo Section -->
        <div class="text-center mb-8">
            <div class="inline-block p-4 rounded-full bg-white/10 backdrop-blur-sm mb-4">
                <i class="fas fa-shield-alt text-4xl text-white"></i>
            </div>
            <h1 class="text-4xl font-bold text-white mb-2">Verify OTP</h1>
            <p class="text-white/80">
                We've sent a verification code to<br>
                <span class="font-semibold">+91 <?php echo $_SESSION['reset_mobile']; ?></span>
            </p>
        </div>

        <!-- OTP Form -->
        <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-2xl p-8">
            <?php if(isset($_GET['msg'])){ ?>
                <div class="mb-4 p-4 rounded-lg <?php echo strpos($_GET['msg'], 'Invalid') !== false ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700'; ?>">
                    <?php echo $_GET['msg']; ?>
                </div>
            <?php } ?>

            <form action="Verify-otp.php" method="POST" class="space-y-6">
                <!-- OTP Input -->
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-gray-700">Enter 6-digit OTP</label>
                    <div class="flex justify-center space-x-2">
                        <input type="number" name="otp" class="w-full h-12 text-center text-xl font-semibold rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 outline-none" 
                            placeholder="Enter OTP" required maxlength="6" pattern="\d{6}">
                    </div>
                    <input type="hidden" name="phone" value="<?php echo $_SESSION['phone']; ?>">
                </div>

                <!-- Timer and Resend -->
                <div class="text-center text-sm text-gray-600">
                    <span id="timer" class="font-medium">00:30</span>
                    <button type="button" id="resendBtn" class="text-purple-600 font-medium ml-2 hover:text-purple-700 disabled:text-gray-400" disabled>
                        Resend OTP
                    </button>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full h-12 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium rounded-lg hover:from-purple-700 hover:to-indigo-700 focus:ring-4 focus:ring-purple-300 transition-all duration-200 flex items-center justify-center space-x-2">
                    <i class="fas fa-check-circle"></i>
                    <span>Verify OTP</span>
                </button>

                <!-- Back Link -->
                <div class="text-center">
                    <a href="forgot_password.php" class="text-sm text-gray-600 hover:text-purple-600 transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Change Phone Number
                    </a>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8 text-white/60 text-sm">
            © 2024 ManishaEnterprise. All rights reserved.
        </div>
    </div>

    <script src="https://kit.fontawesome.com/cd899bf2d5.js" crossorigin="anonymous"></script>
    <script>
        // Timer functionality
        let timeLeft = 30;
        const timerDisplay = document.getElementById('timer');
        const resendBtn = document.getElementById('resendBtn');

        function updateTimer() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            timerDisplay.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            
            if (timeLeft === 0) {
                clearInterval(timer);
                resendBtn.disabled = false;
                timerDisplay.textContent = "";
            } else {
                timeLeft--;
            }
        }

        let timer = setInterval(updateTimer, 1000);

        // Resend OTP functionality
        resendBtn.addEventListener('click', async function() {
            try {
                const response = await fetch('otp.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'resend=true'
                });
                
                const data = await response.json();
                
                if(data.success) {
                    // Reset timer
                    timeLeft = 30;
                    resendBtn.disabled = true;
                    timer = setInterval(updateTimer, 1000);
                    
                    // Show success message
                    const successDiv = document.createElement('div');
                    successDiv.className = 'mb-4 p-4 rounded-lg bg-green-100 text-green-700';
                    successDiv.textContent = 'New OTP has been sent successfully!';
                    document.querySelector('form').insertBefore(successDiv, document.querySelector('form').firstChild);
                    
                    // Remove success message after 3 seconds
                    setTimeout(() => {
                        successDiv.remove();
                    }, 3000);
                }
            } catch(error) {
                console.error('Error:', error);
            }
        });

        // Prevent form resubmission on page refresh
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>
</html>
