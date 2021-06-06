<?php

declare(strict_types=1);

namespace Palshin\GraphQLScalars\Abstracts;

interface StringInvariant
{
  public function __invoke(string $value): bool;

  public function getErrorMessage(): string;
}
