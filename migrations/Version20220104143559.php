<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220104143559 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_invoice (id INT AUTO_INCREMENT NOT NULL, ordered_id INT DEFAULT NULL, number INT NOT NULL, total_paid_tax_excl DOUBLE PRECISION NOT NULL, total_paid_tax_incl DOUBLE PRECISION NOT NULL, total_discount_tax_excl DOUBLE PRECISION NOT NULL, total_discount_tax_incl DOUBLE PRECISION NOT NULL, total_products_tax_excl DOUBLE PRECISION NOT NULL, total_products_tax_incl DOUBLE PRECISION NOT NULL, total_shipping_tax_incl DOUBLE PRECISION NOT NULL, total_shipping_tax_excl DOUBLE PRECISION NOT NULL, invoice_address LONGTEXT NOT NULL, delivery_address LONGTEXT NOT NULL, note LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, delivery_at DATETIME NOT NULL, INDEX IDX_661FBE0FAA60395A (ordered_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_invoice ADD CONSTRAINT FK_661FBE0FAA60395A FOREIGN KEY (ordered_id) REFERENCES `order` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE order_invoice');
    }
}
