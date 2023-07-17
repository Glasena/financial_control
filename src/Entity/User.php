<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $login = null;

    #[ORM\Column(length: 50)]
    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'id_user', targetEntity: TransactionTypes::class, orphanRemoval: true)]
    private Collection $transactionTypes;

    #[ORM\OneToMany(mappedBy: 'id_user', targetEntity: BankAccounts::class)]
    private Collection $bankAccounts;

    #[ORM\OneToMany(mappedBy: 'id_user', targetEntity: Transactions::class, orphanRemoval: true)]
    private Collection $transactions;

    public function __construct()
    {
        $this->transactionTypes = new ArrayCollection();
        $this->bankAccounts = new ArrayCollection();
        $this->transactions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): static
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection<int, TransactionTypes>
     */
    public function getTransactionTypes(): Collection
    {
        return $this->transactionTypes;
    }

    public function addTransactionType(TransactionTypes $transactionType): static
    {
        if (!$this->transactionTypes->contains($transactionType)) {
            $this->transactionTypes->add($transactionType);
            $transactionType->setIdUser($this);
        }

        return $this;
    }

    public function removeTransactionType(TransactionTypes $transactionType): static
    {
        if ($this->transactionTypes->removeElement($transactionType)) {
            // set the owning side to null (unless already changed)
            if ($transactionType->getIdUser() === $this) {
                $transactionType->setIdUser(null);
            }
        }

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
            $bankAccount->setIdUser($this);
        }

        return $this;
    }

    public function removeBankAccount(BankAccounts $bankAccount): static
    {
        if ($this->bankAccounts->removeElement($bankAccount)) {
            // set the owning side to null (unless already changed)
            if ($bankAccount->getIdUser() === $this) {
                $bankAccount->setIdUser(null);
            }
        }

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
            $transaction->setIdUser($this);
        }

        return $this;
    }

    public function removeTransaction(Transactions $transaction): static
    {
        if ($this->transactions->removeElement($transaction)) {
            // set the owning side to null (unless already changed)
            if ($transaction->getIdUser() === $this) {
                $transaction->setIdUser(null);
            }
        }

        return $this;
    }
}
