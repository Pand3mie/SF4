<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181008081736 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE social ADD relation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE social ADD CONSTRAINT FK_7161E1873256915B FOREIGN KEY (relation_id) REFERENCES fos_user (id)');
        $this->addSql('CREATE INDEX IDX_7161E1873256915B ON social (relation_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE social DROP FOREIGN KEY FK_7161E1873256915B');
        $this->addSql('DROP INDEX IDX_7161E1873256915B ON social');
        $this->addSql('ALTER TABLE social DROP relation_id');
    }
}
