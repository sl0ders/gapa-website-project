<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220104135948 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_slip (id INT AUTO_INCREMENT NOT NULL, ordered_id INT NOT NULL, total_products_tax_excl DOUBLE PRECISION NOT NULL, total_products_tax_incl DOUBLE PRECISION NOT NULL, total_shipping_tax_excl DOUBLE PRECISION NOT NULL, total_shipping_tax_incl DOUBLE PRECISION NOT NULL, shipping_cost_amount DOUBLE PRECISION NOT NULL, amount DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_B0C879EFAA60395A (ordered_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_slip ADD CONSTRAINT FK_B0C879EFAA60395A FOREIGN KEY (ordered_id) REFERENCES `order` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE order_slip');
    }
}
