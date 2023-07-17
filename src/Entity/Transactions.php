<?php

namespace App\Entity;

use App\Repository\TransactionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransactionsRepository::class)]
class Transactions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'transactions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $id_user = null;

    #[ORM\Column]
    private ?float $value = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'transactions')]
    private ?TransactionTypes $id_transactionType = null;

    #[ORM\ManyToOne(inversedBy: 'transactions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?BankAccounts $id_bankAccount = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getIdTransactionType(): ?TransactionTypes
    {
        return $this->id_transactionType;
    }

    public function setIdTransactionType(?TransactionTypes $id_transactionType): static
    {
        $this->id_transactionType = $id_transactionType;

        return $this;
    }

    public function getIdBankAccount(): ?BankAccounts
    {
        return $this->id_bankAccount;
    }

    public function setIdBankAccount(?BankAccounts $id_bankAccount): static
    {
        $this->id_bankAccount = $id_bankAccount;

        return $this;
    }
}
