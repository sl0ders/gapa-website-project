<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220118132107 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE model_version (id INT AUTO_INCREMENT NOT NULL, model_id INT NOT NULL, vehicle_mark_id INT NOT NULL, vehicle_range_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, begin_at VARCHAR(255) DEFAULT NULL, end_at VARCHAR(255) DEFAULT NULL, year INT NOT NULL, motorisation VARCHAR(255) NOT NULL, cv_f INT NOT NULL, frame VARCHAR(255) NOT NULL, mark_name VARCHAR(255) NOT NULL, range_name VARCHAR(255) DEFAULT NULL, model_name VARCHAR(255) NOT NULL, INDEX IDX_DF8FBA327975B7E7 (model_id), INDEX IDX_DF8FBA325DE3AC44 (vehicle_mark_id), INDEX IDX_DF8FBA32F790DF25 (vehicle_range_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE model_version ADD CONSTRAINT FK_DF8FBA327975B7E7 FOREIGN KEY (model_id) REFERENCES vehicle_model (id)');
        $this->addSql('ALTER TABLE model_version ADD CONSTRAINT FK_DF8FBA325DE3AC44 FOREIGN KEY (vehicle_mark_id) REFERENCES vehicle_mark (id)');
        $this->addSql('ALTER TABLE model_version ADD CONSTRAINT FK_DF8FBA32F790DF25 FOREIGN KEY (vehicle_range_id) REFERENCES vehicle_range (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicle_declination DROP FOREIGN KEY FK_B3632B3322832C92');
        $this->addSql('ALTER TABLE version_frame DROP FOREIGN KEY FK_B224E8C822832C92');
        $this->addSql('ALTER TABLE version_motorisation DROP FOREIGN KEY FK_4AB23B8522832C92');
        $this->addSql('DROP TABLE model_version');
    }
}
