<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220109123742 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, address1 LONGTEXT NOT NULL, address2 LONGTEXT DEFAULT NULL, post_code BIGINT NOT NULL, phone VARCHAR(155) DEFAULT NULL, phone_mobile VARCHAR(155) DEFAULT NULL, is_enabled TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carrier (id INT AUTO_INCREMENT NOT NULL, delivery_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, position INT NOT NULL, url VARCHAR(255) DEFAULT NULL, is_free TINYINT(1) NOT NULL, is_enabled TINYINT(1) NOT NULL, INDEX IDX_4739F11C12136921 (delivery_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, carrier_id INT NOT NULL, customer_id INT NOT NULL, delivery_option LONGTEXT DEFAULT NULL, delivery_address LONGTEXT NOT NULL, invoice_address LONGTEXT NOT NULL, secure_key VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, validate_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_BA388B721DFC797 (carrier_id), INDEX IDX_BA388B79395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart_product (id INT AUTO_INCREMENT NOT NULL, cart_id INT NOT NULL, product_id INT NOT NULL, delivery_address LONGTEXT NOT NULL, quantity INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_2890CCAA1AD5CDBF (cart_id), INDEX IDX_2890CCAA4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, position INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, iso_code VARCHAR(255) NOT NULL, call_prefix VARCHAR(255) DEFAULT NULL, is_enabled TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, is_add_newsletter TINYINT(1) NOT NULL, newsletter_sub_at DATETIME DEFAULT NULL, last_visit DATETIME DEFAULT NULL, note LONGTEXT DEFAULT NULL, birthday DATETIME DEFAULT NULL, INDEX IDX_81398E09A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE delivery (id INT AUTO_INCREMENT NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE file (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, format VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT NOT NULL, is_private TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, read_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model_version (id INT AUTO_INCREMENT NOT NULL, model_id INT NOT NULL, name VARCHAR(255) NOT NULL, begin_at DATETIME NOT NULL, end_at DATETIME NOT NULL, INDEX IDX_DF8FBA327975B7E7 (model_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT NOT NULL, path VARCHAR(255) DEFAULT NULL, id_path INT DEFAULT NULL, created_at DATETIME NOT NULL, read_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, order_state_id INT NOT NULL, order_history_id INT DEFAULT NULL, customer_id INT DEFAULT NULL, delivery_id INT DEFAULT NULL, cart_id INT DEFAULT NULL, reference VARCHAR(255) NOT NULL, total_price_ht DOUBLE PRECISION NOT NULL, total_price_ttc DOUBLE PRECISION NOT NULL, address_delivery LONGTEXT NOT NULL, address_invoice LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_F5299398A76ED395 (user_id), INDEX IDX_F5299398E420DE70 (order_state_id), INDEX IDX_F5299398ADDF7907 (order_history_id), INDEX IDX_F52993989395C3F3 (customer_id), INDEX IDX_F529939812136921 (delivery_id), INDEX IDX_F52993981AD5CDBF (cart_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_product (order_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_2530ADE68D9F6D38 (order_id), INDEX IDX_2530ADE64584665A (product_id), PRIMARY KEY(order_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_detail (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, ordered_id INT NOT NULL, product_name VARCHAR(255) NOT NULL, product_quantity INT NOT NULL, product_price DOUBLE PRECISION NOT NULL, unit_price_tax_incl DOUBLE PRECISION NOT NULL, unit_price_tax_excl DOUBLE PRECISION NOT NULL, total_shipping_price_tax_incl DOUBLE PRECISION NOT NULL, total_shipping_price_tax_excl DOUBLE PRECISION NOT NULL, purchase_supplier_price DOUBLE PRECISION NOT NULL, original_product_price DOUBLE PRECISION NOT NULL, INDEX IDX_ED896F464584665A (product_id), UNIQUE INDEX UNIQ_ED896F46AA60395A (ordered_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_history (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, order_state_id INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_D1C0D900A76ED395 (user_id), INDEX IDX_D1C0D900E420DE70 (order_state_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_invoice (id INT AUTO_INCREMENT NOT NULL, ordered_id INT DEFAULT NULL, customer_id INT DEFAULT NULL, number INT NOT NULL, total_paid_tax_excl DOUBLE PRECISION NOT NULL, total_paid_tax_incl DOUBLE PRECISION NOT NULL, total_discount_tax_excl DOUBLE PRECISION NOT NULL, total_discount_tax_incl DOUBLE PRECISION NOT NULL, total_products_tax_excl DOUBLE PRECISION NOT NULL, total_products_tax_incl DOUBLE PRECISION NOT NULL, total_shipping_tax_incl DOUBLE PRECISION NOT NULL, total_shipping_tax_excl DOUBLE PRECISION NOT NULL, invoice_address LONGTEXT NOT NULL, delivery_address LONGTEXT NOT NULL, note LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, delivery_at DATETIME NOT NULL, INDEX IDX_661FBE0FAA60395A (ordered_id), INDEX IDX_661FBE0F9395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_invoice_payment (id INT AUTO_INCREMENT NOT NULL, ordered_id INT DEFAULT NULL, order_invoice_id INT NOT NULL, order_payment_id INT NOT NULL, INDEX IDX_54F87182AA60395A (ordered_id), INDEX IDX_54F871829A530CA8 (order_invoice_id), INDEX IDX_54F87182B7195EEE (order_payment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_payment (id INT AUTO_INCREMENT NOT NULL, order_reference VARCHAR(255) NOT NULL, amount DOUBLE PRECISION NOT NULL, payment_method VARCHAR(255) NOT NULL, transaction_id VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_return (id INT AUTO_INCREMENT NOT NULL, ordered_id INT DEFAULT NULL, state VARCHAR(255) NOT NULL, question LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_64112FDAAA60395A (ordered_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_return_detail (id INT AUTO_INCREMENT NOT NULL, order_detail_id INT NOT NULL, order_return_id INT NOT NULL, quantity_product INT NOT NULL, INDEX IDX_C7B8AD9E64577843 (order_detail_id), INDEX IDX_C7B8AD9E9EF36D2D (order_return_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_slip (id INT AUTO_INCREMENT NOT NULL, ordered_id INT NOT NULL, total_products_tax_excl DOUBLE PRECISION NOT NULL, total_products_tax_incl DOUBLE PRECISION NOT NULL, total_shipping_tax_excl DOUBLE PRECISION NOT NULL, total_shipping_tax_incl DOUBLE PRECISION NOT NULL, shipping_cost_amount DOUBLE PRECISION NOT NULL, amount DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_B0C879EFAA60395A (ordered_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_slip_detail (id INT AUTO_INCREMENT NOT NULL, order_slip_id INT NOT NULL, order_detail_id INT NOT NULL, quantity_product INT NOT NULL, INDEX IDX_CAE7FF67AFBDDA20 (order_slip_id), INDEX IDX_CAE7FF6764577843 (order_detail_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_state (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, is_sent_email TINYINT(1) NOT NULL, color VARCHAR(255) NOT NULL, is_paid TINYINT(1) NOT NULL, is_pdf_invoice TINYINT(1) NOT NULL, is_shipped TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, width INT NOT NULL, height INT NOT NULL, format VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, provider_id INT NOT NULL, version_motorisation_id INT DEFAULT NULL, version_frame_id INT DEFAULT NULL, original_reference VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, reference VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, lenght DOUBLE PRECISION DEFAULT NULL, width DOUBLE PRECISION DEFAULT NULL, height DOUBLE PRECISION DEFAULT NULL, price DOUBLE PRECISION NOT NULL, price_ttc DOUBLE PRECISION NOT NULL, specificity LONGTEXT DEFAULT NULL, meta_description LONGTEXT DEFAULT NULL, meta_title LONGTEXT DEFAULT NULL, meta_keyword LONGTEXT DEFAULT NULL, position INT NOT NULL, is_enabled TINYINT(1) NOT NULL, add_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, depth DOUBLE PRECISION DEFAULT NULL, depth_in DOUBLE PRECISION DEFAULT NULL, weight DOUBLE PRECISION DEFAULT NULL, upc BIGINT DEFAULT NULL, country_of_origin VARCHAR(255) DEFAULT NULL, currency VARCHAR(4) DEFAULT NULL, retail_price DOUBLE PRECISION DEFAULT NULL, tariffcode VARCHAR(255) DEFAULT NULL, is_in_stock SMALLINT DEFAULT NULL, is_on_sale TINYINT(1) NOT NULL, INDEX IDX_D34A04ADC54C8C93 (type_id), INDEX IDX_D34A04ADA53A8AA (provider_id), INDEX IDX_D34A04AD98622189 (version_motorisation_id), INDEX IDX_D34A04AD53599F4F (version_frame_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_picture (product_id INT NOT NULL, picture_id INT NOT NULL, INDEX IDX_C70254394584665A (product_id), INDEX IDX_C7025439EE45BDBF (picture_id), PRIMARY KEY(product_id, picture_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_file (product_id INT NOT NULL, file_id INT NOT NULL, INDEX IDX_17714B14584665A (product_id), INDEX IDX_17714B193CB796C (file_id), PRIMARY KEY(product_id, file_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_category (product_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_CDFC73564584665A (product_id), INDEX IDX_CDFC735612469DE2 (category_id), PRIMARY KEY(product_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE provider (id INT AUTO_INCREMENT NOT NULL, address_id INT NOT NULL, picture_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(155) NOT NULL, url VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_92C4739CF5B7AF75 (address_id), UNIQUE INDEX UNIQ_92C4739CEE45BDBF (picture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE provider_category (provider_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_4E0E7728A53A8AA (provider_id), INDEX IDX_4E0E772812469DE2 (category_id), PRIMARY KEY(provider_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, address_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, title VARCHAR(3) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649F5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle_mark (id INT AUTO_INCREMENT NOT NULL, picture_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_14E9C12DEE45BDBF (picture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle_mark_provider (vehicle_mark_id INT NOT NULL, provider_id INT NOT NULL, INDEX IDX_77C9B7E85DE3AC44 (vehicle_mark_id), INDEX IDX_77C9B7E8A53A8AA (provider_id), PRIMARY KEY(vehicle_mark_id, provider_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle_model (id INT AUTO_INCREMENT NOT NULL, vehicle_mark_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_B53AF2355DE3AC44 (vehicle_mark_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE version_frame (id INT AUTO_INCREMENT NOT NULL, model_version_id INT NOT NULL, name VARCHAR(255) NOT NULL, number VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_B224E8C822832C92 (model_version_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE version_motorisation (id INT AUTO_INCREMENT NOT NULL, model_version_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_4AB23B8522832C92 (model_version_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE carrier ADD CONSTRAINT FK_4739F11C12136921 FOREIGN KEY (delivery_id) REFERENCES delivery (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B721DFC797 FOREIGN KEY (carrier_id) REFERENCES carrier (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B79395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE cart_product ADD CONSTRAINT FK_2890CCAA1AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE cart_product ADD CONSTRAINT FK_2890CCAA4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE model_version ADD CONSTRAINT FK_DF8FBA327975B7E7 FOREIGN KEY (model_id) REFERENCES vehicle_model (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398E420DE70 FOREIGN KEY (order_state_id) REFERENCES order_state (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398ADDF7907 FOREIGN KEY (order_history_id) REFERENCES order_history (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993989395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939812136921 FOREIGN KEY (delivery_id) REFERENCES delivery (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993981AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE68D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE64584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_detail ADD CONSTRAINT FK_ED896F464584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE order_detail ADD CONSTRAINT FK_ED896F46AA60395A FOREIGN KEY (ordered_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_history ADD CONSTRAINT FK_D1C0D900A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE order_history ADD CONSTRAINT FK_D1C0D900E420DE70 FOREIGN KEY (order_state_id) REFERENCES order_state (id)');
        $this->addSql('ALTER TABLE order_invoice ADD CONSTRAINT FK_661FBE0FAA60395A FOREIGN KEY (ordered_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_invoice ADD CONSTRAINT FK_661FBE0F9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE order_invoice_payment ADD CONSTRAINT FK_54F87182AA60395A FOREIGN KEY (ordered_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_invoice_payment ADD CONSTRAINT FK_54F871829A530CA8 FOREIGN KEY (order_invoice_id) REFERENCES order_invoice (id)');
        $this->addSql('ALTER TABLE order_invoice_payment ADD CONSTRAINT FK_54F87182B7195EEE FOREIGN KEY (order_payment_id) REFERENCES order_payment (id)');
        $this->addSql('ALTER TABLE order_return ADD CONSTRAINT FK_64112FDAAA60395A FOREIGN KEY (ordered_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_return_detail ADD CONSTRAINT FK_C7B8AD9E64577843 FOREIGN KEY (order_detail_id) REFERENCES order_detail (id)');
        $this->addSql('ALTER TABLE order_return_detail ADD CONSTRAINT FK_C7B8AD9E9EF36D2D FOREIGN KEY (order_return_id) REFERENCES order_return (id)');
        $this->addSql('ALTER TABLE order_slip ADD CONSTRAINT FK_B0C879EFAA60395A FOREIGN KEY (ordered_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_slip_detail ADD CONSTRAINT FK_CAE7FF67AFBDDA20 FOREIGN KEY (order_slip_id) REFERENCES order_slip (id)');
        $this->addSql('ALTER TABLE order_slip_detail ADD CONSTRAINT FK_CAE7FF6764577843 FOREIGN KEY (order_detail_id) REFERENCES order_detail (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADC54C8C93 FOREIGN KEY (type_id) REFERENCES product_type (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADA53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD98622189 FOREIGN KEY (version_motorisation_id) REFERENCES version_motorisation (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD53599F4F FOREIGN KEY (version_frame_id) REFERENCES version_frame (id)');
        $this->addSql('ALTER TABLE product_picture ADD CONSTRAINT FK_C70254394584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_picture ADD CONSTRAINT FK_C7025439EE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_file ADD CONSTRAINT FK_17714B14584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_file ADD CONSTRAINT FK_17714B193CB796C FOREIGN KEY (file_id) REFERENCES file (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC73564584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC735612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE provider ADD CONSTRAINT FK_92C4739CF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE provider ADD CONSTRAINT FK_92C4739CEE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id)');
        $this->addSql('ALTER TABLE provider_category ADD CONSTRAINT FK_4E0E7728A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE provider_category ADD CONSTRAINT FK_4E0E772812469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE vehicle_mark ADD CONSTRAINT FK_14E9C12DEE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id)');
        $this->addSql('ALTER TABLE vehicle_mark_provider ADD CONSTRAINT FK_77C9B7E85DE3AC44 FOREIGN KEY (vehicle_mark_id) REFERENCES vehicle_mark (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicle_mark_provider ADD CONSTRAINT FK_77C9B7E8A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicle_model ADD CONSTRAINT FK_B53AF2355DE3AC44 FOREIGN KEY (vehicle_mark_id) REFERENCES vehicle_mark (id)');
        $this->addSql('ALTER TABLE version_frame ADD CONSTRAINT FK_B224E8C822832C92 FOREIGN KEY (model_version_id) REFERENCES model_version (id)');
        $this->addSql('ALTER TABLE version_motorisation ADD CONSTRAINT FK_4AB23B8522832C92 FOREIGN KEY (model_version_id) REFERENCES model_version (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE provider DROP FOREIGN KEY FK_92C4739CF5B7AF75');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649F5B7AF75');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B721DFC797');
        $this->addSql('ALTER TABLE cart_product DROP FOREIGN KEY FK_2890CCAA1AD5CDBF');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993981AD5CDBF');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC735612469DE2');
        $this->addSql('ALTER TABLE provider_category DROP FOREIGN KEY FK_4E0E772812469DE2');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B79395C3F3');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993989395C3F3');
        $this->addSql('ALTER TABLE order_invoice DROP FOREIGN KEY FK_661FBE0F9395C3F3');
        $this->addSql('ALTER TABLE carrier DROP FOREIGN KEY FK_4739F11C12136921');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939812136921');
        $this->addSql('ALTER TABLE product_file DROP FOREIGN KEY FK_17714B193CB796C');
        $this->addSql('ALTER TABLE version_frame DROP FOREIGN KEY FK_B224E8C822832C92');
        $this->addSql('ALTER TABLE version_motorisation DROP FOREIGN KEY FK_4AB23B8522832C92');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE68D9F6D38');
        $this->addSql('ALTER TABLE order_detail DROP FOREIGN KEY FK_ED896F46AA60395A');
        $this->addSql('ALTER TABLE order_invoice DROP FOREIGN KEY FK_661FBE0FAA60395A');
        $this->addSql('ALTER TABLE order_invoice_payment DROP FOREIGN KEY FK_54F87182AA60395A');
        $this->addSql('ALTER TABLE order_return DROP FOREIGN KEY FK_64112FDAAA60395A');
        $this->addSql('ALTER TABLE order_slip DROP FOREIGN KEY FK_B0C879EFAA60395A');
        $this->addSql('ALTER TABLE order_return_detail DROP FOREIGN KEY FK_C7B8AD9E64577843');
        $this->addSql('ALTER TABLE order_slip_detail DROP FOREIGN KEY FK_CAE7FF6764577843');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398ADDF7907');
        $this->addSql('ALTER TABLE order_invoice_payment DROP FOREIGN KEY FK_54F871829A530CA8');
        $this->addSql('ALTER TABLE order_invoice_payment DROP FOREIGN KEY FK_54F87182B7195EEE');
        $this->addSql('ALTER TABLE order_return_detail DROP FOREIGN KEY FK_C7B8AD9E9EF36D2D');
        $this->addSql('ALTER TABLE order_slip_detail DROP FOREIGN KEY FK_CAE7FF67AFBDDA20');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398E420DE70');
        $this->addSql('ALTER TABLE order_history DROP FOREIGN KEY FK_D1C0D900E420DE70');
        $this->addSql('ALTER TABLE product_picture DROP FOREIGN KEY FK_C7025439EE45BDBF');
        $this->addSql('ALTER TABLE provider DROP FOREIGN KEY FK_92C4739CEE45BDBF');
        $this->addSql('ALTER TABLE vehicle_mark DROP FOREIGN KEY FK_14E9C12DEE45BDBF');
        $this->addSql('ALTER TABLE cart_product DROP FOREIGN KEY FK_2890CCAA4584665A');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE64584665A');
        $this->addSql('ALTER TABLE order_detail DROP FOREIGN KEY FK_ED896F464584665A');
        $this->addSql('ALTER TABLE product_picture DROP FOREIGN KEY FK_C70254394584665A');
        $this->addSql('ALTER TABLE product_file DROP FOREIGN KEY FK_17714B14584665A');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC73564584665A');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADC54C8C93');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADA53A8AA');
        $this->addSql('ALTER TABLE provider_category DROP FOREIGN KEY FK_4E0E7728A53A8AA');
        $this->addSql('ALTER TABLE vehicle_mark_provider DROP FOREIGN KEY FK_77C9B7E8A53A8AA');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09A76ED395');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('ALTER TABLE order_history DROP FOREIGN KEY FK_D1C0D900A76ED395');
        $this->addSql('ALTER TABLE vehicle_mark_provider DROP FOREIGN KEY FK_77C9B7E85DE3AC44');
        $this->addSql('ALTER TABLE vehicle_model DROP FOREIGN KEY FK_B53AF2355DE3AC44');
        $this->addSql('ALTER TABLE model_version DROP FOREIGN KEY FK_DF8FBA327975B7E7');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD53599F4F');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD98622189');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE carrier');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE cart_product');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE delivery');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE model_version');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_product');
        $this->addSql('DROP TABLE order_detail');
        $this->addSql('DROP TABLE order_history');
        $this->addSql('DROP TABLE order_invoice');
        $this->addSql('DROP TABLE order_invoice_payment');
        $this->addSql('DROP TABLE order_payment');
        $this->addSql('DROP TABLE order_return');
        $this->addSql('DROP TABLE order_return_detail');
        $this->addSql('DROP TABLE order_slip');
        $this->addSql('DROP TABLE order_slip_detail');
        $this->addSql('DROP TABLE order_state');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_picture');
        $this->addSql('DROP TABLE product_file');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('DROP TABLE product_type');
        $this->addSql('DROP TABLE provider');
        $this->addSql('DROP TABLE provider_category');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE vehicle_mark');
        $this->addSql('DROP TABLE vehicle_mark_provider');
        $this->addSql('DROP TABLE vehicle_model');
        $this->addSql('DROP TABLE version_frame');
        $this->addSql('DROP TABLE version_motorisation');
    }
}
