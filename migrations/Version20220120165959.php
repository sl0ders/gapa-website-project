<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220120165959 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE version_years (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category CHANGE is_parent_category is_parent_category TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE model_version ADD version_years_id INT NOT NULL');
        $this->addSql('ALTER TABLE model_version ADD CONSTRAINT FK_DF8FBA32C3791698 FOREIGN KEY (version_years_id) REFERENCES version_years (id)');
        $this->addSql('CREATE INDEX IDX_DF8FBA32C3791698 ON model_version (version_years_id)');
        $this->addSql('DROP INDEX id ON vehicle');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE model_version DROP FOREIGN KEY FK_DF8FBA32C3791698');
        $this->addSql('DROP TABLE version_years');
        $this->addSql('ALTER TABLE category CHANGE is_parent_category is_parent_category TINYINT(1) NOT NULL');
        $this->addSql('DROP INDEX IDX_DF8FBA32C3791698 ON model_version');
        $this->addSql('ALTER TABLE model_version DROP version_years_id');
        $this->addSql('CREATE UNIQUE INDEX id ON vehicle (id)');
    }
}
