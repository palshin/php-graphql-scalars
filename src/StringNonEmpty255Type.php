<?php
declare(strict_types=1);

namespace Palshin\GraphQLScalars;

use Palshin\GraphQLScalars\Abstracts\StringScalar;
use Palshin\GraphQLScalars\Invariants\StringMaxLengthInvariant;
use Palshin\GraphQLScalars\Invariants\StringNonEmptyInvariant;

class StringNonEmpty255Type extends StringScalar
{
  public function getInvariants(): array
  {
    return [
      new StringNonEmptyInvariant(),
      new StringMaxLengthInvariant(255),
    ];
  }
}
