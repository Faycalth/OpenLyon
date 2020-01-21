<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200121050902 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE echange_joueur (echange_id INT NOT NULL, joueur_id INT NOT NULL, INDEX IDX_23F19A5413713818 (echange_id), INDEX IDX_23F19A54A9E2D76C (joueur_id), PRIMARY KEY(echange_id, joueur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE echange_joueur ADD CONSTRAINT FK_23F19A5413713818 FOREIGN KEY (echange_id) REFERENCES echange (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE echange_joueur ADD CONSTRAINT FK_23F19A54A9E2D76C FOREIGN KEY (joueur_id) REFERENCES joueur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE echange DROP FOREIGN KEY FK_B577E3BFA9E2D76C');
        $this->addSql('DROP INDEX IDX_B577E3BFA9E2D76C ON echange');
        $this->addSql('ALTER TABLE echange DROP joueur_id, CHANGE contenu contenu VARCHAR(255) NOT NULL, CHANGE afaire afaire VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE echange_joueur');
        $this->addSql('ALTER TABLE echange ADD joueur_id INT DEFAULT NULL, CHANGE contenu contenu LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE afaire afaire LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE echange ADD CONSTRAINT FK_B577E3BFA9E2D76C FOREIGN KEY (joueur_id) REFERENCES joueur (id)');
        $this->addSql('CREATE INDEX IDX_B577E3BFA9E2D76C ON echange (joueur_id)');
    }
}
