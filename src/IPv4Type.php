<?php

declare(strict_types=1);

namespace Palshin\GraphQLScalars;

use Palshin\GraphQLScalars\Abstracts\StringScalar;
use Palshin\GraphQLScalars\Invariants\IPInvariant;

class IPv4Type extends StringScalar
{
  public function getInvariants(): array
  {
    return [
      new IPInvariant(FILTER_FLAG_IPV4),
    ];
  }
}
