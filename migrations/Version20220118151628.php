<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220118151628 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD53599F4F');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD98622189');
        $this->addSql('CREATE TABLE product_vehicle_declination (product_id INT NOT NULL, vehicle_declination_id INT NOT NULL, INDEX IDX_EA22C0A14584665A (product_id), INDEX IDX_EA22C0A1E2A753C1 (vehicle_declination_id), PRIMARY KEY(product_id, vehicle_declination_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_vehicle_declination ADD CONSTRAINT FK_EA22C0A14584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_vehicle_declination ADD CONSTRAINT FK_EA22C0A1E2A753C1 FOREIGN KEY (vehicle_declination_id) REFERENCES vehicle_declination (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE version_frame');
        $this->addSql('DROP TABLE version_motorisation');
        $this->addSql('DROP INDEX IDX_D34A04AD53599F4F ON product');
        $this->addSql('DROP INDEX IDX_D34A04AD98622189 ON product');
        $this->addSql('ALTER TABLE product DROP version_motorisation_id, DROP version_frame_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE version_frame (id INT AUTO_INCREMENT NOT NULL, model_version_id INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, number VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_B224E8C822832C92 (model_version_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE version_motorisation (id INT AUTO_INCREMENT NOT NULL, model_version_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_4AB23B8522832C92 (model_version_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE version_frame ADD CONSTRAINT FK_B224E8C822832C92 FOREIGN KEY (model_version_id) REFERENCES model_version (id)');
        $this->addSql('ALTER TABLE version_motorisation ADD CONSTRAINT FK_4AB23B8522832C92 FOREIGN KEY (model_version_id) REFERENCES model_version (id)');
        $this->addSql('DROP TABLE product_vehicle_declination');
        $this->addSql('ALTER TABLE product ADD version_motorisation_id INT DEFAULT NULL, ADD version_frame_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD53599F4F FOREIGN KEY (version_frame_id) REFERENCES version_frame (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD98622189 FOREIGN KEY (version_motorisation_id) REFERENCES version_motorisation (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD53599F4F ON product (version_frame_id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD98622189 ON product (version_motorisation_id)');
    }
}
