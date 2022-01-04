<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220104144111 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_invoice_payment (id INT AUTO_INCREMENT NOT NULL, ordered_id INT DEFAULT NULL, order_invoice_id INT NOT NULL, order_payment_id INT NOT NULL, INDEX IDX_54F87182AA60395A (ordered_id), INDEX IDX_54F871829A530CA8 (order_invoice_id), INDEX IDX_54F87182B7195EEE (order_payment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_payment (id INT AUTO_INCREMENT NOT NULL, order_reference VARCHAR(255) NOT NULL, amount DOUBLE PRECISION NOT NULL, payment_method VARCHAR(255) NOT NULL, transaction_id VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_invoice_payment ADD CONSTRAINT FK_54F87182AA60395A FOREIGN KEY (ordered_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_invoice_payment ADD CONSTRAINT FK_54F871829A530CA8 FOREIGN KEY (order_invoice_id) REFERENCES order_invoice (id)');
        $this->addSql('ALTER TABLE order_invoice_payment ADD CONSTRAINT FK_54F87182B7195EEE FOREIGN KEY (order_payment_id) REFERENCES order_payment (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_invoice_payment DROP FOREIGN KEY FK_54F87182B7195EEE');
        $this->addSql('DROP TABLE order_invoice_payment');
        $this->addSql('DROP TABLE order_payment');
    }
}
