<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220124165033 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE is_parent_category is_parent_category TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE customer ADD siret VARCHAR(255) NOT NULL, ADD company VARCHAR(255) NOT NULL, ADD is_enabled TINYINT(1) NOT NULL, ADD secure_key VARCHAR(255) NOT NULL, ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME DEFAULT NULL, ADD gender VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE is_parent_category is_parent_category TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE customer DROP siret, DROP company, DROP is_enabled, DROP secure_key, DROP created_at, DROP updated_at, DROP gender');
    }
}
