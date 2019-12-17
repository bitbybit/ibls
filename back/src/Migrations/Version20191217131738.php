<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191217131738 extends AbstractMigration
{

    public function getDescription() : string
    {
        return 'Initial';
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\DBALException
     */
    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE `guestbook` (`id` bigint(20) NOT NULL, `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT \'Имя пользователя\', `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT \'Email\', `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT \'Сообщение\', `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT \'Дата отправки\') ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT=\'Гостевая книга\';');

        $this->addSql('ALTER TABLE `guestbook` ADD PRIMARY KEY (`id`);');

        $this->addSql('ALTER TABLE `guestbook` MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;');
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\DBALException
     */
    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE guestbook');
    }

}
