<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220320172242 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE actor_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE director_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE films_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE actor (id INT NOT NULL, films_id INT NOT NULL, name VARCHAR(255) NOT NULL, born_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, dead_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, born_place VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_447556F9939610EE ON actor (films_id)');
        $this->addSql('CREATE TABLE director (id INT NOT NULL, films_id INT NOT NULL, name VARCHAR(255) NOT NULL, born_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1E90D3F0939610EE ON director (films_id)');
        $this->addSql('CREATE TABLE films (id INT NOT NULL, title VARCHAR(255) NOT NULL, publication_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, gender VARCHAR(255) DEFAULT NULL, duration VARCHAR(255) DEFAULT NULL, producer VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE actor ADD CONSTRAINT FK_447556F9939610EE FOREIGN KEY (films_id) REFERENCES films (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE director ADD CONSTRAINT FK_1E90D3F0939610EE FOREIGN KEY (films_id) REFERENCES films (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE actor DROP CONSTRAINT FK_447556F9939610EE');
        $this->addSql('ALTER TABLE director DROP CONSTRAINT FK_1E90D3F0939610EE');
        $this->addSql('DROP SEQUENCE actor_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE director_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE films_id_seq CASCADE');
        $this->addSql('DROP TABLE actor');
        $this->addSql('DROP TABLE director');
        $this->addSql('DROP TABLE films');
    }
}
