<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220118141547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicle_declination DROP FOREIGN KEY FK_B3632B33A3B5A725');
        $this->addSql('DROP INDEX IDX_B3632B33A3B5A725 ON vehicle_declination');
        $this->addSql('ALTER TABLE vehicle_declination ADD motorisation VARCHAR(255) NOT NULL, DROP motorisation_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicle_declination ADD motorisation_id INT DEFAULT NULL, DROP motorisation');
        $this->addSql('ALTER TABLE vehicle_declination ADD CONSTRAINT FK_B3632B33A3B5A725 FOREIGN KEY (motorisation_id) REFERENCES version_motorisation (id)');
        $this->addSql('CREATE INDEX IDX_B3632B33A3B5A725 ON vehicle_declination (motorisation_id)');
    }
}
