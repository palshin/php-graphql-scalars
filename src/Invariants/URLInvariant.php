<?php
declare(strict_types=1);

namespace Palshin\GraphQLScalars\Invariants;

use Palshin\GraphQLScalars\Abstracts\StringInvariant;

class URLInvariant implements StringInvariant
{
  public function __invoke(string $value): bool
  {
    return !!filter_var($value, FILTER_VALIDATE_URL);
  }

  public function getErrorMessage(): string
  {
    return 'The value should be a valid URL';
  }
}
