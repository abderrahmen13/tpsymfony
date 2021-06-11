<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210101231249 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bid ADD user_id INT DEFAULT NULL, ADD product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bid ADD CONSTRAINT FK_4AF2B3F3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE bid ADD CONSTRAINT FK_4AF2B3F34584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_4AF2B3F3A76ED395 ON bid (user_id)');
        $this->addSql('CREATE INDEX IDX_4AF2B3F34584665A ON bid (product_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bid DROP FOREIGN KEY FK_4AF2B3F3A76ED395');
        $this->addSql('ALTER TABLE bid DROP FOREIGN KEY FK_4AF2B3F34584665A');
        $this->addSql('DROP INDEX IDX_4AF2B3F3A76ED395 ON bid');
        $this->addSql('DROP INDEX IDX_4AF2B3F34584665A ON bid');
        $this->addSql('ALTER TABLE bid DROP user_id, DROP product_id');
    }
}
