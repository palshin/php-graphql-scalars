<?php
declare(strict_types=1);

namespace Palshin\GraphQLScalars;

use Palshin\GraphQLScalars\Abstracts\StringScalar;
use Palshin\GraphQLScalars\Invariants\StringNonEmptyInvariant;

class StringNonEmptyType extends StringScalar
{
  public $description = 'Non-empty string';

  public function getInvariants(): array
  {
    return [
      new StringNonEmptyInvariant(),
    ];
  }
}
