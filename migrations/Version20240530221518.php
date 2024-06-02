<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240530221518 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__book AS SELECT id, name, author, image FROM book');
        $this->addSql('DROP TABLE book');
        $this->addSql('CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO book (id, name, author, image) SELECT id, name, author, image FROM __temp__book');
        $this->addSql('DROP TABLE __temp__book');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__book AS SELECT id, name, author, image FROM book');
        $this->addSql('DROP TABLE book');
        $this->addSql('CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO book (id, name, author, image) SELECT id, name, author, image FROM __temp__book');
        $this->addSql('DROP TABLE __temp__book');
    }
}
