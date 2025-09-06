<?php
// Initialize variables
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $firstName = htmlspecialchars(strip_tags($_POST['firstName']));
    $lastName = htmlspecialchars(strip_tags($_POST['lastName']));
    $phone = htmlspecialchars(strip_tags($_POST['phone']));
    $country = htmlspecialchars(strip_tags($_POST['country']));
    $interest = htmlspecialchars(strip_tags($_POST['interest']));
    $messageContent = htmlspecialchars(strip_tags($_POST['message']));
    $privacy = isset($_POST['privacy']) ? true : false;

    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email.";
    } elseif (!$firstName || !$lastName) {
        $error = "Please enter your full name.";
    } elseif (!$phone) {
        $error = "Please enter your phone number.";
    } elseif (!$country) {
        $error = "Please select your country.";
    } elseif (!$interest) {
        $error = "Please select your interest.";
    } elseif (!$privacy) {
        $error = "You must agree to our privacy policy.";
    } else {
        // Prepare email
        $to = "support@gamerzone.com"; // Your receiving email
        $subject = "New Contact Form Submission from $firstName $lastName";
        $body = "Name: $firstName $lastName\n";
        $body .= "Email: $email\n";
        $body .= "Phone: $phone\n";
        $body .= "Country: $country\n";
        $body .= "Interest: $interest\n";
        $body .= "Message: " . ($messageContent ?: 'No specific message provided') . "\n";
        $body .= "Submitted on: " . date("Y-m-d H:i:s") . "\n";
        $body .= "User Agent: " . $_SERVER['HTTP_USER_AGENT'];

        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";

        if (mail($to, $subject, $body, $headers)) {
            $success = "Message sent successfully! We'll contact you soon.";
        } else {
            $error = "Failed to send message. Please try again later.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - GamingZone</title>
    <link href="css/bootstrap-4.3.1.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
            body {
            background-image: url('images/background1.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: 'Segoe UI', sans-serif;
            color: #ffffff;
            min-height: 100vh;
        }
        
        /* Overlay to ensure text readability */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            z-index: -1;
        }

        /* Navbar styles matching your product pages */
        .navbar {
            background-color: rgba(10, 10, 30, 0.9);
        }

        .navbar .navbar-brand,
        .navbar-nav .nav-link {
            color: #ffffff !important;
        }

        .navbar .nav-link:hover {
            color: #00ffcc !important;
        }

        .search-bar {
            background-color: #222;     
            color: white;               
            border: 1px solid #444;     
            padding: 8px 12px;          
            border-radius: 8px;         
        }

        h1 {
            color: #ffffff;
            text-align: center;
            margin: 50px 0 30px;
            text-shadow: 0 0 10px #00ffff;
        }
        
        .hero-section {
            padding: 80px 0 40px 0;
            position: relative;
            color: white;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        /* Fixed Tab Styles for Bootstrap 4 */
        .nav-tabs {
            border-bottom: 2px solid rgba(255,255,255,0.2);
            margin-bottom: 0;
            background: rgba(0,0,0,0.6);
            border-radius: 10px 10px 0 0;
            padding: 10px 10px 0 10px;
        }
        
        .nav-tabs .nav-item {
            margin-bottom: -1px;
        }
        
        .nav-tabs .nav-link {
            border: none;
            color: rgba(255,255,255,0.7);
            font-weight: 500;
            padding: 15px 25px;
            border-radius: 8px 8px 0 0;
            transition: all 0.3s ease;
            background: transparent;
        }
        
        .nav-tabs .nav-link:hover {
            color: #ffffff;
            background: rgba(255,255,255,0.1);
            border: none;
        }
        
        .nav-tabs .nav-link.active {
            color: #00bfff !important;
            background: rgba(0,191,255,0.1);
            border: none;
            border-bottom: 3px solid #00bfff;
        }
        
        .contact-form {
            background: rgba(0, 0, 0, 0.8);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 0 0 15px 15px;
            box-shadow: 
                0 10px 30px rgba(0,0,0,0.5),
                inset 0 1px 0 rgba(255,255,255,0.1);
            padding: 40px;
            position: relative;
            z-index: 3;
            backdrop-filter: blur(15px);
        }
        
        .tab-content {
            color: #ffffff;
            padding: 20px 0;
        }
        
        .form-control {
            background: rgba(255,255,255,0.1);
            border: 2px solid rgba(255,255,255,0.2);
            border-radius: 8px;
            padding: 12px 15px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
            color: #ffffff;
            min-height: 48px;
        }
        
        .form-control::placeholder {
            color: rgba(255,255,255,0.5);
        }
        
        .form-control:focus {
            background: rgba(255,255,255,0.15);
            border-color: #00bfff;
            box-shadow: 0 0 0 0.2rem rgba(0,191,255,0.25);
            color: #ffffff;
        }

        /* Improved select dropdown styling */
        .custom-select {
            background: rgba(255,255,255,0.1) !important;
            border: 2px solid rgba(255,255,255,0.2);
            border-radius: 8px;
            color: #ffffff !important;
            padding: 12px 40px 12px 15px;
            margin-bottom: 15px;
            min-height: 48px;
            font-size: 16px;
            transition: all 0.3s ease;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
        }

        .custom-select:focus {
            background: rgba(255,255,255,0.15) !important;
            border-color: #00bfff;
            box-shadow: 0 0 0 0.2rem rgba(0,191,255,0.25);
            color: #ffffff !important;
            outline: none;
        }

        .custom-select option {
            background: #2a2a2a !important;
            color: #ffffff !important;
            padding: 8px;
            border: none;
        }

        .custom-select option:hover,
        .custom-select option:focus,
        .custom-select option:checked {
            background: #00bfff !important;
            color: #ffffff !important;
        }

        /* Additional fallback for browser compatibility */
        select.form-control {
            background: rgba(255,255,255,0.1) !important;
            border: 2px solid rgba(255,255,255,0.2);
            color: #ffffff !important;
            padding: 12px 40px 12px 15px;
            min-height: 48px;
            font-size: 16px;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
        }

        select.form-control:focus {
            background: rgba(255,255,255,0.15) !important;
            border-color: #00bfff;
            box-shadow: 0 0 0 0.2rem rgba(0,191,255,0.25);
            color: #ffffff !important;
        }

        select.form-control option {
            background: #2a2a2a !important;
            color: #ffffff !important;
            padding: 8px;
        }
        
        .form-label {
            color: #ffffff;
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
        }
        
        .btn-contact {
            background: linear-gradient(45deg, #00bfff, #0099cc);
            border: none;
            border-radius: 25px;
            padding: 15px 40px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            width: 100%;
            color: #ffffff;
            position: relative;
            overflow: hidden;
            font-size: 16px;
        }
        
        .btn-contact:hover {
            background: linear-gradient(45deg, #0080ff, #007aa3);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,191,255,0.4);
            color: #ffffff;
        }
        
        .btn-contact:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }
        
        .info-section {
            background: rgba(0, 0, 0, 0.6);
            padding: 60px 0;
            backdrop-filter: blur(10px);
        }
        
        .info-card {
            background: rgba(0, 0, 0, 0.7);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            box-shadow: 
                0 5px 15px rgba(0,0,0,0.3),
                inset 0 1px 0 rgba(255,255,255,0.1);
            margin-bottom: 30px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 
                0 10px 25px rgba(0,0,0,0.4),
                0 0 20px rgba(0,191,255,0.2);
            border-color: rgba(0,191,255,0.3);
        }
        
        .info-icon {
            font-size: 3rem;
            color: #00bfff;
            margin-bottom: 20px;
            text-shadow: 0 0 10px rgba(0,191,255,0.5);
        }
        
        .required {
            color: #ff6b6b;
        }
        
        .privacy-notice {
            font-size: 0.85rem;
            color: rgba(255,255,255,0.7);
            margin-top: 15px;
        }
        
        .award-badges {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 40px;
            flex-wrap: wrap;
        }
        
        .badge-item {
            text-align: center;
            padding: 15px;
            background: rgba(0, 0, 0, 0.7);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 15px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.3);
            max-width: 120px;
            backdrop-filter: blur(10px);
        }
        
        .form-check-input:checked {
            background-color: #00bfff;
            border-color: #00bfff;
        }
        
        .form-check-input:focus {
            border-color: #00bfff;
            box-shadow: 0 0 0 0.25rem rgba(0,191,255,0.25);
        }
        
        .text-cosmic {
            background: linear-gradient(45deg, #00bfff, #0099cc, #00bfff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 30px rgba(0,191,255,0.5);
        }
        
        /* Text shadow for better readability */
        h1, h2, h3, h4, h5, h6, p, li {
            text-shadow: 1px 1px 3px rgba(0,0,0,0.8);
        }
        
        .lead {
            text-shadow: 2px 2px 4px rgba(0,0,0,0.9);
        }
        
        /* Success/Error Messages */
        .alert {
            margin-top: 20px;
            border-radius: 10px;
            backdrop-filter: blur(10px);
        }
        
        .alert-success {
            background: rgba(40, 167, 69, 0.8);
            border: 1px solid rgba(40, 167, 69, 0.5);
            color: #ffffff;
        }
        
        .alert-danger {
            background: rgba(220, 53, 69, 0.8);
            border: 1px solid rgba(220, 53, 69, 0.5);
            color: #ffffff;
        }

        /* Fix for mobile responsiveness */
        @media (max-width: 768px) {
            .hero-section {
                padding: 60px 0 30px 0;
            }
            
            .contact-form {
                padding: 30px 20px;
            }
            
            .nav-tabs .nav-link {
                padding: 10px 15px;
                font-size: 14px;
            }
        }
   
    </style>
</head>
<body>
    <!-- Navbar here (copy your navbar HTML) -->

    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="contact-form">
                        <?php if($success): ?>
                            <div class="alert alert-success"><?php echo $success; ?></div>
                        <?php elseif($error): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>

                        <form method="POST" action="">
                            <div class="form-group">
                                <label class="form-label"><span class="required">*</span>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="your.email@gmail.com" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label"><span class="required">*</span>First Name</label>
                                        <input type="text" name="firstName" class="form-control" placeholder="John" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label"><span class="required">*</span>Last Name</label>
                                        <input type="text" name="lastName" class="form-control" placeholder="Doe" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label"><span class="required">*</span>Phone Number</label>
                                <input type="tel" name="phone" class="form-control" placeholder="+94 71 123 4567" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label"><span class="required">*</span>Country</label>
                                <select name="country" class="custom-select form-control" required>
                                    <option value="">Select your country</option>
                                    <option value="Sri Lanka">Sri Lanka</option>
                                    <option value="India">India</option>
                                    <option value="US">United States</option>
                                    <option value="UK">United Kingdom</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label"><span class="required">*</span>I am interested in...</label>
                                <select name="interest" class="custom-select form-control" required>
                                    <option value="">Please select</option>
                                    <option value="Gaming Laptops">Gaming Laptops</option>
                                    <option value="Accessories">Gaming Accessories</option>
                                    <option value="Consoles">Gaming Consoles</option>
                                    <option value="Custom Build">Custom PC Build</option>
                                    <option value="Support">Technical Support</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Message</label>
                                <textarea name="message" class="form-control" rows="4" placeholder="Your message here..."></textarea>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="privacy" required>
                                <label class="form-check-label privacy-notice">
                                    <span class="required">*</span>I agree to receive information about products, services and events from GamingZone.
                                </label>
                            </div>

                            <button type="submit" class="btn btn-contact">
                                <i class="fas fa-paper-plane mr-2"></i>Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer here (copy your footer HTML) -->

    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap-4.3.1.js"></script>
</body>
</html>
