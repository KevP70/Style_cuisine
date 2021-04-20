<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210420112658 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image_after ADD categories_id INT NOT NULL');
        $this->addSql('ALTER TABLE image_after ADD CONSTRAINT FK_9E01CAE8A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_9E01CAE8A21214B7 ON image_after (categories_id)');
        $this->addSql('ALTER TABLE image_before ADD categories_id INT NOT NULL');
        $this->addSql('ALTER TABLE image_before ADD CONSTRAINT FK_77260366A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_77260366A21214B7 ON image_before (categories_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image_after DROP FOREIGN KEY FK_9E01CAE8A21214B7');
        $this->addSql('DROP INDEX IDX_9E01CAE8A21214B7 ON image_after');
        $this->addSql('ALTER TABLE image_after DROP categories_id');
        $this->addSql('ALTER TABLE image_before DROP FOREIGN KEY FK_77260366A21214B7');
        $this->addSql('DROP INDEX IDX_77260366A21214B7 ON image_before');
        $this->addSql('ALTER TABLE image_before DROP categories_id');
    }
}
