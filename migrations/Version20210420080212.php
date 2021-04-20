<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210420080212 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image_test (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image_before ADD CONSTRAINT FK_7726036687A24BE4 FOREIGN KEY (image_after_id) REFERENCES image_after (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7726036687A24BE4 ON image_before (image_after_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE image_test');
        $this->addSql('ALTER TABLE image_before DROP FOREIGN KEY FK_7726036687A24BE4');
        $this->addSql('DROP INDEX UNIQ_7726036687A24BE4 ON image_before');
    }
}
