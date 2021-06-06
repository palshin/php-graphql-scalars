<?php

declare(strict_types=1);

namespace Palshin\GraphQLScalars\Invariants;

use Palshin\GraphQLScalars\Abstracts\StringInvariant;

class StringMaxLengthInvariant implements StringInvariant
{
  public function __construct(public int $length)
  {
  }

  public function getErrorMessage(): string
  {
    return 'String length should be not more than '.$this->length.' characters';
  }

  public function __invoke(string $value): bool
  {
    return strlen($value) <= $this->length;
  }
}
