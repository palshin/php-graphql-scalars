<?php


namespace Palshin\GraphQLScalars\Invariants;


class IPInvariant implements \Palshin\GraphQLScalars\Abstracts\StringInvariant
{
  public function __construct(public int $flags = 0)
  {
  }

  public function __invoke(string $value): bool
  {
    return !!filter_var($value, FILTER_VALIDATE_IP, $this->flags);
  }

  public function getErrorMessage(): string
  {
    return 'The value should be a correct IP address';
  }
}
