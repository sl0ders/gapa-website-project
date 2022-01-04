<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220104151047 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, carrier_id INT NOT NULL, customer_id INT NOT NULL, delivery_option LONGTEXT DEFAULT NULL, delivery_address LONGTEXT NOT NULL, invoice_address LONGTEXT NOT NULL, secure_key VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, validate_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_BA388B721DFC797 (carrier_id), INDEX IDX_BA388B79395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B721DFC797 FOREIGN KEY (carrier_id) REFERENCES carrier (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B79395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE `order` ADD cart_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993981AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('CREATE INDEX IDX_F52993981AD5CDBF ON `order` (cart_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993981AD5CDBF');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP INDEX IDX_F52993981AD5CDBF ON `order`');
        $this->addSql('ALTER TABLE `order` DROP cart_id');
    }
}
