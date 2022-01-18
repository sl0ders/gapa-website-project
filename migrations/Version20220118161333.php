<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220118161333 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_vehicle_mark (product_id INT NOT NULL, vehicle_mark_id INT NOT NULL, INDEX IDX_994DE3464584665A (product_id), INDEX IDX_994DE3465DE3AC44 (vehicle_mark_id), PRIMARY KEY(product_id, vehicle_mark_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_vehicle_model (product_id INT NOT NULL, vehicle_model_id INT NOT NULL, INDEX IDX_6FD7EEC74584665A (product_id), INDEX IDX_6FD7EEC7A467B873 (vehicle_model_id), PRIMARY KEY(product_id, vehicle_model_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_vehicle_range (product_id INT NOT NULL, vehicle_range_id INT NOT NULL, INDEX IDX_2BC5C6574584665A (product_id), INDEX IDX_2BC5C657F790DF25 (vehicle_range_id), PRIMARY KEY(product_id, vehicle_range_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_vehicle_mark ADD CONSTRAINT FK_994DE3464584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_vehicle_mark ADD CONSTRAINT FK_994DE3465DE3AC44 FOREIGN KEY (vehicle_mark_id) REFERENCES vehicle_mark (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_vehicle_model ADD CONSTRAINT FK_6FD7EEC74584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_vehicle_model ADD CONSTRAINT FK_6FD7EEC7A467B873 FOREIGN KEY (vehicle_model_id) REFERENCES vehicle_model (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_vehicle_range ADD CONSTRAINT FK_2BC5C6574584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_vehicle_range ADD CONSTRAINT FK_2BC5C657F790DF25 FOREIGN KEY (vehicle_range_id) REFERENCES vehicle_range (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE product_model_version');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_model_version (product_id INT NOT NULL, model_version_id INT NOT NULL, INDEX IDX_562A6C04584665A (product_id), INDEX IDX_562A6C022832C92 (model_version_id), PRIMARY KEY(product_id, model_version_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE product_model_version ADD CONSTRAINT FK_562A6C022832C92 FOREIGN KEY (model_version_id) REFERENCES model_version (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_model_version ADD CONSTRAINT FK_562A6C04584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE product_vehicle_mark');
        $this->addSql('DROP TABLE product_vehicle_model');
        $this->addSql('DROP TABLE product_vehicle_range');
    }
}
