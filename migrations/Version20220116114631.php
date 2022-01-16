<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220116114631 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vehicle_declination (id INT AUTO_INCREMENT NOT NULL, mark_id INT NOT NULL, model_id INT NOT NULL, frame_id INT DEFAULT NULL, model_version_id INT NOT NULL, motorisation_id INT DEFAULT NULL, INDEX IDX_B3632B334290F12B (mark_id), INDEX IDX_B3632B337975B7E7 (model_id), INDEX IDX_B3632B333FA3C347 (frame_id), INDEX IDX_B3632B3322832C92 (model_version_id), INDEX IDX_B3632B33A3B5A725 (motorisation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vehicle_declination ADD CONSTRAINT FK_B3632B334290F12B FOREIGN KEY (mark_id) REFERENCES vehicle_mark (id)');
        $this->addSql('ALTER TABLE vehicle_declination ADD CONSTRAINT FK_B3632B337975B7E7 FOREIGN KEY (model_id) REFERENCES vehicle_model (id)');
        $this->addSql('ALTER TABLE vehicle_declination ADD CONSTRAINT FK_B3632B333FA3C347 FOREIGN KEY (frame_id) REFERENCES version_frame (id)');
        $this->addSql('ALTER TABLE vehicle_declination ADD CONSTRAINT FK_B3632B3322832C92 FOREIGN KEY (model_version_id) REFERENCES model_version (id)');
        $this->addSql('ALTER TABLE vehicle_declination ADD CONSTRAINT FK_B3632B33A3B5A725 FOREIGN KEY (motorisation_id) REFERENCES version_motorisation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE vehicle_declination');
    }
}
