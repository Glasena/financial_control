<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230717005835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bank_accounts (id INT AUTO_INCREMENT NOT NULL, id_bank_id INT NOT NULL, id_user_id INT NOT NULL, code VARCHAR(50) DEFAULT NULL, INDEX IDX_FB88842BCF555231 (id_bank_id), INDEX IDX_FB88842B79F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bank_accounts_integration_types (bank_accounts_id INT NOT NULL, integration_types_id INT NOT NULL, INDEX IDX_CF11B12AEED53A97 (bank_accounts_id), INDEX IDX_CF11B12A9C68F6BD (integration_types_id), PRIMARY KEY(bank_accounts_id, integration_types_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE banks (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) DEFAULT NULL, code VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE integration_types (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction_types (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_F803597079F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transactions (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, id_transaction_type_id INT DEFAULT NULL, id_bank_account_id INT NOT NULL, value DOUBLE PRECISION NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_EAA81A4C79F37AE5 (id_user_id), INDEX IDX_EAA81A4CF50C2CBA (id_transaction_type_id), INDEX IDX_EAA81A4CFB955A84 (id_bank_account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(100) NOT NULL, password VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bank_accounts ADD CONSTRAINT FK_FB88842BCF555231 FOREIGN KEY (id_bank_id) REFERENCES banks (id)');
        $this->addSql('ALTER TABLE bank_accounts ADD CONSTRAINT FK_FB88842B79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE bank_accounts_integration_types ADD CONSTRAINT FK_CF11B12AEED53A97 FOREIGN KEY (bank_accounts_id) REFERENCES bank_accounts (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bank_accounts_integration_types ADD CONSTRAINT FK_CF11B12A9C68F6BD FOREIGN KEY (integration_types_id) REFERENCES integration_types (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transaction_types ADD CONSTRAINT FK_F803597079F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE transactions ADD CONSTRAINT FK_EAA81A4C79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE transactions ADD CONSTRAINT FK_EAA81A4CF50C2CBA FOREIGN KEY (id_transaction_type_id) REFERENCES transaction_types (id)');
        $this->addSql('ALTER TABLE transactions ADD CONSTRAINT FK_EAA81A4CFB955A84 FOREIGN KEY (id_bank_account_id) REFERENCES bank_accounts (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bank_accounts DROP FOREIGN KEY FK_FB88842BCF555231');
        $this->addSql('ALTER TABLE bank_accounts DROP FOREIGN KEY FK_FB88842B79F37AE5');
        $this->addSql('ALTER TABLE bank_accounts_integration_types DROP FOREIGN KEY FK_CF11B12AEED53A97');
        $this->addSql('ALTER TABLE bank_accounts_integration_types DROP FOREIGN KEY FK_CF11B12A9C68F6BD');
        $this->addSql('ALTER TABLE transaction_types DROP FOREIGN KEY FK_F803597079F37AE5');
        $this->addSql('ALTER TABLE transactions DROP FOREIGN KEY FK_EAA81A4C79F37AE5');
        $this->addSql('ALTER TABLE transactions DROP FOREIGN KEY FK_EAA81A4CF50C2CBA');
        $this->addSql('ALTER TABLE transactions DROP FOREIGN KEY FK_EAA81A4CFB955A84');
        $this->addSql('DROP TABLE bank_accounts');
        $this->addSql('DROP TABLE bank_accounts_integration_types');
        $this->addSql('DROP TABLE banks');
        $this->addSql('DROP TABLE integration_types');
        $this->addSql('DROP TABLE transaction_types');
        $this->addSql('DROP TABLE transactions');
        $this->addSql('DROP TABLE user');
    }
}
