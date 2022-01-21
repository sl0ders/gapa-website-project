<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220121082256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_vehicle_declination DROP FOREIGN KEY FK_EA22C0A1E2A753C1');
        $this->addSql('ALTER TABLE model_version DROP FOREIGN KEY FK_DF8FBA32F790DF25');
        $this->addSql('ALTER TABLE product_vehicle_range DROP FOREIGN KEY FK_2BC5C657F790DF25');
        $this->addSql('ALTER TABLE vehicle_model DROP FOREIGN KEY FK_B53AF235F790DF25');
        $this->addSql('CREATE TABLE product_vehicle (product_id INT NOT NULL, vehicle_id INT NOT NULL, INDEX IDX_CA59FF364584665A (product_id), INDEX IDX_CA59FF36545317D1 (vehicle_id), PRIMARY KEY(product_id, vehicle_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_vehicle ADD CONSTRAINT FK_CA59FF364584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_vehicle ADD CONSTRAINT FK_CA59FF36545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE product_vehicle_declination');
        $this->addSql('DROP TABLE product_vehicle_range');
        $this->addSql('DROP TABLE vehicle_declination');
        $this->addSql('DROP TABLE vehicle_range');
        $this->addSql('ALTER TABLE category CHANGE is_parent_category is_parent_category TINYINT(1) NOT NULL');
        $this->addSql('DROP INDEX IDX_DF8FBA32F790DF25 ON model_version');
        $this->addSql('ALTER TABLE model_version DROP vehicle_range_id, DROP mark_name, DROP range_name');
        $this->addSql('DROP INDEX IDX_B53AF235F790DF25 ON vehicle_model');
        $this->addSql('ALTER TABLE vehicle_model DROP vehicle_range_id, DROP range_name, DROP mark_name');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_vehicle_declination (product_id INT NOT NULL, vehicle_declination_id INT NOT NULL, INDEX IDX_EA22C0A14584665A (product_id), INDEX IDX_EA22C0A1E2A753C1 (vehicle_declination_id), PRIMARY KEY(product_id, vehicle_declination_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE product_vehicle_range (product_id INT NOT NULL, vehicle_range_id INT NOT NULL, INDEX IDX_2BC5C6574584665A (product_id), INDEX IDX_2BC5C657F790DF25 (vehicle_range_id), PRIMARY KEY(product_id, vehicle_range_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE vehicle_declination (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE vehicle_range (id INT AUTO_INCREMENT NOT NULL, vehicle_mark_id INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, mark_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_F128DAA55DE3AC44 (vehicle_mark_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE product_vehicle_declination ADD CONSTRAINT FK_EA22C0A14584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_vehicle_declination ADD CONSTRAINT FK_EA22C0A1E2A753C1 FOREIGN KEY (vehicle_declination_id) REFERENCES vehicle_declination (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_vehicle_range ADD CONSTRAINT FK_2BC5C6574584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product_vehicle_range ADD CONSTRAINT FK_2BC5C657F790DF25 FOREIGN KEY (vehicle_range_id) REFERENCES vehicle_range (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicle_range ADD CONSTRAINT FK_F128DAA55DE3AC44 FOREIGN KEY (vehicle_mark_id) REFERENCES vehicle_mark (id)');
        $this->addSql('DROP TABLE product_vehicle');
        $this->addSql('ALTER TABLE category CHANGE is_parent_category is_parent_category TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE model_version ADD vehicle_range_id INT DEFAULT NULL, ADD mark_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD range_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE model_version ADD CONSTRAINT FK_DF8FBA32F790DF25 FOREIGN KEY (vehicle_range_id) REFERENCES vehicle_range (id)');
        $this->addSql('CREATE INDEX IDX_DF8FBA32F790DF25 ON model_version (vehicle_range_id)');
        $this->addSql('ALTER TABLE vehicle_model ADD vehicle_range_id INT DEFAULT NULL, ADD range_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD mark_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE vehicle_model ADD CONSTRAINT FK_B53AF235F790DF25 FOREIGN KEY (vehicle_range_id) REFERENCES vehicle_range (id)');
        $this->addSql('CREATE INDEX IDX_B53AF235F790DF25 ON vehicle_model (vehicle_range_id)');
    }
}
