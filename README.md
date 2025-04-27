Projekts: PHP Forums ar Admin Paneli
Palaist tīmekļa lietotni
Lai palaistu tīmekļa lietotni, atver konsoli projekta mapē un izpildi:

docker-compose up -d
Datu bāzes pārvaldība
Datu bāzes eksportēšana
Lai eksportētu pašreizējo datu bāzes stāvokli:

docker exec -it src-db-1 mysqldump -uuser -ppassword forum > forum_db.sql
Ja datu bāze ir bojāta, veic šos soļus, lai to atiestatītu:
Datu bāzes dzēšana
docker exec -it src-db-1 mysql -uuser -ppassword -e "DROP DATABASE forum"
'forum' datu bāzes izveide
Pieslēgties MySQL serverim:

docker exec -it src-db-1 mysql -uuser -ppassword
Izveidot 'forum' datu bāzi:

CREATE DATABASE forum;
Iziet no MySQL servera:

exit
Izpildīt Windows vidē SQL komandas no forum_db.sql faila:

Get-Content C:/www/PHP_FORUM/src/database-storage/forum_db.sql | docker exec -i src-db-1 mysql -uuser -ppassword forum
Izpildīt Linux vidē SQL komandas no forum_db.sql faila:

cat ../php_forum/src/database-storage/forum_db.sql | docker exec -i src-db-1 mysql -uuser -ppassword forum
Šī komanda nolasīs forum_db.sql faila saturu un pārsūtīs to uz MySQL serveri Docker konteinerī.

PHP ar MySQL: Forums ar administrācijas paneli
Šis projekts demonstrē dinamisku foruma platformu ar jaudīgu administrācijas paneli, izmantojot PHP, MySQL, Bootstrap un PDO.

Projekta pārskats
Autentifikācijas sistēma: Droša un lietotājam draudzīga pieteikšanās.

Paroles drošība: Droša paroles šifrēšana un atšifrēšana.

Efektīva datu bāzes mijiedarbība: PDO izmantošana drošai piekļuvei datiem.

Plaša tēmu pārvaldība: Elastīga tēmu izveide un administrēšana.

Interaktīvas atbildes: Sistēma atbilžu pievienošanai, rediģēšanai un dzēšanai.

Strukturēta kategoriju organizācija: Efektīva tēmu klasifikācija.

Tīmekļa izstrādes labā prakse: Efektīvas programmēšanas ieteikumi.

Jaudīgs administrācijas panelis: Rīki ērtai foruma pārvaldībai.

Datu validācija: Labas metodes drošībai un datu integritātei.

Lietotāju profilu personalizācija: Uzlabota lietotāju iesaiste un pielāgojamība.

Izmantotās tehnoloģijas
PHP (Hypertext Preprocessor): Aizmugures funkcionalitāte, ieskaitot autentifikāciju un datu apstrādi.

MySQL: Relāciju datu bāzes pārvaldība lietotājiem, tēmām, atbildēm un kategorijām.

Bootstrap: Front-end ietvars responsīvam un pievilcīgam dizainam.

PDO (PHP Data Objects): Droša un efektīva komunikācija ar datu bāzi.
