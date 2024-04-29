<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240429224127 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE guest_list (id INT AUTO_INCREMENT NOT NULL, tables_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, is_present TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_6072A54585405FD2 (tables_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tables (id INT AUTO_INCREMENT NOT NULL, num INT NOT NULL, description VARCHAR(255) DEFAULT NULL, max_guests INT DEFAULT NULL, guests_def INT DEFAULT NULL, guests_now INT DEFAULT NULL, guests LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE guest_list ADD CONSTRAINT FK_6072A54585405FD2 FOREIGN KEY (tables_id) REFERENCES tables (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE guest_list DROP FOREIGN KEY FK_6072A54585405FD2');
        $this->addSql('DROP TABLE guest_list');
        $this->addSql('DROP TABLE tables');
    }
}
