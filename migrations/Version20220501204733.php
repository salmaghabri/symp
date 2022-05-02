<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220501204733 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personnes ADD created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE voiture ADD personne_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810FA21BD112 FOREIGN KEY (personne_id) REFERENCES personnes (id)');
        $this->addSql('CREATE INDEX IDX_E9E2810FA21BD112 ON voiture (personne_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personnes DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810FA21BD112');
        $this->addSql('DROP INDEX IDX_E9E2810FA21BD112 ON voiture');
        $this->addSql('ALTER TABLE voiture DROP personne_id');
    }
}
