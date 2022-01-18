<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220118141742 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicle_declination DROP FOREIGN KEY FK_B3632B3322832C92');
        $this->addSql('ALTER TABLE vehicle_declination DROP FOREIGN KEY FK_B3632B337975B7E7');
        $this->addSql('ALTER TABLE vehicle_declination DROP FOREIGN KEY FK_B3632B334290F12B');
        $this->addSql('DROP INDEX IDX_B3632B337975B7E7 ON vehicle_declination');
        $this->addSql('DROP INDEX IDX_B3632B334290F12B ON vehicle_declination');
        $this->addSql('DROP INDEX IDX_B3632B3322832C92 ON vehicle_declination');
        $this->addSql('ALTER TABLE vehicle_declination ADD mark VARCHAR(255) NOT NULL, ADD model VARCHAR(255) NOT NULL, ADD model_version VARCHAR(255) NOT NULL, DROP mark_id, DROP model_id, DROP model_version_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicle_declination ADD mark_id INT NOT NULL, ADD model_id INT NOT NULL, ADD model_version_id INT NOT NULL, DROP mark, DROP model, DROP model_version');
        $this->addSql('ALTER TABLE vehicle_declination ADD CONSTRAINT FK_B3632B3322832C92 FOREIGN KEY (model_version_id) REFERENCES model_version (id)');
        $this->addSql('ALTER TABLE vehicle_declination ADD CONSTRAINT FK_B3632B337975B7E7 FOREIGN KEY (model_id) REFERENCES vehicle_model (id)');
        $this->addSql('ALTER TABLE vehicle_declination ADD CONSTRAINT FK_B3632B334290F12B FOREIGN KEY (mark_id) REFERENCES vehicle_mark (id)');
        $this->addSql('CREATE INDEX IDX_B3632B337975B7E7 ON vehicle_declination (model_id)');
        $this->addSql('CREATE INDEX IDX_B3632B334290F12B ON vehicle_declination (mark_id)');
        $this->addSql('CREATE INDEX IDX_B3632B3322832C92 ON vehicle_declination (model_version_id)');
    }
}
