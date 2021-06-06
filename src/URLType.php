<?php

declare(strict_types=1);

namespace Palshin\GraphQLScalars;

use Palshin\GraphQLScalars\Abstracts\StringScalar;
use Palshin\GraphQLScalars\Invariants\URLInvariant;

class URLType extends StringScalar
{
  public function getInvariants(): array
  {
    return [
      new URLInvariant(),
    ];
  }
}
