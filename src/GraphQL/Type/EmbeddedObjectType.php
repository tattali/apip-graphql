<?php

declare(strict_types=1);

namespace App\GraphQL\Type;

use ApiPlatform\Core\GraphQl\Type\Definition\TypeInterface;
use GraphQL\Error\Error;
use GraphQL\Language\AST\ObjectValueNode;
use GraphQL\Type\Definition\ScalarType;
use GraphQL\Utils\AST;
use GraphQL\Utils\Utils;

final class EmbeddedObjectType extends ScalarType implements TypeInterface
{
    const NAME = 'EmbeddedObject';

    public function __construct()
    {
        $this->name = 'EmbeddedObject';
        $this->description = 'The `EmbeddedObject` scalar type represents file metadata data.';

        parent::__construct();
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize($value)
    {
        if (\is_array($value)) {
            return $value;
        }

        if (!\is_object($value)) {
            throw new Error(sprintf('Value must be an instance of %s to be represented by `EmbeddedObject`: %s', 'object', Utils::printSafe($value)));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function parseValue($value): object
    {
        if (!\is_object($value)) {
            throw new Error(sprintf('`EmbeddedObject` could not parse: %s', Utils::printSafe($value)));
        }

        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function parseLiteral($valueNode, array $variables = null)
    {
        if ($valueNode instanceof ObjectValueNode) {
            return AST::valueFromASTUntyped($valueNode, $variables);
        }

        // Intentionally without message, as all information already in wrapped Exception
        throw new \Exception();
    }
}
