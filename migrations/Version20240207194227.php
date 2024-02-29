<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240207194227 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_527EDB25A76ED395 ON task (user_id)');
    }

    public function postUp(Schema $schema): void
    {
        $this->connection->insert('user', [
            'username' => 'Anonymous',
            'email' => 'anonymous@example.com',
            'roles' => '["ROLE_ANONYMOUS"]',
            'password' => 'anonymous',
        ]);

        $user = $this->connection->fetchAssociative('SELECT * FROM user WHERE email = ?', [
            'anonymous@example.com',
        ]);

        $this->connection->update('task', [
           'user_id' => $user['id'],
        ], ['user_id' => null]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25A76ED395');
        $this->addSql('DROP INDEX IDX_527EDB25A76ED395 ON task');
        $this->addSql('ALTER TABLE task DROP user_id');
    }

    public function postDown(Schema $schema): void
    {
        $this->connection->delete('user', ['email' => 'anonymous@example.com']);
    }
}
