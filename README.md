# GraphQL scalars

Extensive use of scalar types in GraphQL schema is one of the sure signs of good schema design.
I decided to create a package where I will collect data types that are often encountered in my work.

In my own case I use Laravel with [Lighthouse PHP](https://github.com/nuwave/lighthouse). Even though the package itself only requires [webonyx/graphql-php](https://github.com/webonyx/graphql-php) for work, some scalars make sense only in Laravel environment with Lighthouse.

## Installation

You can install the package via composer:

```bash
composer require epalshin/graphql-scalars
```

## Usage

```php
$php_graphql_scalars = new Palshin\PhpGraphqlScalars();
echo $php_graphql_scalars->echoPhrase('Hello, Palshin!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Eugene Palshin](https://github.com/palshin)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
