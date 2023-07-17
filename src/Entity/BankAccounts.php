<?php

namespace App\Entity;

use App\Repository\BankAccountsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BankAccountsRepository::class)]
class BankAccounts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $code = null;

    #[ORM\ManyToOne(inversedBy: 'bankAccounts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Banks $id_bank = null;

    #[ORM\ManyToMany(targetEntity: IntegrationTypes::class, inversedBy: 'bankAccounts')]
    private Collection $id_integrationTypes;

    #[ORM\ManyToOne(inversedBy: 'bankAccounts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $id_user = null;

    #[ORM\OneToMany(mappedBy: 'id_bankAccount', targetEntity: Transactions::class, orphanRemoval: true)]
    private Collection $transactions;

    public function __construct()
    {
        $this->id_integrationTypes = new ArrayCollection();
        $this->transactions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getIdBank(): ?Banks
    {
        return $this->id_bank;
    }

    public function setIdBank(?Banks $id_bank): static
    {
        $this->id_bank = $id_bank;

        return $this;
    }

    /**
     * @return Collection<int, IntegrationTypes>
     */
    public function getIdIntegrationTypes(): Collection
    {
        return $this->id_integrationTypes;
    }

    public function addIdIntegrationType(IntegrationTypes $idIntegrationType): static
    {
        if (!$this->id_integrationTypes->contains($idIntegrationType)) {
            $this->id_integrationTypes->add($idIntegrationType);
        }

        return $this;
    }

    public function removeIdIntegrationType(IntegrationTypes $idIntegrationType): static
    {
        $this->id_integrationTypes->removeElement($idIntegrationType);

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(?User $id_user): static
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * @return Collection<int, Transactions>
     */
    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function addTransaction(Transactions $transaction): static
    {
        if (!$this->transactions->contains($transaction)) {
            $this->transactions->add($transaction);
            $transaction->setIdBankAccount($this);
        }

        return $this;
    }

    public function removeTransaction(Transactions $transaction): static
    {
        if ($this->transactions->removeElement($transaction)) {
            // set the owning side to null (unless already changed)
            if ($transaction->getIdBankAccount() === $this) {
                $transaction->setIdBankAccount(null);
            }
        }

        return $this;
    }
}
