<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220118165054 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_vehicle_range DROP FOREIGN KEY FK_2BC5C6574584665A');
        $this->addSql('ALTER TABLE product_vehicle_range ADD CONSTRAINT FK_2BC5C6574584665A FOREIGN KEY (product_id) REFERENCES product (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_vehicle_range DROP FOREIGN KEY FK_2BC5C6574584665A');
        $this->addSql('ALTER TABLE product_vehicle_range ADD CONSTRAINT FK_2BC5C6574584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
    }
}
