<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\TablesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use App\Controller\Admin\GuestListCrudController;

#[ORM\Entity(repositoryClass: TablesRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(name: "tables", uriTemplate: '/tables'),
        new Get(name: "tablesById", uriTemplate: '/tables/{id}'),
        new Patch(name: "updateTablesById", uriTemplate: '/tables/{id}'),
        new GetCollection(name: "tableGuests", uriTemplate: '/tables/{id}/guests', controller:GuestListCrudController::Class),
        new GetCollection(name: "tablesStats", uriTemplate: '/tables_stats'),
    ]
)]
class Tables
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $num = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?int $maxGuests = null;

    #[ORM\Column(nullable: true)]
    private ?int $guestsDef = null;

    #[ORM\Column(nullable: true)]
    private ?int $guestsNow = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $guests = [];

    // #[ORM\OneToOne(mappedBy: 'tables', cascade: ['persist', 'remove'])]
    // private ?GuestList $guestList = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNum(): ?int
    {
        return $this->num;
    }

    public function setNum(int $num): static
    {
        $this->num = $num;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getMaxGuests(): ?int
    {
        return $this->maxGuests;
    }

    public function setMaxGuests(?int $maxGuests): static
    {
        $this->maxGuests = $maxGuests;

        return $this;
    }

    public function getGuestsDef(): ?int
    {
        return $this->guestsDef;
    }

    public function setGuestsDef(?int $guestsDef): static
    {
        $this->guestsDef = $guestsDef;

        return $this;
    }

    public function getGuestsNow(): ?int
    {
        return $this->guestsNow;
    }

    public function setGuestsNow(?int $guestsNow): static
    {
        $this->guestsNow = $guestsNow;

        return $this;
    }

    public function getGuests(): array
    {
        return $this->guests;
    }

    public function setGuests(array $guests): static
    {
        $this->guests = $guests;

        return $this;
    }

    // public function getGuestList(): ?GuestList
    // {
    //     return $this->guestList;
    // }

    // public function setGuestList(?GuestList $guestList): static
    // {
    //     // unset the owning side of the relation if necessary
    //     if ($guestList === null && $this->guestList !== null) {
    //         $this->guestList->setTables(null);
    //     }

    //     // set the owning side of the relation if necessary
    //     if ($guestList !== null && $guestList->getTables() !== $this) {
    //         $guestList->setTables($this);
    //     }

    //     $this->guestList = $guestList;

    //     return $this;
    // }
}
