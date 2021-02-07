<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210207223527 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_culturelle ADD cycle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE offre_culturelle ADD CONSTRAINT FK_B00BDCA25EC1162 FOREIGN KEY (cycle_id) REFERENCES cycle (id)');
        $this->addSql('CREATE INDEX IDX_B00BDCA25EC1162 ON offre_culturelle (cycle_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_culturelle DROP FOREIGN KEY FK_B00BDCA25EC1162');
        $this->addSql('DROP INDEX IDX_B00BDCA25EC1162 ON offre_culturelle');
        $this->addSql('ALTER TABLE offre_culturelle DROP cycle_id');
    }
}
