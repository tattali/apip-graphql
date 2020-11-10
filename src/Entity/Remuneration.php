<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Remuneration
{
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fixedSalary;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fullPackage;

    /**
     * @codeCoverageIgnore
     */
    public function getFixedSalary(): ?int
    {
        return $this->fixedSalary;
    }

    /**
     * @codeCoverageIgnore
     */
    public function setFixedSalary(?int $fixedSalary): self
    {
        $this->fixedSalary = $fixedSalary;

        return $this;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getFullPackage(): ?int
    {
        return $this->fullPackage;
    }

    /**
     * @codeCoverageIgnore
     */
    public function setFullPackage(?int $fullPackage): self
    {
        $this->fullPackage = $fullPackage;

        return $this;
    }
}
