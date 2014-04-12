navideo
=======

Configuration serveur requise:

Ubuntu 12.04 LTS
Apache/2.4.6
PHP 5.5.3
PostgreSQL 9.1
ffmpeg version 0.10.11-7:0.10.11-1~saucy1

Les fichiers de configuration nécessaires (php.ini et apache.conf) sont dans le dossier /etc/, et un fichier de restauration de base de données (database.backup) est fourni.

Le compte serveur doit posséder les droits d'écritures sur modules/jQuery-File-Upload/server/php/files

Attention: PostgreSQL utilise la locale du systéme pour l'encodage par défaut (et c'est irréversible!). Cela ne pose pas de probléme si la langue du systéme est réglé sur français, mais dans les autres cas il y aura des incompatibilités avec les accents.
Pour changer l'encodage il faut donc réinitialiser PostgreSQL avec la locale française fr_FR.UTF8 via les commandes suivantes:
 dpkg-reconfigure locales
 
 /etc/init.d/postgresql stop
 
 rm -rf /var/lib/postgresql/9.1/
 
 rm -rf /etc/postgresql/9.1/
 
 LANG=fr_FR.UTF8 pg_createcluster 9.1 main
 
 /etc/init.d/postgresql start

Pour valider ces opérations, on vérifiera notamment qu'un select upper('é') renvoie bien une majuscule accentuée.

Le site peut ensuite être déployé en copiant le contenu du trunk dans votre répértoire de sites apache.
