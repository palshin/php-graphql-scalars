<?php

declare(strict_types=1);

namespace Palshin\GraphQLScalars;

use Palshin\GraphQLScalars\Abstracts\StringScalar;
use Palshin\GraphQLScalars\Invariants\EmailInvariant;

class EmailType extends StringScalar
{
  public function getInvariants(): array
  {
    return [
      new EmailInvariant(),
    ];
  }
}
