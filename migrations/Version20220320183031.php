<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220320183031 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actor DROP CONSTRAINT fk_447556f9939610ee');
        $this->addSql('ALTER TABLE director DROP CONSTRAINT fk_1e90d3f0939610ee');
        $this->addSql('DROP SEQUENCE films_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE film_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE film (id INT NOT NULL, title VARCHAR(255) NOT NULL, publication_date DATE DEFAULT NULL, gender VARCHAR(255) DEFAULT NULL, duration VARCHAR(255) DEFAULT NULL, producer VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE films');
        $this->addSql('DROP INDEX idx_447556f9939610ee');
        $this->addSql('ALTER TABLE actor RENAME COLUMN films_id TO film_id');
        $this->addSql('ALTER TABLE actor ADD CONSTRAINT FK_447556F9567F5183 FOREIGN KEY (film_id) REFERENCES film (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_447556F9567F5183 ON actor (film_id)');
        $this->addSql('DROP INDEX idx_1e90d3f0939610ee');
        $this->addSql('ALTER TABLE director RENAME COLUMN films_id TO film_id');
        $this->addSql('ALTER TABLE director ADD CONSTRAINT FK_1E90D3F0567F5183 FOREIGN KEY (film_id) REFERENCES film (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_1E90D3F0567F5183 ON director (film_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE actor DROP CONSTRAINT FK_447556F9567F5183');
        $this->addSql('ALTER TABLE director DROP CONSTRAINT FK_1E90D3F0567F5183');
        $this->addSql('DROP SEQUENCE film_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE films_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE films (id INT NOT NULL, title VARCHAR(255) NOT NULL, publication_date DATE DEFAULT NULL, gender VARCHAR(255) DEFAULT NULL, duration VARCHAR(255) DEFAULT NULL, producer VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE film');
        $this->addSql('DROP INDEX IDX_447556F9567F5183');
        $this->addSql('ALTER TABLE actor RENAME COLUMN film_id TO films_id');
        $this->addSql('ALTER TABLE actor ADD CONSTRAINT fk_447556f9939610ee FOREIGN KEY (films_id) REFERENCES films (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_447556f9939610ee ON actor (films_id)');
        $this->addSql('DROP INDEX IDX_1E90D3F0567F5183');
        $this->addSql('ALTER TABLE director RENAME COLUMN film_id TO films_id');
        $this->addSql('ALTER TABLE director ADD CONSTRAINT fk_1e90d3f0939610ee FOREIGN KEY (films_id) REFERENCES films (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_1e90d3f0939610ee ON director (films_id)');
    }
}
