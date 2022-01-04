<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220104150237 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE carrier (id INT AUTO_INCREMENT NOT NULL, delivery_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, position INT NOT NULL, url VARCHAR(255) DEFAULT NULL, is_free TINYINT(1) NOT NULL, is_enabled TINYINT(1) NOT NULL, INDEX IDX_4739F11C12136921 (delivery_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE delivery (id INT AUTO_INCREMENT NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE carrier ADD CONSTRAINT FK_4739F11C12136921 FOREIGN KEY (delivery_id) REFERENCES delivery (id)');
        $this->addSql('ALTER TABLE `order` ADD delivery_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939812136921 FOREIGN KEY (delivery_id) REFERENCES delivery (id)');
        $this->addSql('CREATE INDEX IDX_F529939812136921 ON `order` (delivery_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carrier DROP FOREIGN KEY FK_4739F11C12136921');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939812136921');
        $this->addSql('DROP TABLE carrier');
        $this->addSql('DROP TABLE delivery');
        $this->addSql('DROP INDEX IDX_F529939812136921 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP delivery_id');
    }
}
