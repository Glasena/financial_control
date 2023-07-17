<?php

namespace App\Entity;

use App\Repository\IntegrationTypesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IntegrationTypesRepository::class)]
class IntegrationTypes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: BankAccounts::class, mappedBy: 'id_integrationTypes')]
    private Collection $bankAccounts;

    public function __construct()
    {
        $this->bankAccounts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, BankAccounts>
     */
    public function getBankAccounts(): Collection
    {
        return $this->bankAccounts;
    }

    public function addBankAccount(BankAccounts $bankAccount): static
    {
        if (!$this->bankAccounts->contains($bankAccount)) {
            $this->bankAccounts->add($bankAccount);
            $bankAccount->addIdIntegrationType($this);
        }

        return $this;
    }

    public function removeBankAccount(BankAccounts $bankAccount): static
    {
        if ($this->bankAccounts->removeElement($bankAccount)) {
            $bankAccount->removeIdIntegrationType($this);
        }

        return $this;
    }
}
