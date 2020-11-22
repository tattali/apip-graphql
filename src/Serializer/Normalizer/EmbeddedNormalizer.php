<?php

declare(strict_types=1);

namespace App\Serializer\Normalizer;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;

class EmbeddedNormalizer implements ContextAwareNormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    const FORMAT = 'graphql';

    private $entityManager;
    private $propertyAccessor;

    private $metadata;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->propertyAccessor = PropertyAccess::createPropertyAccessor();
        $this->entityManager = $entityManager;
    }

    public function normalize($data, $format = null, array $context = [])
    {
        $array = [];
        foreach ($this->metadata->fieldNames as $name) {
            $this->propertyAccessor->setValue(
                $array,
                "[{$name}]",
                $this->normalizer->normalize($this->propertyAccessor->getValue($data, $name), $format, $context)
            );
        }

        return $array;
    }

    public function supportsNormalization($data, $format = null, array $context = [])
    {
        if (
            self::FORMAT === $format && \is_object($data) && false !== strpos(\get_class($data), 'App\\Entity\\')
        ) {
            $this->metadata = $this->entityManager->getClassMetadata(\get_class($data));
            if ($this->metadata->isEmbeddedClass) {
                return true;
            }
        }

        return false;
    }
}
