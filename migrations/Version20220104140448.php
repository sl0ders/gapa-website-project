<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220104140448 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_detail (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, ordered_id INT NOT NULL, product_name VARCHAR(255) NOT NULL, product_quantity INT NOT NULL, product_price DOUBLE PRECISION NOT NULL, unit_price_tax_incl DOUBLE PRECISION NOT NULL, unit_price_tax_excl DOUBLE PRECISION NOT NULL, total_shipping_price_tax_incl DOUBLE PRECISION NOT NULL, total_shipping_price_tax_excl DOUBLE PRECISION NOT NULL, purchase_supplier_price DOUBLE PRECISION NOT NULL, original_product_price DOUBLE PRECISION NOT NULL, INDEX IDX_ED896F464584665A (product_id), UNIQUE INDEX UNIQ_ED896F46AA60395A (ordered_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_detail ADD CONSTRAINT FK_ED896F464584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE order_detail ADD CONSTRAINT FK_ED896F46AA60395A FOREIGN KEY (ordered_id) REFERENCES `order` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE order_detail');
    }
}
