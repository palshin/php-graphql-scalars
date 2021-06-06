<?php
declare(strict_types=1);

namespace Palshin\GraphQLScalars;

use GraphQL\Utils\Utils;

abstract class GraphQLScalarsHelper
{
  public static function convertToString(mixed $value): ?string
  {
    $isStringable = $value === null
      || is_scalar($value)
      || (class_exists($value) && in_array('Stringable', class_implements($value)));

    if ($isStringable) {
      return (string) $value;
    }

    return null;
  }

  public static function convertToStringOrThrow(mixed $value, string $exceptionClass): string
  {
    $stringValue = self::convertToString($value);
    if ($stringValue) {
      return $stringValue;
    }

    $safeValue = Utils::printSafeJson($value);
    throw new $exceptionClass('The given value can not be represented as string: ' . $safeValue);
  }
}
