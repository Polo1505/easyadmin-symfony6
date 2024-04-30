<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\GuestListRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Serializer\Annotation\Groups;

//use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Serializer\Filter\PropertyFilter;



#[ORM\Entity(repositoryClass: GuestListRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(name: "guestLists", uriTemplate: '/guest_lists',normalizationContext: ['groups' => 'guest:list'],
    ),
        new Get(name: "guestListsById", uriTemplate: '/guest_lists/{id}',normalizationContext: ['groups' => 'guest:item']),
        new Patch(name: "updateGuestListsById", uriTemplate: '/guest_lists/{id}'),
    ],
    
)]
#[ApiFilter(SearchFilter::class, properties: ['name' => 'exact', 'isPresent' => 'exact'])]
class GuestList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['guest:list','guest:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['guest:list','guest:item'])]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['guest:list','guest:item'])]
    private ?bool $isPresent = null;

    #[ORM\ManyToOne(inversedBy: 'guestLists')]
    #[Groups(['guest:list','guest:item'])]
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
