# Skymobile notifications channel for Laravel 5.

This package makes it easy to send Skymobile SMS notifications with Laravel 5.5.

**Please note that the current documentation is out-of-sync with the package.**

**Full credit to [Peter Steenbergen](http://petericebear.github.io) for his original work on [Messagebird](https://github.com/laravel-notification-channels/messagebird).**

## Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Setting up your Skymobile account](#setting-up-your-skymobile-account)
- [Usage](#usage)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)

## Requirements

You need a registered account with Skymobile since they don't accept new users.

## Installation

You can install the package via composer:

``` bash
composer require tomdewit/skymobile
```

You may install the service provider:

```php
// config/app.php
'providers' => [
    ...
    Tomdewit\Skymobile\SkymobileServiceProvider::class,
],
```

## Setting up your Skymobile account

Add your Skymobile Access Key, Default originator (name or number of sender), and default recipients to your `config/services.php`:

```php
// config/services.php
...
'Skymobile' => [
    'access_key' => env('Skymobile_ACCESS_KEY'),
    'originator' => env('Skymobile_ORIGINATOR'),
    'recipients' => env('Skymobile_RECIPIENTS'),
],
...
```

Notice: The originator can contain a maximum of 11 alfa-numeric characters.

## Usage

Now you can use the channel in your `via()` method inside the notification:

``` php
use Tomdewit\Skymobile\SkymobileChannel;
use Tomdewit\Skymobile\SkymobileMessage;
use Illuminate\Notifications\Notification;

class VpsServerOrdered extends Notification
{
    public function via($notifiable)
    {
        return [SkymobileChannel::class];
    }

    public function toSkymobile($notifiable)
    {
        return (new SkymobileMessage("Your {$notifiable->service} was ordered!"));
    }
}
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email ttomdewit@gmail.com instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Tom de Wit](http://tomdewit.com)
- [Peter Steenbergen](http://petericebear.github.io)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
