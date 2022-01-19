<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220119110843 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_vehicle_declination (product_id INT NOT NULL, vehicle_declination_id INT NOT NULL, INDEX IDX_EA22C0A14584665A (product_id), INDEX IDX_EA22C0A1E2A753C1 (vehicle_declination_id), PRIMARY KEY(product_id, vehicle_declination_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_vehicle_declination ADD CONSTRAINT FK_EA22C0A14584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_vehicle_declination ADD CONSTRAINT FK_EA22C0A1E2A753C1 FOREIGN KEY (vehicle_declination_id) REFERENCES vehicle_declination (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE product_vehicle_declination');
    }
}
