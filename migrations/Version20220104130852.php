<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220104130852 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicle_model ADD vehicle_mark_id INT NOT NULL');
        $this->addSql('ALTER TABLE vehicle_model ADD CONSTRAINT FK_B53AF2355DE3AC44 FOREIGN KEY (vehicle_mark_id) REFERENCES vehicle_mark (id)');
        $this->addSql('CREATE INDEX IDX_B53AF2355DE3AC44 ON vehicle_model (vehicle_mark_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicle_model DROP FOREIGN KEY FK_B53AF2355DE3AC44');
        $this->addSql('DROP INDEX IDX_B53AF2355DE3AC44 ON vehicle_model');
        $this->addSql('ALTER TABLE vehicle_model DROP vehicle_mark_id');
    }
}
