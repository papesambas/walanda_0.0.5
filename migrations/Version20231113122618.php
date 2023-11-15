<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231113122618 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE peres ADD telephone1_id INT NOT NULL, ADD telephone2_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE peres ADD CONSTRAINT FK_B5FB13B99420D165 FOREIGN KEY (telephone1_id) REFERENCES telephones (id)');
        $this->addSql('ALTER TABLE peres ADD CONSTRAINT FK_B5FB13B986957E8B FOREIGN KEY (telephone2_id) REFERENCES telephones (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B5FB13B99420D165 ON peres (telephone1_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B5FB13B986957E8B ON peres (telephone2_id)');
        $this->addSql('ALTER TABLE telephones DROP FOREIGN KEY FK_6FCD09FC4E65544');
        $this->addSql('ALTER TABLE telephones DROP FOREIGN KEY FK_6FCD09FD653FAAA');
        $this->addSql('DROP INDEX IDX_6FCD09FD653FAAA ON telephones');
        $this->addSql('DROP INDEX IDX_6FCD09FC4E65544 ON telephones');
        $this->addSql('ALTER TABLE telephones DROP pere1_id, DROP pere2_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE peres DROP FOREIGN KEY FK_B5FB13B99420D165');
        $this->addSql('ALTER TABLE peres DROP FOREIGN KEY FK_B5FB13B986957E8B');
        $this->addSql('DROP INDEX UNIQ_B5FB13B99420D165 ON peres');
        $this->addSql('DROP INDEX UNIQ_B5FB13B986957E8B ON peres');
        $this->addSql('ALTER TABLE peres DROP telephone1_id, DROP telephone2_id');
        $this->addSql('ALTER TABLE telephones ADD pere1_id INT NOT NULL, ADD pere2_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE telephones ADD CONSTRAINT FK_6FCD09FC4E65544 FOREIGN KEY (pere2_id) REFERENCES peres (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE telephones ADD CONSTRAINT FK_6FCD09FD653FAAA FOREIGN KEY (pere1_id) REFERENCES peres (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_6FCD09FD653FAAA ON telephones (pere1_id)');
        $this->addSql('CREATE INDEX IDX_6FCD09FC4E65544 ON telephones (pere2_id)');
    }
}
