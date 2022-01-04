<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220104141229 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_return_detail (id INT AUTO_INCREMENT NOT NULL, order_detail_id INT NOT NULL, order_return_id INT NOT NULL, quantity_product INT NOT NULL, INDEX IDX_C7B8AD9E64577843 (order_detail_id), INDEX IDX_C7B8AD9E9EF36D2D (order_return_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_return_detail ADD CONSTRAINT FK_C7B8AD9E64577843 FOREIGN KEY (order_detail_id) REFERENCES order_detail (id)');
        $this->addSql('ALTER TABLE order_return_detail ADD CONSTRAINT FK_C7B8AD9E9EF36D2D FOREIGN KEY (order_return_id) REFERENCES order_return (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE order_return_detail');
    }
}
