# Portfolio Website - Niraj Aghera

This portfolio website showcases the work, education, projects, and contact information of Niraj Aghera, a Computer Engineering student and web developer.

## Table of Contents

- [About](#about)
- [Education](#education)
- [Certificates](#certificates)
- [Projects](#projects)
- [Contact](#contact)

## About

The About section provides an overview of Niraj Aghera's background, interests, and skills. It covers his passion for web development, programming, competitive coding, and more.

## Education

This section details Niraj's educational journey, including his secondary and higher secondary education, and his ongoing pursuit of a B.Tech in Computer Engineering from Dharmsinh Desai University.

## Certificates

The Certificates section displays certifications achieved by Niraj from various online platforms like Coursera and HackerRank. Each certificate is accompanied by a brief description and a link to verify the certification.

## Projects

The Projects section showcases some of Niraj's notable projects. Each project is presented with an image and a link to view the project live.

## Contact

The Contact section offers a form to send messages to Niraj. It collects the sender's first name, last name, email, subject, and message. It also includes a Google reCAPTCHA for spam prevention.

### Setting Up the Contact Form

To set up the contact form, follow these steps:

1. **Email Configuration**: Create an email account dedicated to sending and receiving messages. Configure the `send.php` file to use the credentials of this email account for sending emails.

2. **Google reCAPTCHA**: Obtain a reCAPTCHA site key from the Google reCAPTCHA Admin Console. Replace the `data-sitekey` attribute in the form with your reCAPTCHA site key.

3. **Environment Variables**: For security reasons, avoid hardcoding sensitive information like API keys or passwords directly into files. Use environment variables to store sensitive data.

    ```bash
    export GMAIL_USERNAME='your_email@gmail.com'
    export GMAIL_APP_PASSWORD='your_app_password'
    export RECAPTCHA_SITE_KEY='your_recaptcha_site_key'
    ```

    Replace `'your_email@gmail.com'`, `'your_app_password'`, and `'your_recaptcha_site_key'` with your actual email address, app password (if required by your email provider), and reCAPTCHA site key, respectively.

    **Note**: Ensure that sensitive information stored as environment variables is not exposed in publicly accessible files.

4. **Composer Configuration**:
   
   - Add the following line to your `composer.json` file:

     ```json
     "phpmailer/phpmailer": "^6.8.1"
     ```

   - Run the command:

     ```bash
     composer require phpmailer/phpmailer
     ```

5. **Gmail XOAUTH2 Authentication (Optional)**: If using Gmail XOAUTH2 authentication, add a dependency on the `league/oauth2-client` package in your `composer.json`.

    ```json
    "require": {
        "phpmailer/phpmailer": "^6.8.1",
        "league/oauth2-client": "^3.0"
    }
    ```
