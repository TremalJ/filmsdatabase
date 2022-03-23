<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220320194514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actor_film (actor_id INT NOT NULL, film_id INT NOT NULL, PRIMARY KEY(actor_id, film_id))');
        $this->addSql('CREATE INDEX IDX_B20C8CD110DAF24A ON actor_film (actor_id)');
        $this->addSql('CREATE INDEX IDX_B20C8CD1567F5183 ON actor_film (film_id)');
        $this->addSql('CREATE TABLE director_film (director_id INT NOT NULL, film_id INT NOT NULL, PRIMARY KEY(director_id, film_id))');
        $this->addSql('CREATE INDEX IDX_8AE60F3C899FB366 ON director_film (director_id)');
        $this->addSql('CREATE INDEX IDX_8AE60F3C567F5183 ON director_film (film_id)');
        $this->addSql('ALTER TABLE actor_film ADD CONSTRAINT FK_B20C8CD110DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE actor_film ADD CONSTRAINT FK_B20C8CD1567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE director_film ADD CONSTRAINT FK_8AE60F3C899FB366 FOREIGN KEY (director_id) REFERENCES director (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE director_film ADD CONSTRAINT FK_8AE60F3C567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE actor DROP CONSTRAINT fk_447556f9567f5183');
        $this->addSql('DROP INDEX idx_447556f9567f5183');
        $this->addSql('ALTER TABLE actor DROP film_id');
        $this->addSql('ALTER TABLE director DROP CONSTRAINT fk_1e90d3f0567f5183');
        $this->addSql('DROP INDEX idx_1e90d3f0567f5183');
        $this->addSql('ALTER TABLE director DROP film_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE actor_film');
        $this->addSql('DROP TABLE director_film');
        $this->addSql('ALTER TABLE actor ADD film_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE actor ADD CONSTRAINT fk_447556f9567f5183 FOREIGN KEY (film_id) REFERENCES film (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_447556f9567f5183 ON actor (film_id)');
        $this->addSql('ALTER TABLE director ADD film_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE director ADD CONSTRAINT fk_1e90d3f0567f5183 FOREIGN KEY (film_id) REFERENCES film (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_1e90d3f0567f5183 ON director (film_id)');
    }
}
