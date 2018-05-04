<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180504132246 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE trip DROP FOREIGN KEY FK_7656F53BE4A59390');
        $this->addSql('DROP INDEX IDX_7656F53BE4A59390 ON trip');
        $this->addSql('ALTER TABLE trip CHANGE u_id u_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53B6782F39A FOREIGN KEY (u_id_id) REFERENCES fos_user (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_7656F53B6782F39A ON trip (u_id_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE trip DROP FOREIGN KEY FK_7656F53B6782F39A');
        $this->addSql('DROP INDEX IDX_7656F53B6782F39A ON trip');
        $this->addSql('ALTER TABLE trip CHANGE u_id_id u_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53BE4A59390 FOREIGN KEY (u_id) REFERENCES fos_user (id)');
        $this->addSql('CREATE INDEX IDX_7656F53BE4A59390 ON trip (u_id)');
    }
}
