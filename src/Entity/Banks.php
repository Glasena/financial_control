<?php

namespace App\Entity;

use App\Repository\BanksRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BanksRepository::class)]
class Banks
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 15)]
    private ?string $code = null;

    #[ORM\OneToMany(mappedBy: 'id_bank', targetEntity: BankAccounts::class, orphanRemoval: true)]
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

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
            $bankAccount->setIdBank($this);
        }

        return $this;
    }

    public function removeBankAccount(BankAccounts $bankAccount): static
    {
        if ($this->bankAccounts->removeElement($bankAccount)) {
            // set the owning side to null (unless already changed)
            if ($bankAccount->getIdBank() === $this) {
                $bankAccount->setIdBank(null);
            }
        }

        return $this;
    }
}
