<?php

declare(strict_types=1);

namespace Palshin\GraphQLScalars\Invariants;

use Palshin\GraphQLScalars\Abstracts\StringInvariant;

class StringRegexInvariant implements StringInvariant
{
  public function __construct(public string $regex)
  {
  }

  public function __invoke(string $value): bool
  {
    return preg_match($this->regex, $value) === false;
  }

  public function getErrorMessage(): string
  {
    return 'String should match regular expression: '.$this->regex;
  }
}
