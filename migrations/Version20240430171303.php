<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240430171303 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE guest_list DROP INDEX UNIQ_6072A54585405FD2, ADD INDEX IDX_6072A54585405FD2 (tables_id)');
        $this->addSql('ALTER TABLE tables DROP guests');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE guest_list DROP INDEX IDX_6072A54585405FD2, ADD UNIQUE INDEX UNIQ_6072A54585405FD2 (tables_id)');
        $this->addSql('ALTER TABLE tables ADD guests LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
    }
}
