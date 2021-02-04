<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210204183754 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE podcast ADD domaine_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE podcast ADD CONSTRAINT FK_D7E805BD4272FC9F FOREIGN KEY (domaine_id) REFERENCES domains (id)');
        $this->addSql('CREATE INDEX IDX_D7E805BD4272FC9F ON podcast (domaine_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE podcast DROP FOREIGN KEY FK_D7E805BD4272FC9F');
        $this->addSql('DROP INDEX IDX_D7E805BD4272FC9F ON podcast');
        $this->addSql('ALTER TABLE podcast DROP domaine_id');
    }
}
