<?php

declare(strict_types=1);

namespace App\GraphQL\Type;

use ApiPlatform\Core\GraphQl\Type\TypeConverterInterface;
use Doctrine\ORM\EntityManagerInterface;
use GraphQL\Type\Definition\Type as GraphQLType;
use Symfony\Component\PropertyInfo\Type;

final class TypeConverter implements TypeConverterInterface
{
    private $typeConverter;
    private $entityManager;

    public function __construct(
        TypeConverterInterface $typeConverter,
        EntityManagerInterface $entityManager
    ) {
        $this->typeConverter = $typeConverter;
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function convertType(Type $type, bool $input, ?string $queryName, ?string $mutationName, string $resourceClass, string $rootResource, ?string $property, int $depth)
    {
        if (false !== strpos((string) $resourceClass, 'App\\Entity\\')) {
            $metadata = $this->entityManager->getClassMetadata($resourceClass);
            if ($metadata->isEmbeddedClass) {
                return EmbeddedObjectType::NAME;
            }
        }

        return $this->typeConverter->convertType($type, $input, $queryName, $mutationName, $resourceClass, $rootResource, $property, $depth);
    }

    public function resolveType(string $type): ?GraphQLType
    {
        return $this->typeConverter->resolveType($type);
    }
}
