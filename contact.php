<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Autoload PHPMailer classes using Composer autoload
require 'vendor/autoload.php';

$message_sent = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'harikeerthitamil@gmail.com'; // SMTP username
        $mail->Password = 'wlzzzrjnnecgluiz';  // Your Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom($email, 'Contact Form');
        $mail->addAddress('harikeerthitamil@gmail.com'); // Send to the email address provided in the form
        $mail->addReplyTo($email, 'Information');

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = nl2br($message);
        $mail->AltBody = strip_tags($message);

        $mail->send();
        $message_sent = 'Message has been sent successfully!';
    } catch (Exception $e) {
        $message_sent = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

<?php include("header.php"); ?>

<!-- breadcrumb-banner-area -->
<div class="breadcrumb-banner-area ptb-70">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-text text-center">
                    <div class="breadcrumb-menu">
                        <ul>
                            <li><a href="index.php">home</a></li>
                            <li><span>contact</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb-banner-area-end -->

<!-- map-area -->
<div class="map-area pt-90">
    <div class="container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1958.1345689443244!2d76.96771945052721!3d11.018422411430253!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba859bb9cd36e25%3A0x2b371e216f9a7f6b!2sM3%20Digital%20Media!5e0!3m2!1sen!2sin!4v1721121168236!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>
<!-- map-end -->

<!-- contact-area-start -->
<div class="contact-area pb-90">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="contact-wrapper">
                    <?php if (!empty($message_sent)) { echo "<p>$message_sent</p>"; } ?>
                    <form id="contact-form" action="" method="POST">
                        <label>Your Email (required)</label>
                        <input type="email" name="email" required>
                        <label>Subject</label>
                        <input type="text" name="subject" required>
                        <label>Your Message</label>
                        <textarea id="text" rows="10" cols="30" name="message" required></textarea>
                        <button type="submit" class="send">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- contact-area-end -->

<?php include("footer.php"); ?>

</body>
</html>
