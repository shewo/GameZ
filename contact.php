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
        /* Copy your previous CSS here for body, navbar, form, etc. */
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
