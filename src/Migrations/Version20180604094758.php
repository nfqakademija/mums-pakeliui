<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180604094758 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reservation ADD offer_id INT DEFAULT NULL, DROP offer');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495553C674EE FOREIGN KEY (offer_id) REFERENCES trip (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_42C8495553C674EE ON reservation (offer_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495553C674EE');
        $this->addSql('DROP INDEX IDX_42C8495553C674EE ON reservation');
        $this->addSql('ALTER TABLE reservation ADD offer VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP offer_id');
    }
}
