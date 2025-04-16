<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250416154902 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE account (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT '(DC2Type:json)', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE account_classe (account_id INT NOT NULL, classe_id INT NOT NULL, INDEX IDX_A8B371E59B6B5FBA (account_id), INDEX IDX_A8B371E58F5EA509 (classe_id), PRIMARY KEY(account_id, classe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acount (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, image LONGBLOB DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, thumbnail LONGBLOB DEFAULT NULL, section JSON NOT NULL COMMENT '(DC2Type:json)', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE file (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, content LONGBLOB NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE account_classe ADD CONSTRAINT FK_A8B371E59B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE account_classe ADD CONSTRAINT FK_A8B371E58F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE class_subscriptions DROP FOREIGN KEY class_subscriptions_ibfk_1
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE class_subscriptions DROP FOREIGN KEY class_subscriptions_ibfk_2
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE accounts
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE classes
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE class_subscriptions
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE files
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE accounts (id INT AUTO_INCREMENT NOT NULL COMMENT 'L''identifiant de l''utilisateur', name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci` COMMENT 'Le nom de l''utilisateur', surname VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci` COMMENT 'Le prénom de l''utilisateur', password TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci` COMMENT 'Le mot de passe de l''utilisateur, encrypté en sha256', image LONGBLOB NOT NULL COMMENT 'L''image de profile de l''utilisateur (format carré de longueur spécifique)', mail VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci` COMMENT 'L''adresse mail de l''utilisateur', description TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci` COMMENT 'La description de l''utilisateur', is-admin TINYINT(1) DEFAULT 0 NOT NULL COMMENT 'Vrai lorsque l''utilisateur est administrateur', verified TINYINT(1) NOT NULL COMMENT 'Vrai lorsque l''adresse mail a été vérifiée', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE classes (id INT AUTO_INCREMENT NOT NULL COMMENT 'L''identifiant du cours', name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci` COMMENT 'Le nom du cours', thumbnail LONGBLOB NOT NULL COMMENT 'L''image d''arrière plan du cours (format paysage spécifique)', section LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin` COMMENT 'JSON de la section de cours correspondante', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE class_subscriptions (account INT NOT NULL COMMENT 'L''identifiant du compte connecté', class INT NOT NULL COMMENT 'L''identifiant du cours', as teacher TINYINT(1) DEFAULT 0 NOT NULL COMMENT 'Vrai lorsque le compte est un professeur', INDEX class (class), INDEX IDX_86B0FC3B7D3656A4 (account), PRIMARY KEY(account, class)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE files (id INT AUTO_INCREMENT NOT NULL COMMENT 'L''identifiant du fichier de données d''activité', type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci` COMMENT 'Le type d''activité', content LONGBLOB NOT NULL COMMENT 'Le fichier de données de l''activité', section INT NOT NULL COMMENT 'L''identifiant de la section associée à cette activité', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE class_subscriptions ADD CONSTRAINT class_subscriptions_ibfk_1 FOREIGN KEY (account) REFERENCES accounts (id) ON UPDATE CASCADE ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE class_subscriptions ADD CONSTRAINT class_subscriptions_ibfk_2 FOREIGN KEY (class) REFERENCES classes (id) ON UPDATE CASCADE ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE account_classe DROP FOREIGN KEY FK_A8B371E59B6B5FBA
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE account_classe DROP FOREIGN KEY FK_A8B371E58F5EA509
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE account
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE account_classe
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acount
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE classe
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE file
        SQL);
    }
}
