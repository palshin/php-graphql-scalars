<?php
declare(strict_types=1);

namespace Palshin\GraphQLScalars\Invariants;

use Palshin\GraphQLScalars\Abstracts\StringInvariant;

class EmailInvariant implements StringInvariant
{
  public function __invoke(string $value): bool
  {
    return !!filter_var($value, FILTER_VALIDATE_EMAIL);
  }

  public function getErrorMessage(): string
  {
    return 'Value should be a valid email';
  }
}
