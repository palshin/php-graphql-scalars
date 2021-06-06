# GraphQL scalars

Extensive use of scalar types in GraphQL schema is one of the sure signs of good schema design. I decided to create a
package where I will collect data types that are often encountered in my work.

In my own case I use Laravel with [Lighthouse PHP](https://github.com/nuwave/lighthouse). Even though the package itself
only requires [webonyx/graphql-php](https://github.com/webonyx/graphql-php) for work, some scalars make sense only in
Laravel environment with Lighthouse.

## Installation

> :exclamation: **Package in development**

## Usage

Suppose you want to define scalar type which represent non-empty string with maximum characters' length 255. You can
combine these conditions from the two existing invariant classes:

```php
use Palshin\GraphQLScalars\Abstracts\StringScalar;
use Palshin\GraphQLScalars\Invariants\StringNonEmptyInvariant;
use Palshin\GraphQLScalars\Invariants\StringMinLengthInvariant;

class StringNonEmptyMax255Type extends StringScalar {
  public $description = 'Non-empty string with maximum length of 255 characters';

  public function getInvariants(): array {
    return [
      new StringNonEmptyInvariant(),
      new StringMinLengthInvariant(255),
    ];
  }
}
```

Also, you can define your own invariants by callback (or by class which extends base StringScalar class):

```php
use Palshin\GraphQLScalars\Abstracts\StringScalar;

class StringContainsNumberType extends StringScalar {
  public $description = 'String which contains at least one number';
  
  public function getInvariants(): array {
    return [
      fn(string $value): bool|string => 
        preg_match('/[0-9]+/', $value) !== false
          ? true
          : 'The string should contain number'
    ];
  }
}
```

You can use factory method for creating your own scalar types:

```php
use Palshin\GraphQLScalars\Abstracts\StringScalar;
use Palshin\GraphQLScalars\Invariants\EmailInvariant;

$gmailType = StringScalar::make(
  name: 'GMail',
  description: 'GMail address',
  invariants: [
    new EmailInvariant(),
    fn(string $value): bool|string => str_contains($value, '@gmail.com')
        ? true
        : 'The value should be gmail address'
  ]
);
```

As you can see, the resulting types are very project-specific. So, the package offers only the most commonly used types
and some tools for more convenient scalar types definition.

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
