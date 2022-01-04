<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220104131626 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicle_mark ADD picture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicle_mark ADD CONSTRAINT FK_14E9C12DEE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_14E9C12DEE45BDBF ON vehicle_mark (picture_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicle_mark DROP FOREIGN KEY FK_14E9C12DEE45BDBF');
        $this->addSql('DROP INDEX UNIQ_14E9C12DEE45BDBF ON vehicle_mark');
        $this->addSql('ALTER TABLE vehicle_mark DROP picture_id');
    }
}
