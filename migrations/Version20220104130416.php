<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220104130416 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE version_frame (id INT AUTO_INCREMENT NOT NULL, model_version_id INT NOT NULL, name VARCHAR(255) NOT NULL, number VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_B224E8C822832C92 (model_version_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE version_motorisation (id INT AUTO_INCREMENT NOT NULL, model_version_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_4AB23B8522832C92 (model_version_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE version_frame ADD CONSTRAINT FK_B224E8C822832C92 FOREIGN KEY (model_version_id) REFERENCES model_version (id)');
        $this->addSql('ALTER TABLE version_motorisation ADD CONSTRAINT FK_4AB23B8522832C92 FOREIGN KEY (model_version_id) REFERENCES model_version (id)');
        $this->addSql('ALTER TABLE product ADD version_motorisation_id INT DEFAULT NULL, ADD version_frame_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD98622189 FOREIGN KEY (version_motorisation_id) REFERENCES version_motorisation (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD53599F4F FOREIGN KEY (version_frame_id) REFERENCES version_frame (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD98622189 ON product (version_motorisation_id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD53599F4F ON product (version_frame_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD53599F4F');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD98622189');
        $this->addSql('DROP TABLE version_frame');
        $this->addSql('DROP TABLE version_motorisation');
        $this->addSql('DROP INDEX IDX_D34A04AD98622189 ON product');
        $this->addSql('DROP INDEX IDX_D34A04AD53599F4F ON product');
        $this->addSql('ALTER TABLE product DROP version_motorisation_id, DROP version_frame_id');
    }
}
