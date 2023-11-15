<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231113122233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE meres (id INT AUTO_INCREMENT NOT NULL, nom_id INT NOT NULL, prenom_id INT NOT NULL, profession_id INT NOT NULL, telephone1_id INT DEFAULT NULL, telephone2_id INT DEFAULT NULL, created_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, fullname VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', slug VARCHAR(128) NOT NULL, INDEX IDX_2D8B408AC8121CE9 (nom_id), INDEX IDX_2D8B408A58819F9E (prenom_id), INDEX IDX_2D8B408AFDEF8996 (profession_id), UNIQUE INDEX UNIQ_2D8B408A9420D165 (telephone1_id), UNIQUE INDEX UNIQ_2D8B408A86957E8B (telephone2_id), INDEX IDX_2D8B408AB03A8386 (created_by_id), INDEX IDX_2D8B408A896DBBDE (updated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE peres (id INT AUTO_INCREMENT NOT NULL, nom_id INT NOT NULL, prenom_id INT NOT NULL, profession_id INT NOT NULL, created_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, fullname VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', slug VARCHAR(128) NOT NULL, INDEX IDX_B5FB13B9C8121CE9 (nom_id), INDEX IDX_B5FB13B958819F9E (prenom_id), INDEX IDX_B5FB13B9FDEF8996 (profession_id), INDEX IDX_B5FB13B9B03A8386 (created_by_id), INDEX IDX_B5FB13B9896DBBDE (updated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE meres ADD CONSTRAINT FK_2D8B408AC8121CE9 FOREIGN KEY (nom_id) REFERENCES noms (id)');
        $this->addSql('ALTER TABLE meres ADD CONSTRAINT FK_2D8B408A58819F9E FOREIGN KEY (prenom_id) REFERENCES prenoms (id)');
        $this->addSql('ALTER TABLE meres ADD CONSTRAINT FK_2D8B408AFDEF8996 FOREIGN KEY (profession_id) REFERENCES professions (id)');
        $this->addSql('ALTER TABLE meres ADD CONSTRAINT FK_2D8B408A9420D165 FOREIGN KEY (telephone1_id) REFERENCES telephones (id)');
        $this->addSql('ALTER TABLE meres ADD CONSTRAINT FK_2D8B408A86957E8B FOREIGN KEY (telephone2_id) REFERENCES telephones (id)');
        $this->addSql('ALTER TABLE meres ADD CONSTRAINT FK_2D8B408AB03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE meres ADD CONSTRAINT FK_2D8B408A896DBBDE FOREIGN KEY (updated_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE peres ADD CONSTRAINT FK_B5FB13B9C8121CE9 FOREIGN KEY (nom_id) REFERENCES noms (id)');
        $this->addSql('ALTER TABLE peres ADD CONSTRAINT FK_B5FB13B958819F9E FOREIGN KEY (prenom_id) REFERENCES prenoms (id)');
        $this->addSql('ALTER TABLE peres ADD CONSTRAINT FK_B5FB13B9FDEF8996 FOREIGN KEY (profession_id) REFERENCES professions (id)');
        $this->addSql('ALTER TABLE peres ADD CONSTRAINT FK_B5FB13B9B03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE peres ADD CONSTRAINT FK_B5FB13B9896DBBDE FOREIGN KEY (updated_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE telephones ADD pere1_id INT NOT NULL, ADD pere2_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE telephones ADD CONSTRAINT FK_6FCD09FD653FAAA FOREIGN KEY (pere1_id) REFERENCES peres (id)');
        $this->addSql('ALTER TABLE telephones ADD CONSTRAINT FK_6FCD09FC4E65544 FOREIGN KEY (pere2_id) REFERENCES peres (id)');
        $this->addSql('CREATE INDEX IDX_6FCD09FD653FAAA ON telephones (pere1_id)');
        $this->addSql('CREATE INDEX IDX_6FCD09FC4E65544 ON telephones (pere2_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE telephones DROP FOREIGN KEY FK_6FCD09FD653FAAA');
        $this->addSql('ALTER TABLE telephones DROP FOREIGN KEY FK_6FCD09FC4E65544');
        $this->addSql('ALTER TABLE meres DROP FOREIGN KEY FK_2D8B408AC8121CE9');
        $this->addSql('ALTER TABLE meres DROP FOREIGN KEY FK_2D8B408A58819F9E');
        $this->addSql('ALTER TABLE meres DROP FOREIGN KEY FK_2D8B408AFDEF8996');
        $this->addSql('ALTER TABLE meres DROP FOREIGN KEY FK_2D8B408A9420D165');
        $this->addSql('ALTER TABLE meres DROP FOREIGN KEY FK_2D8B408A86957E8B');
        $this->addSql('ALTER TABLE meres DROP FOREIGN KEY FK_2D8B408AB03A8386');
        $this->addSql('ALTER TABLE meres DROP FOREIGN KEY FK_2D8B408A896DBBDE');
        $this->addSql('ALTER TABLE peres DROP FOREIGN KEY FK_B5FB13B9C8121CE9');
        $this->addSql('ALTER TABLE peres DROP FOREIGN KEY FK_B5FB13B958819F9E');
        $this->addSql('ALTER TABLE peres DROP FOREIGN KEY FK_B5FB13B9FDEF8996');
        $this->addSql('ALTER TABLE peres DROP FOREIGN KEY FK_B5FB13B9B03A8386');
        $this->addSql('ALTER TABLE peres DROP FOREIGN KEY FK_B5FB13B9896DBBDE');
        $this->addSql('DROP TABLE meres');
        $this->addSql('DROP TABLE peres');
        $this->addSql('DROP INDEX IDX_6FCD09FD653FAAA ON telephones');
        $this->addSql('DROP INDEX IDX_6FCD09FC4E65544 ON telephones');
        $this->addSql('ALTER TABLE telephones DROP pere1_id, DROP pere2_id');
    }
}
