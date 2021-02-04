<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210204184753 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lives ADD domaine_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lives ADD CONSTRAINT FK_5D347E5E4272FC9F FOREIGN KEY (domaine_id) REFERENCES domains (id)');
        $this->addSql('CREATE INDEX IDX_5D347E5E4272FC9F ON lives (domaine_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lives DROP FOREIGN KEY FK_5D347E5E4272FC9F');
        $this->addSql('DROP INDEX IDX_5D347E5E4272FC9F ON lives');
        $this->addSql('ALTER TABLE lives DROP domaine_id');
    }
}
