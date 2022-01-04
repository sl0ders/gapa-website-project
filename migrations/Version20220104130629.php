<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220104130629 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE model_version ADD model_id INT NOT NULL');
        $this->addSql('ALTER TABLE model_version ADD CONSTRAINT FK_DF8FBA327975B7E7 FOREIGN KEY (model_id) REFERENCES vehicle_model (id)');
        $this->addSql('CREATE INDEX IDX_DF8FBA327975B7E7 ON model_version (model_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE model_version DROP FOREIGN KEY FK_DF8FBA327975B7E7');
        $this->addSql('DROP INDEX IDX_DF8FBA327975B7E7 ON model_version');
        $this->addSql('ALTER TABLE model_version DROP model_id');
    }
}
