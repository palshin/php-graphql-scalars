<?php

declare(strict_types=1);

namespace Palshin\GraphQLScalars\Invariants;

use Palshin\GraphQLScalars\Abstracts\StringInvariant;

class StringNonEmptyInvariant implements StringInvariant
{
  public function __invoke(string $value): bool
  {
    return strlen($value) > 0;
  }

  public function getErrorMessage(): string
  {
    return 'The string should be non-empty';
  }
}
