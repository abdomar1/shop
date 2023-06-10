drop database if exists click_shop;
create database if not exists click_shop;
use click_shop;
#-----------------------------------------------------------------------------------------------------------------------
#                                            table client
#-----------------------------------------------------------------------------------------------------------------------
drop table if exists client;
CREATE TABLE `client` (
                          `id_client` int(11) primary key auto_increment,
                          `nom_clinet` varchar(150) DEFAULT NULL,
                          `Adress_client` varchar(200) DEFAULT NULL,
                          `tel_client` int(10) DEFAULT NULL,
                          `type_client` varchar(100) DEFAULT 'Nouveau',
                          `password` varchar(200) DEFAULT NULL,
                          `email` varchar(100) DEFAULT NULL,
                          `sexe` varchar(5) ,
                          `profil_client` varchar(1000) NOT NULL DEFAULT '../assets/images/user/user.png'
) ;
INSERT INTO `client` (`id_client`, `nom_clinet`, `Adress_client`, `tel_client`, `type_client`, `password`, `email`,sexe, `profil_client`) VALUES
                                                                                                                                              (1, 'omar', 'fes', 611111111, 'novo', 'omar1', 'omar@gmail.com','Homme', '../assets/images/user/user.png'),
                                                                                                                                              (2, 'ayoub', 'fes', 622222222, 'novo', 'ayoub2', 'ayoub@gmail.com','Homme', '../assets/images/user/user.png'),
                                                                                                                                              (3, 'abdo', 'fes', 633333333, 'novo', 'abdo3', 'abdo@gmail.com','Homme', '../assets/images/user/user.png'),
                                                                                                                                              (4, 'mohammed', 'saada_fes', 62342320, 'F', 'mohamed123', 'mohamed@gmail.com','Homme', '../assets/images/user/user.png'),
                                                                                                                                              (5, 'ayoub', 'massira_fes', 6232520, 'Fdele', 'ayoub123', 'ayoub@gmail.com','Homme', '../assets/images/user/user.png'),
                                                                                                                                              (6, 'meryem', 'nargis', 62123524, 'Fdele', 'meryem123', 'meryem@gmail.com','Femme', '../assets/images/user/user.png'),
                                                                                                                                              (7, 'abdsamad', 'bensoda', 7234643, 'Fdele', 'abdsamad123', 'abdsamad@gmail.com','Homme', '../assets/images/user/user.png'),
                                                                                                                                              (8, 'omar', 'zouara', 6232442, 'Fdele', 'omar123', 'omar@gmail.com','Homme', '../assets/images/user/user.png');
#-----------------------------------------------------------------------------------------------------------------------
#                                            table personel
#-----------------------------------------------------------------------------------------------------------------------
drop table if exists personel;
CREATE TABLE `personel` (
                            `id_personel` int(11) primary key auto_increment,
                            `nom` varchar(150) DEFAULT NULL,
                            `role` varchar(200) DEFAULT NULL,
                            `password` varchar(200) DEFAULT NULL,
                            `email` varchar(100) DEFAULT NULL,
                            `tel` varchar(13) ,
                            `adress` varchar(300),
                            `about` varchar(5000),
                            `profil_personel` varchar(1000) NOT NULL DEFAULT '../assets/images/dashboard/1.png'
);
INSERT INTO `personel` VALUES
                           (1, 'pr1', 'rol1', 'log1', 'omar@gmail.com','0609957023','adress dyalk','ta3rif bsit 3lik', '../assets/images/dashboard/1.png'),
                           (2, 'pr3', 'rol3', 'log3', 'abdo@gmail.com','0609957023','adress dyalk','ta3rif bsit 3lik', '../assets/images/dashboard/1.png'),
                           (3, 'pr2', 'rol2', 'log2', 'ayoub@gmail.com','0609957023','adress dyalk','ta3rif bsit 3lik', '../assets/images/dashboard/1.png'),
                           (4, 'alami', 'modificateur', 'alami123','alamo@gmail.com','0609957023','adress dyalk','ta3rif bsit 3lik',  '../assets/images/dashboard/1.png'),
                           (5, 'zineb', 'reparateur', 'zineb123', 'zineb@gmail.com','0609957023' ,'adress dyalk','ta3rif bsit 3lik', '../assets/images/dashboard/1.png');
#-----------------------------------------------------------------------------------------------------------------------
#                                            table produit
#-----------------------------------------------------------------------------------------------------------------------
drop table if exists produit;
CREATE TABLE `produit` (
                           `id_produit` int(11) primary key auto_increment,
                           `id_personel` int(11) not null,
                           `nom_produit` varchar(200) not null ,
                           `prix_produit` float not null,
                           `description_produit` varchar(250),
                           `details_produit` varchar(3000),
                           `categorie` varchar(20),
                           `qte_stock` int(11) not null ,
                           constraint produit_personne foreign key (id_personel) references personel(id_personel)
);
#-----------------------------------------------------------------------------------------------------------------------
#                                            table panier
#-----------------------------------------------------------------------------------------------------------------------
drop table if exists pannier;
create table pannier(id_Pannier int primary key auto_increment,
                     id_client int ,
                     constraint pannier_client foreign key (id_client) references client(id_client)
);
#-----------------------------------------------------------------------------------------------------------------------
#                                            table shop
#-----------------------------------------------------------------------------------------------------------------------
drop table if exists shop;
CREATE TABLE `shop` (
                        `id_Pannier` int,
                        `id_produit` int,primary key(id_Pannier,id_produit),
                        `qte_produit` int DEFAULT 1,
                        constraint shop_pannier foreign key (id_Pannier) references pannier(id_Pannier),
                        constraint shop_produit foreign key (id_produit) references produit(id_produit)
);
#-----------------------------------------------------------------------------------------------------------------------
#                                            table command
#-----------------------------------------------------------------------------------------------------------------------
drop table if exists command;
CREATE TABLE `command` (
                           `id_command` int(11) primary key auto_increment,
                           `date_command` date DEFAULT current_timestamp(),
                           `valid` bool NOT NULL DEFAULT false,
                           constraint command_panier foreign key (id_command) references pannier(id_Pannier)
) ;
#-----------------------------------------------------------------------------------------------------------------------
#                                            table comantaire
#-----------------------------------------------------------------------------------------------------------------------
drop table if exists commantaire;
CREATE TABLE `commantaire` (
                               `id_comantaire` int(11) primary key auto_increment,
                               `desctreption` varchar(250) DEFAULT NULL,
                               `date_comante` date DEFAULT current_timestamp(),
                               `id_command` int(11),
                               reponse int(1) default 0,
                               `vu` tinyint(1) NOT NULL DEFAULT 0,
                               constraint commantaire_idCommand foreign key (id_command) references command(id_command)
);
#-----------------------------------------------------------------------------------------------------------------------
#                                               table images
#-----------------------------------------------------------------------------------------------------------------------
drop table if exists images;
CREATE TABLE `images` (
                          `id_image` int(11) primary key auto_increment,
                          `src_image1` varchar(3558) DEFAULT NULL,
                          `src_image2` varchar(3558) DEFAULT NULL,
                          constraint image_produit foreign key (id_image) references produit(id_produit)
);
#-----------------------------------------------------------------------------------------------------------------------
#                                                   trigger  stock_comand
#-----------------------------------------------------------------------------------------------------------------------
drop trigger if exists stock_comand;
delimiter $$
create trigger stock_comand before insert on command for each row
begin
    declare id_prod int;declare qnt int;declare fin bool default true;
    declare cursor_qnt cursor for(select id_produit,qte_produit from shop where id_Pannier=NEW.id_command);
    declare exit handler for not found set fin=false;
    open cursor_qnt;
    while fin do
            fetch cursor_qnt into id_prod,qnt;
            if exists(select * from produit where id_produit=id_prod and qte_stock>=qnt) then
                update produit set qte_stock=(qte_stock-qnt) where id_produit=id_prod;
            else
                signal sqlstate 'HY000' set message_text ='stock makaynch';
            end if;
        end while;
    close cursor_qnt;
end $$
delimiter ;

#-----------------------------------------------------------------------------------------------------------------------
#                                                   trigger  stock_del_comand
#-----------------------------------------------------------------------------------------------------------------------
drop trigger if exists stock_del_comand;
delimiter $$
create trigger stock_del_comand before delete on command for each row
begin
    declare id_prod int;declare qnt int;declare fin bool default true;
    declare cursor_qnt_del cursor for(select id_produit,qte_produit from shop where id_Pannier=OLD.id_command);
    declare exit handler for not found set fin=false;
    open cursor_qnt_del;
    while fin do
            fetch cursor_qnt_del into id_prod,qnt;
            if exists(select * from produit where id_produit=id_prod)and OLD.valid=0 then
                update produit set qte_stock=(qte_stock+qnt) where id_produit=id_prod;
            end if;
        end while;
    close cursor_qnt_del;
end $$
delimiter ;
#-----------------------------------------------------------------------------------------------------------------------
#                                                   trigger  deletePannier
#-----------------------------------------------------------------------------------------------------------------------
drop trigger if exists deletePannier;
delimiter $$
create trigger deletePannier before delete on pannier for each row
begin
    delete from commantaire where id_command=OLD.id_Pannier;
    delete from command where id_command=OLD.id_Pannier;
    delete from shop where shop.id_Pannier=OLD.id_Pannier;
end $$
delimiter ;
drop trigger if exists deletePannier;
delimiter $$
#-----------------------------------------------------------------------------------------------------------------------
#                                                   trigger  vu comment
#-----------------------------------------------------------------------------------------------------------------------


