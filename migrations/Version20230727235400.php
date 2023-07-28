<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230727235400 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('INSERT INTO BANKS (DESCRIPTION, CODE) VALUES("Sicredi", "748")');
        $this->addSql('INSERT INTO INTEGRATION_TYPES (DESCRIPTION) VALUES("FEBRABAN 240")');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM BANKS WHERE CODE = "748"');
        $this->addSql('DELETE FROM INTEGRATION_TYPES WHERE DESCRIPTION = "FEBRABAN 240"');
    }
}
