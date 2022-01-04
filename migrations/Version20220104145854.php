<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220104145854 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, is_add_newsletter TINYINT(1) NOT NULL, newsletter_sub_at DATETIME DEFAULT NULL, last_visit DATETIME DEFAULT NULL, note LONGTEXT DEFAULT NULL, birthday DATETIME DEFAULT NULL, INDEX IDX_81398E09A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `order` ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993989395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('CREATE INDEX IDX_F52993989395C3F3 ON `order` (customer_id)');
        $this->addSql('ALTER TABLE order_invoice ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE order_invoice ADD CONSTRAINT FK_661FBE0F9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('CREATE INDEX IDX_661FBE0F9395C3F3 ON order_invoice (customer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993989395C3F3');
        $this->addSql('ALTER TABLE order_invoice DROP FOREIGN KEY FK_661FBE0F9395C3F3');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP INDEX IDX_F52993989395C3F3 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP customer_id');
        $this->addSql('DROP INDEX IDX_661FBE0F9395C3F3 ON order_invoice');
        $this->addSql('ALTER TABLE order_invoice DROP customer_id');
    }
}
