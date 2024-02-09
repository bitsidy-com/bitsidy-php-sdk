# Bitsidy PHP SDK

Bitsidy SDK is a toolkit for integrating Bitsidy's cryptocurrency invoice services into your PHP projects. Whether you are using Composer for dependency management or prefer manual inclusion, this SDK is designed for easy integration.

## Project Structure
- `src/BitsidySDK.php`: The core SDK file.
- `examples/example.php`: An example script demonstrating SDK usage.
- `examples/callback.php`: An example script demonstrating how to handle received callback data.
- `include.php`: For manual inclusion in projects.
- `composer.json`: Composer configuration file.

## Installation

### Using Composer
To install via Composer, run:

```bash
composer require bitsidy/bitsidy-sdk
```

Then, include the autoloader in your script:

```php
require_once 'vendor/autoload.php';
```
### Manual Installation
Download or clone the SDK and include the include.php in your project:

```php
require_once 'include.php';
```

## Usage
Refer to examples/example.php for a practical demonstration on using the Bitsidy SDK to create invoices and handle responses. For understanding how our server communicates invoice status updates, consult examples/callback.php.

## Contributing
Contributions to the Bitsidy SDK are welcome. Please ensure that your code adheres to the project's coding standards and include tests for new features or bug fixes.

## License
This project is licensed under the GPLv3.

For more information and updates, visit the project repository.