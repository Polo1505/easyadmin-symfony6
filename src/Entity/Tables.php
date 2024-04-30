<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\TablesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiSubresource;

use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Serializer\Filter\PropertyFilter;

use App\Controller\Admin\GuestListCrudController;

#[ORM\Entity(repositoryClass: TablesRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(name: "tables", uriTemplate: '/tables',
    ),
        new Get(name: "tablesById", uriTemplate: '/tables/{id}'),
        new Patch(name: "updateTablesById", uriTemplate: '/tables/{id}'),
        new GetCollection(name: "tableGuests", uriTemplate: '/tables/{id}/guestLists',
        ),
        new GetCollection(name: "tablesStats", uriTemplate: '/tables_stats',
    ),
    ]
    )
]
#[ApiFilter(SearchFilter::class, properties: ['num' => 'exact'])]
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
    private ?int $guestsDef = 0;

    #[ORM\Column(nullable: true)]
    private ?int $guestsNow = 0;

    /**
     * @var Collection<int, GuestList>
     */
    #[ORM\OneToMany(targetEntity: GuestList::class, mappedBy: 'tables')]
    #[ApiSubresource]
    private Collection $guestLists;

    public function __construct()
    {
        $this->guestLists = new ArrayCollection();
    }

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
        return $this->getGuestLists()->count();
    }

    public function updateGuestsDef(): void
    {
        $this->guestsDef = $this->getGuestLists()->count();
    }

    public function getGuestsNow(): ?int
    {
        return $this->getGuestLists()->filter(fn (GuestList $guestList) => $guestList->isPresent())->count();
    }

    public function updateGuestsNow(): void
    {
        $this->guestsNow = $this->getGuestLists()->filter(fn (GuestList $guestList) => $guestList->isPresent())->count();
    }

    /**
     * @return Collection<int, GuestList>
     */
    public function getGuestLists(): Collection
    {
        return $this->guestLists;
    }

    public function addGuestList(GuestList $guestList): static
    {
        if (!$this->guestLists->contains($guestList)) {
            $this->guestLists->add($guestList);
            
            $guestList->setTables($this);
        }

        return $this;
    }

    public function removeGuestList(GuestList $guestList): static
    {
        if ($this->guestLists->removeElement($guestList)) {
            // set the owning side to null (unless already changed)
            if ($guestList->getTables() === $this) {
                $guestList->setTables(null);
            }
        }

        return $this;
    }
    
    public function __toString(){
        return "Table {$this->num}";
    }
}
