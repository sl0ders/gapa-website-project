<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220124162924 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carrier ADD delivery_id INT DEFAULT NULL, ADD name VARCHAR(255) NOT NULL, ADD position INT NOT NULL, ADD url VARCHAR(255) DEFAULT NULL, ADD is_free TINYINT(1) NOT NULL, ADD is_enabled TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE carrier ADD CONSTRAINT FK_4739F11C12136921 FOREIGN KEY (delivery_id) REFERENCES delivery (id)');
        $this->addSql('CREATE INDEX IDX_4739F11C12136921 ON carrier (delivery_id)');
        $this->addSql('ALTER TABLE category CHANGE is_parent_category is_parent_category TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carrier DROP FOREIGN KEY FK_4739F11C12136921');
        $this->addSql('DROP INDEX IDX_4739F11C12136921 ON carrier');
        $this->addSql('ALTER TABLE carrier DROP delivery_id, DROP name, DROP position, DROP url, DROP is_free, DROP is_enabled');
        $this->addSql('ALTER TABLE category CHANGE is_parent_category is_parent_category TINYINT(1) NOT NULL');
    }
}
