<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - ANH HAO BICYCLE</title>
    <!--  font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- font google -->
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="contact.css">

</head>

<body>
    <div class="container">
        <header>
            <h1>Contact Us</h1>
            <p>We'd love to hear from you! Get in touch with us for any inquiries or bookings.</p>
        </header>

        <div class="contact-section">
            <div class="contact-form">
                <h2>Send us a message</h2>
                <form action="submit_contact_form" method="POST">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" required placeholder="Enter your name">

                    <label for="email">Your Email</label>
                    <input type="email" id="email" name="email" required placeholder="Enter your email">

                    <label for="message">Your Message</label>
                    <textarea id="message" name="message" rows="6" required placeholder="Enter your message"></textarea>

                    <button type="submit" name='btn'>
                        <a href="check_message.php" style="color:white;text-decoration:none;">Send Message</a>
                    </button>
                </form>
            </div>

            <div class="contact-info">
                <h2>Contact Information</h2>
                <p><strong>Company Name:</strong> ANH HAO BICYCLE</p>
                <p><strong>Address:</strong> Thanh Xuân, Hà Nội</p>
                <p><strong>Phone:</strong> 0123-456-789</p>
                <p><strong>Email:</strong> webbike@thuexedap.com</p>

                <h3>Follow us:</h3>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"> Facebook</i></a>
                    <a href="#"><i class="fab fa-instagram"> Instagram</i></a>
                    <a href="#"><i class="fab fa-twitter"> Twitter</i></a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>