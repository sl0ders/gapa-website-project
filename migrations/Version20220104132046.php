<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220104132046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vehicle_mark_provider (vehicle_mark_id INT NOT NULL, provider_id INT NOT NULL, INDEX IDX_77C9B7E85DE3AC44 (vehicle_mark_id), INDEX IDX_77C9B7E8A53A8AA (provider_id), PRIMARY KEY(vehicle_mark_id, provider_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vehicle_mark_provider ADD CONSTRAINT FK_77C9B7E85DE3AC44 FOREIGN KEY (vehicle_mark_id) REFERENCES vehicle_mark (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicle_mark_provider ADD CONSTRAINT FK_77C9B7E8A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE vehicle_mark_provider');
    }
}
