<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\GuestListRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GuestListRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(name: "guestLists", uriTemplate: '/guest_lists'),
        new Get(name: "guestListsById", uriTemplate: '/guest_lists/{id}'),
        new Patch(name: "updateGuestListsById", uriTemplate: '/guest_lists/{id}'),
    ]
)]
class GuestList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isPresent = null;

    #[ORM\OneToOne(inversedBy: 'guestList', cascade: ['persist', 'remove'])]
    private ?Tables $tables = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function isPresent(): ?bool
    {
        return $this->isPresent;
    }

    public function setIsPresent(?bool $isPresent): static
    {
        $this->isPresent = $isPresent;

        return $this;
    }

    public function getTables(): ?Tables
    {
        return $this->tables;
    }

    public function setTables(?Tables $tables): static
    {
        $this->tables = $tables;

        return $this;
    }
}
