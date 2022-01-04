<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220104141454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_slip_detail (id INT AUTO_INCREMENT NOT NULL, order_slip_id INT NOT NULL, order_detail_id INT NOT NULL, quantity_product INT NOT NULL, INDEX IDX_CAE7FF67AFBDDA20 (order_slip_id), INDEX IDX_CAE7FF6764577843 (order_detail_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_slip_detail ADD CONSTRAINT FK_CAE7FF67AFBDDA20 FOREIGN KEY (order_slip_id) REFERENCES order_slip (id)');
        $this->addSql('ALTER TABLE order_slip_detail ADD CONSTRAINT FK_CAE7FF6764577843 FOREIGN KEY (order_detail_id) REFERENCES order_detail (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE order_slip_detail');
    }
}
