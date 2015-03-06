# PostmarkSwiftMailerBundle

A Symfony2 bundle that provides a Postmark transport implementation for SwiftMailer

## Installation

### Add bundle to composer.json

    "require": {
        "php": ">=5.3.2",
        "symfony/symfony": "~2.1",
        "_comment": "your other packages",
    
        "accord/postmark-swiftmailer-bundle": "dev-master",
    }

### Add AccordPostmarkSwiftMailerBundle to application kernel

    // app/AppKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new Accord\PostmarkSwiftMailerBundle\AccordPostmarkSwiftMailerBundle(),
            // ...
        );
    }

### Add your API key to app/config/config.yml

    accord_postmark_swift_mailer:
        api_key: POSTMARK_API_KEY
        use_ssl: true # Optional, true by default

### Configure Swiftmailer to use this new transport in app/config/config.yml

    swiftmailer:
        transport: accord_postmark