<?php
declare(strict_types=1);

namespace Palshin\GraphQLScalars\Abstracts;

use GraphQL\Error\Error;
use GraphQL\Error\InvariantViolation;
use GraphQL\Language\AST\Node;
use GraphQL\Language\AST\StringValueNode;
use GraphQL\Type\Definition\ScalarType;
use GraphQL\Utils\Utils;
use Palshin\GraphQLScalars\GraphQLScalarsHelper;

abstract class StringScalar extends ScalarType
{
  /**
   * @psalm-var array<callable|StringInvariant>
   */
  public array $invariants = [];

  public function serialize(mixed $value): string
  {
    $stringValue = GraphQLScalarsHelper::convertToStringOrThrow($value, InvariantViolation::class);
    $this->checkValue($stringValue, InvariantViolation::class);

    return $stringValue;
  }

  public function parseValue(mixed $value): string
  {
    $stringValue =  GraphQLScalarsHelper::convertToStringOrThrow($value, Error::class);
    $this->checkValue($stringValue, Error::class);

    return $stringValue;
  }

  public function parseLiteral(Node $valueNode, ?array $variables = null): string
  {
    if (!$valueNode instanceof StringValueNode) {
      throw new Error('Query error: Can only parse strings got: ' . $valueNode->kind, [$valueNode]);
    }
    $stringValue = GraphQLScalarsHelper::convertToStringOrThrow($valueNode->value, Error::class);
    $this->checkValue($stringValue, Error::class);

    return $stringValue;
  }

  protected function getErrorMessage(string $stringValue, string $specificMessage = ''): string
  {
    $safeValue = Utils::printSafeJson($stringValue);

    return "The given string is not valid {$this->tryInferName()} string: $safeValue. $specificMessage";
  }

  /**
   * @throws Error
   * @throws InvariantViolation
   */
  private function checkValue(string $value, string $ErrorClass): void
  {
    $invariants = $this->getInvariants();
    foreach ($invariants as $invariant) {
      $checkResult = $invariant($value);
      if ($checkResult !== true) {
        $errorMessage = is_string($checkResult) ? $checkResult : ($invariant?->getErrorMessage() ?? '');
        throw new $ErrorClass(
          $this->getErrorMessage($value, $errorMessage)
        );
      }
    }
  }

  public static function make(string $name, ?string $description, callable ...$invariants): self
  {
    $scalarType = new class extends StringScalar {
      public function getInvariants(): array
      {
        return $this->invariants;
      }
    };

    $scalarType->name = $name;
    $scalarType->description = $description;
    $scalarType->invariants = $invariants;

    return $scalarType;
  }

  /**
   * @psalm-return array<callable|StringInvariant>
   */
  abstract public function getInvariants(): array;
}
