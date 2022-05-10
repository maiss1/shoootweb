<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220509212829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stat_joueur DROP FOREIGN KEY fk_comp');
        $this->addSql('ALTER TABLE stats_comp DROP FOREIGN KEY fk_com');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY fk_equipe');
        $this->addSql('ALTER TABLE stats_comp DROP FOREIGN KEY fk_equi');
        $this->addSql('ALTER TABLE stat_joueur DROP FOREIGN KEY fk_joueur');
        $this->addSql('ALTER TABLE statistique DROP FOREIGN KEY fk_match');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY fk_facture');
        $this->addSql('ALTER TABLE competition DROP FOREIGN KEY fk_type');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE cartes');
        $this->addSql('DROP TABLE competition');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE joueur');
        $this->addSql('DROP TABLE matchh');
        $this->addSql('DROP TABLE pan');
        $this->addSql('DROP TABLE panierr');
        $this->addSql('DROP TABLE stat_joueur');
        $this->addSql('DROP TABLE statistique');
        $this->addSql('DROP TABLE stats_comp');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP INDEX userName ON user');
        $this->addSql('ALTER TABLE user DROP userName, CHANGE pwd pwd VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cartes (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, prenom VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, level INT DEFAULT NULL, prix DOUBLE PRECISION DEFAULT NULL, id_premuim INT DEFAULT NULL, imgcarte VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_swedish_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE competition (id_comp INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, nom_comp VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, pays_comp VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, prix_comp DOUBLE PRECISION NOT NULL, image VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, INDEX type (type), INDEX nom_comp (nom_comp), PRIMARY KEY(id_comp)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_swedish_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE equipe (id_equipe INT AUTO_INCREMENT NOT NULL, nom_equipe VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, pays VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, drapeau VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, logo VARCHAR(1255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, INDEX nom_equipe (nom_equipe), PRIMARY KEY(id_equipe)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_swedish_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE facture (idFacture INT AUTO_INCREMENT NOT NULL, DateCreation VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, Total DOUBLE PRECISION NOT NULL, id_panier INT NOT NULL, PRIMARY KEY(idFacture)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_swedish_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE joueur (id_joueur INT AUTO_INCREMENT NOT NULL, nom_equipe VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, nom_joueur VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, dateNaiss DATE NOT NULL, age INT NOT NULL, pays VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, drapeau VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, image VARCHAR(1255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, INDEX fk_equipe (nom_equipe), INDEX nom_joueur (nom_joueur), PRIMARY KEY(id_joueur)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_swedish_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE matchh (Id_match INT NOT NULL, id_equipe1 INT NOT NULL, id_equipe2 INT NOT NULL, date VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, id_comp INT NOT NULL, id_stat INT NOT NULL, id_prono INT NOT NULL, PRIMARY KEY(Id_match)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_swedish_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pan (id_panier INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, INDEX fk_user (id_user), PRIMARY KEY(id_panier)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_swedish_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE panierr (idp INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, prenom VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(idp)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_swedish_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE stat_joueur (idd INT AUTO_INCREMENT NOT NULL, nom_joueur VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, nom_comp VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, but_comp INT DEFAULT 0, assist_comp INT DEFAULT 0, but_total INT DEFAULT 0 NOT NULL, assist_total INT DEFAULT 0 NOT NULL, INDEX fk_joueur (nom_joueur), INDEX fk_comp (nom_comp), PRIMARY KEY(idd)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_swedish_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE statistique (idd INT AUTO_INCREMENT NOT NULL, Id_match INT NOT NULL, TitreMatch VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, But INT NOT NULL, N_Buteur VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, N_Passeur VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, Nb_Corner INT NOT NULL, Nb_faute INT NOT NULL, Nb_Carton INT NOT NULL, INDEX Id_match (Id_match), PRIMARY KEY(idd)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_swedish_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE stats_comp (id_stats INT AUTO_INCREMENT NOT NULL, competition VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, equipe VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, buteur VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, asisst_man VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, date_deb DATE NOT NULL, date_fin DATE NOT NULL, INDEX equipe (equipe), INDEX competition (competition), PRIMARY KEY(id_stats)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_swedish_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE type (id_type INT AUTO_INCREMENT NOT NULL, nom_type VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, INDEX nom_type (nom_type), PRIMARY KEY(id_type)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_swedish_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE competition ADD CONSTRAINT fk_type FOREIGN KEY (type) REFERENCES type (nom_type) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT fk_facture FOREIGN KEY (idFacture) REFERENCES pan (id_panier) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT fk_equipe FOREIGN KEY (nom_equipe) REFERENCES equipe (nom_equipe) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pan ADD CONSTRAINT fk_user FOREIGN KEY (id_user) REFERENCES user (id_user) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stat_joueur ADD CONSTRAINT fk_joueur FOREIGN KEY (nom_joueur) REFERENCES joueur (nom_joueur) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stat_joueur ADD CONSTRAINT fk_comp FOREIGN KEY (nom_comp) REFERENCES competition (nom_comp) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE statistique ADD CONSTRAINT fk_match FOREIGN KEY (Id_match) REFERENCES matchh (Id_match) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stats_comp ADD CONSTRAINT fk_equi FOREIGN KEY (equipe) REFERENCES equipe (nom_equipe) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stats_comp ADD CONSTRAINT fk_com FOREIGN KEY (competition) REFERENCES competition (nom_comp) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('ALTER TABLE user ADD userName VARCHAR(255) DEFAULT NULL, CHANGE pwd pwd VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX userName ON user (userName)');
    }
}
