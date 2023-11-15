<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231113141046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meres DROP FOREIGN KEY FK_2D8B408A896DBBDE');
        $this->addSql('ALTER TABLE meres DROP FOREIGN KEY FK_2D8B408AB03A8386');
        $this->addSql('DROP INDEX IDX_2D8B408A896DBBDE ON meres');
        $this->addSql('DROP INDEX IDX_2D8B408AB03A8386 ON meres');
        $this->addSql('ALTER TABLE meres DROP created_by_id, DROP updated_by_id');
        $this->addSql('ALTER TABLE parents DROP FOREIGN KEY FK_FD501D6A896DBBDE');
        $this->addSql('ALTER TABLE parents DROP FOREIGN KEY FK_FD501D6AB03A8386');
        $this->addSql('DROP INDEX IDX_FD501D6A896DBBDE ON parents');
        $this->addSql('DROP INDEX IDX_FD501D6AB03A8386 ON parents');
        $this->addSql('ALTER TABLE parents DROP created_by_id, DROP updated_by_id');
        $this->addSql('ALTER TABLE peres DROP FOREIGN KEY FK_B5FB13B9896DBBDE');
        $this->addSql('ALTER TABLE peres DROP FOREIGN KEY FK_B5FB13B9B03A8386');
        $this->addSql('DROP INDEX IDX_B5FB13B9896DBBDE ON peres');
        $this->addSql('DROP INDEX IDX_B5FB13B9B03A8386 ON peres');
        $this->addSql('ALTER TABLE peres DROP created_by_id, DROP updated_by_id');
        $this->addSql('ALTER TABLE professions DROP FOREIGN KEY FK_2FDA85FA896DBBDE');
        $this->addSql('ALTER TABLE professions DROP FOREIGN KEY FK_2FDA85FAB03A8386');
        $this->addSql('DROP INDEX IDX_2FDA85FA896DBBDE ON professions');
        $this->addSql('DROP INDEX IDX_2FDA85FAB03A8386 ON professions');
        $this->addSql('ALTER TABLE professions DROP created_by_id, DROP updated_by_id');
        $this->addSql('ALTER TABLE telephones DROP FOREIGN KEY FK_6FCD09F896DBBDE');
        $this->addSql('ALTER TABLE telephones DROP FOREIGN KEY FK_6FCD09FB03A8386');
        $this->addSql('DROP INDEX IDX_6FCD09F896DBBDE ON telephones');
        $this->addSql('DROP INDEX IDX_6FCD09FB03A8386 ON telephones');
        $this->addSql('ALTER TABLE telephones DROP created_by_id, DROP updated_by_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meres ADD created_by_id INT DEFAULT NULL, ADD updated_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE meres ADD CONSTRAINT FK_2D8B408A896DBBDE FOREIGN KEY (updated_by_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE meres ADD CONSTRAINT FK_2D8B408AB03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_2D8B408A896DBBDE ON meres (updated_by_id)');
        $this->addSql('CREATE INDEX IDX_2D8B408AB03A8386 ON meres (created_by_id)');
        $this->addSql('ALTER TABLE professions ADD created_by_id INT DEFAULT NULL, ADD updated_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE professions ADD CONSTRAINT FK_2FDA85FA896DBBDE FOREIGN KEY (updated_by_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE professions ADD CONSTRAINT FK_2FDA85FAB03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_2FDA85FA896DBBDE ON professions (updated_by_id)');
        $this->addSql('CREATE INDEX IDX_2FDA85FAB03A8386 ON professions (created_by_id)');
        $this->addSql('ALTER TABLE telephones ADD created_by_id INT DEFAULT NULL, ADD updated_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE telephones ADD CONSTRAINT FK_6FCD09F896DBBDE FOREIGN KEY (updated_by_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE telephones ADD CONSTRAINT FK_6FCD09FB03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_6FCD09F896DBBDE ON telephones (updated_by_id)');
        $this->addSql('CREATE INDEX IDX_6FCD09FB03A8386 ON telephones (created_by_id)');
        $this->addSql('ALTER TABLE parents ADD created_by_id INT DEFAULT NULL, ADD updated_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE parents ADD CONSTRAINT FK_FD501D6A896DBBDE FOREIGN KEY (updated_by_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE parents ADD CONSTRAINT FK_FD501D6AB03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_FD501D6A896DBBDE ON parents (updated_by_id)');
        $this->addSql('CREATE INDEX IDX_FD501D6AB03A8386 ON parents (created_by_id)');
        $this->addSql('ALTER TABLE peres ADD created_by_id INT DEFAULT NULL, ADD updated_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE peres ADD CONSTRAINT FK_B5FB13B9896DBBDE FOREIGN KEY (updated_by_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE peres ADD CONSTRAINT FK_B5FB13B9B03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_B5FB13B9896DBBDE ON peres (updated_by_id)');
        $this->addSql('CREATE INDEX IDX_B5FB13B9B03A8386 ON peres (created_by_id)');
    }
}
