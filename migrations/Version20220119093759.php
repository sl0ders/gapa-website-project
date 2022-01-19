<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220119093759 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE model_version (id INT AUTO_INCREMENT NOT NULL, model_id INT NOT NULL, vehicle_mark_id INT NOT NULL, vehicle_range_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, begin_at VARCHAR(255) DEFAULT NULL, end_at VARCHAR(255) DEFAULT NULL, year INT NOT NULL, motorisation VARCHAR(255) DEFAULT NULL, cv_f INT DEFAULT NULL, frame VARCHAR(255) DEFAULT NULL, mark_name VARCHAR(255) NOT NULL, range_name VARCHAR(255) DEFAULT NULL, model_name VARCHAR(255) NOT NULL, INDEX IDX_DF8FBA327975B7E7 (model_id), INDEX IDX_DF8FBA325DE3AC44 (vehicle_mark_id), INDEX IDX_DF8FBA32F790DF25 (vehicle_range_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle_model (id INT AUTO_INCREMENT NOT NULL, vehicle_mark_id INT NOT NULL, vehicle_range_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, range_name VARCHAR(255) DEFAULT NULL, mark_name VARCHAR(255) NOT NULL, INDEX IDX_B53AF2355DE3AC44 (vehicle_mark_id), INDEX IDX_B53AF235F790DF25 (vehicle_range_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE model_version ADD CONSTRAINT FK_DF8FBA327975B7E7 FOREIGN KEY (model_id) REFERENCES vehicle_model (id)');
        $this->addSql('ALTER TABLE model_version ADD CONSTRAINT FK_DF8FBA325DE3AC44 FOREIGN KEY (vehicle_mark_id) REFERENCES vehicle_mark (id)');
        $this->addSql('ALTER TABLE model_version ADD CONSTRAINT FK_DF8FBA32F790DF25 FOREIGN KEY (vehicle_range_id) REFERENCES vehicle_range (id)');
        $this->addSql('ALTER TABLE vehicle_model ADD CONSTRAINT FK_B53AF2355DE3AC44 FOREIGN KEY (vehicle_mark_id) REFERENCES vehicle_mark (id)');
        $this->addSql('ALTER TABLE vehicle_model ADD CONSTRAINT FK_B53AF235F790DF25 FOREIGN KEY (vehicle_range_id) REFERENCES vehicle_range (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_model_version DROP FOREIGN KEY FK_562A6C022832C92');
        $this->addSql('ALTER TABLE model_version DROP FOREIGN KEY FK_DF8FBA327975B7E7');
        $this->addSql('ALTER TABLE product_vehicle_model DROP FOREIGN KEY FK_6FD7EEC7A467B873');
        $this->addSql('DROP TABLE model_version');
        $this->addSql('DROP TABLE vehicle_model');
    }
}
