<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation as Api;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Api\ApiResource
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Embedded(class="App\Entity\Remuneration")
     */
    private $actualRemuneration;

    /**
     * @ORM\Embedded(class="App\Entity\Remuneration")
     */
    private $expectedRemuneration;

    public function __construct()
    {
        $this->actualRemuneration = new Remuneration();
        $this->expectedRemuneration = new Remuneration();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getActualRemuneration(): ?Remuneration
    {
        return $this->actualRemuneration;
    }

    public function setActualRemuneration(Remuneration $actualRemuneration): self
    {
        $this->actualRemuneration = $actualRemuneration;

        return $this;
    }

    public function getExpectedRemuneration(): ?Remuneration
    {
        return $this->expectedRemuneration;
    }

    public function setExpectedRemuneration(Remuneration $expectedRemuneration): self
    {
        $this->expectedRemuneration = $expectedRemuneration;

        return $this;
    }
}
