<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210207223551 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lives ADD cycle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lives ADD CONSTRAINT FK_5D347E5E5EC1162 FOREIGN KEY (cycle_id) REFERENCES cycle (id)');
        $this->addSql('CREATE INDEX IDX_5D347E5E5EC1162 ON lives (cycle_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lives DROP FOREIGN KEY FK_5D347E5E5EC1162');
        $this->addSql('DROP INDEX IDX_5D347E5E5EC1162 ON lives');
        $this->addSql('ALTER TABLE lives DROP cycle_id');
    }
}
