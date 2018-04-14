![](https://avatars0.githubusercontent.com/u/4995607?v=3&s=100)
<<<<<<< HEAD
php -S 127.0.0.1 `-t public`

Mums Pakeliui !!!
=======

NFQ Akademija
>>>>>>> 849e895edaa0aa44bb175419cbb7e10ef84bde59
============

# Intro

Sveiki! Tai yra Jūsų startinis projekto "template". 
Šioje repositorijoje rasite Symfony `4.0.6` minimalų projekto paketą su jau paruoštais 
visais reikalingais failais ir įrankiais darbui:
 
- Lokalaus development'o aplinka (docker) (PHP 7.2, MySql DB, Nginx)
- Pradinis bundle (AppBundle) kartu su stiliaus failais.
- Įdiegtas bootstrap
- Asset'ų buildinimas (npm, yarn, sass)
- Travis CI template


# Paleidimo instrukcija

Metai iš metų studentai maldavo jog galėtų dirbti su Windows'ais akademijos metu.
 Bet nepaisant nieko, tolerancijos ir palaikymo Windows operacinei niekada nebuvo ir nebus.  

> Perspėjimas: Itin kieti profesionalai nenaudoja niekam tikusių operacinių sistemų. 

### Reikės dokerio

Naudosime naujausią dokerio versiją, kuri įgalina virtualizaciją be Virtualbox ar Vmware.
 Tam reikės, kad jūsų kompiuterio procesorius palaikytų [Hypervisor](https://en.wikipedia.org/wiki/Hypervisor).
 Nėra dėl ko nerimauti, dabartiniai kompiuteriai kone visi turi šį palaikymą.

<<<<<<< HEAD
Parsisiunčiate ir įsidiegiate įrankį iš [čia](https://docs.docker.com/install/linux/docker-ce/ubuntu/). Iškart įdiegus reikia pasidaryti, kad `docker` būtų galima naudoti be root teisių, kaip tai padaryti rasite [čia](https://docs.docker.com/compose/install/).
=======
Parsisiunčiate ir įsidiegiate įrankį iš [čia](https://docs.docker.com/engine/installation/linux/ubuntu/). Iškart įdiegus reikia pasidaryti, kad `docker` būtų galima naudoti be root teisių, kaip tai padaryti rasite [čia](https://docs.docker.com/engine/installation/linux/linux-postinstall/).
>>>>>>> 849e895edaa0aa44bb175419cbb7e10ef84bde59

Parsisiunčiate ir įsidiegiate `docker-compose` iš [čia](https://github.com/docker/compose/releases).

Taip pat reikia įsidiegti [Kitematic](https://github.com/docker/kitematic/releases).
 Šis įrankis padės geriau organizuoti dokerio konteinerius. 

#### Versijų reikalavimai
<<<<<<< HEAD
* docker: `18.x-ce`
* docker-compose: `1.20.1`


### Projekto paleidimas (projekto kūrimui lokaliai)
Parsisiunčiate šią repositoriją. Taip taip, viršuje kairėje rasite žalią mygtuką ant kurio parašyta "Download", tada pasirenkate zip failo parsisiuntimą.
 
> Akademijos projektui nereikia forkinti, klonuoti ar dar išrasti kokių nors kitų veiksmų, tik parsisiųsti.
 
Extractinat turinį į savo mėgstamą projektų direktoriją.

Einate į šią direktoriją su terminalu. Paprastai bus komanda `cd <path>`.

* Susikuriate projekto viduje `.env` failą. Failą užpildote turiniu pateiktu iš `env.dist`:
  ```
  cp .env.dist .env
  ```

* Pasiruoškite infrastruktūrą:
  ```
  docker-compose up -d
  ```
  
#### Pasruošiame frontend aplinką

* JavaScript/CSS įrankiams (**atsidaryti atskirame lange**)
```
docker-compose run --rm frontend.symfony
```
  * Pirmą kartą (įsirašome JavaScript bilbiotekas)
  ```
  npm install --no-save
  ```
  * Jei pakeitimai neatsinaujina (arba klaidos dėl `build/css` ar `build/js`):
=======
* docker: `1.13.1`
* docker-compose: `1.7.1`


### Projekto paleidimas (projekto kūrimui lokaliai)

* Pasiruoškite infrastruktūrą:
  * Pasikeičiame slaptažodžius:
    `.docker` kataloge žr. failų su `APP_SECRET` ir `DATABASE_URL` reikšmėmis
  * Pasileidžiame:
  ```
  sudo su -c 'echo "127.0.0.1 symfony.local" >> /etc/hosts'
  docker build .docker/php -t php.symfony 
  docker build .docker/frontend/ -t frontend.symfony
  docker-compose -f .docker/docker-compose.yml up -d
  ```

* JavaScript/CSS įrankiams (atsidaryti atskirame lange)
```
docker-compose run frontend.symfony
```
  * Pirmą kartą (įsirašome JavaScript bilbiotekas)
  ```
  npm install
  ```
  * Jei pakeitimai neatsinaujina:
>>>>>>> 849e895edaa0aa44bb175419cbb7e10ef84bde59
  ```
  yarn run encore dev --watch
  ```

<<<<<<< HEAD
#### Pasruošiame backend aplinką


* PHP įrankiams (**atsidaryti atskirame lange**)
=======
* PHP įrankiams (atsidaryti atskirame lange)
>>>>>>> 849e895edaa0aa44bb175419cbb7e10ef84bde59
```
docker exec -it php.symfony bash
```
  * Pirmą kartą paleidus (įsirašome PHP biliotekas):
  ```
  composer install
  ```
  * Jei pakeitimai neatsinaujina:
  ```
<<<<<<< HEAD
  bin/console cache:clear
  bin/console assets:install
  ```

#### Pasižiūrime rezultatą

Atsidarome naršyklėje [127.0.0.1:8000](http://127.0.0.1:8000)

Jei nematote užrašo "NFQ Akademija", reiškia, kažkur susimovėte,
 tokiu atveju viską ištrinat ir kartojate iš naujo tol kol gausis.
 Kai prarasite visiškai viltį, kreipkitės į [Google](http://lmgtfy.com/?q=docker+is+not+working), o po to į mentorių.

=======
  ./bin/console --env=dev cache:clear
  ./bin/console --env=dev cache:warmup
  ./bin/console --env=dev assets:install
  ```

* Pasižiūrime rezultatą.
Atsidarome naršyklėje [symfony.local](http://symfony.local)
>>>>>>> 849e895edaa0aa44bb175419cbb7e10ef84bde59


### Projekto paleidimas (palyginimui kaip atrodytų produkcinėje)

<<<<<<< HEAD
* Pasiruoškite infrastruktūrą (jei prieš tai leidote šią komandą, jos kartoti nereikia):
  ```
  docker-compose up -d
  ```

#### Pasruošiame frontend aplinką

* JavaScript/CSS įrankiams (atsidaryti atskirame lange)
```
docker-compose run --rm frontend.symfony
```
  * Pirmą kartą (įsirašome JavaScript bilbiotekas)
  ```
  npm install --no-save
  ```
  * Jei pakeitimai neatsinaujina (**skirasi nuo dev aplinkos**):
  ```
  yarn run encore production
  ```
  
#### Pasruošiame backend aplinką

* PHP įrankiams (**atsidaryti atskirame lange, skiriasi nuo dev aplinkos**)
```
docker exec -it prod.php.symfony bash
=======
* Pasiruoškite infrastruktūrą:
  * Pasikeičiame slaptažodžius:
    `.docker` kataloge žr. failų su `APP_SECRET` ir `DATABASE_URL` reikšmėmis
  * Pasileidžiame:
  ```
  sudo su -c 'echo "127.0.0.1 symfony.prod" >> /etc/hosts'
  docker build .docker/php -t php.symfony 
  docker build .docker/frontend/ -t frontend.symfony
  docker-compose -f .docker/docker-compose.yml up -d
  ```

* JavaScript/CSS įrankiams (atsidaryti atskirame lange)
```
docker-compose run frontend.symfony
```
  * Pirmą kartą (įsirašome JavaScript bilbiotekas)
  ```
  npm install
  ```
  * Jei pakeitimai neatsinaujina:
  ```
  yarn run encore encore production
  ```

* PHP įrankiams (atsidaryti atskirame lange)
```
docker exec -it php.symfony bash
>>>>>>> 849e895edaa0aa44bb175419cbb7e10ef84bde59
```
  * Pirmą kartą paleidus (įsirašome PHP biliotekas):
  ```
  composer install
  ```
<<<<<<< HEAD
  * Jei pakeitimai neatsinaujina (**skiriasi nuo dev aplinkos**):
  ```
  bin/console cache:clear
  bin/console assets:install
  ```

#### Pasižiūrime rezultatą

Atsidarome naršyklėje [127.0.0.1:8888](http://127.0.0.1:8888)

P.S. šalia galima atsidaryti ir palyginti su `127.0.0.1:8000`
=======
  * Jei pakeitimai neatsinaujina:
  ```
  ./bin/console --env=prod cache:clear
  ./bin/console --env=prod cache:warmup
  ./bin/console --env=prod assets:install
  ```

* Pasižiūrime rezultatą.
Atsidarome naršyklėje [symfony.prod](http://symfony.prod)

P.S. šalia galima atsidaryti ir palyginti su `symfony.local`
>>>>>>> 849e895edaa0aa44bb175419cbb7e10ef84bde59


### Kaip teisingai išjungti docker konteinerius?

Išjungiama su komanda:
```
docker-compose kill
```

Galima išjungti ir po vieną:
```
docker-compose kill <container name>
```

<<<<<<< HEAD
### Kaip prisijungti prie MySql duomenų bazės?

```
mysql -uroot -h127.0.0.1 --port=3307 -p
```
Slaptažodžiui naudoti `p9iijKcfgENjBWDYgSH7`


### Kaip pasiruošti produkcinei aplinkai?

* Pasikeiskite slaptažodžius: ieškokite failuose reikšmių prie `DATABASE_URL=` ir `APP_SECRET=` 
* Pakeiskite parametrus `nginx`/`apache` serveryje. Žr. pavyzdį [site.conf](.docker/nginx/site.conf)
* Įsitikinkite, kad reikalingos bibliotekos įrašytos į operacinę sistemą. Žr. pavyzdį [php/Dockerfile](.docker/php/Dockerfile)
* Įsitikinkite, kad `APP_ENV` yra `prod` (tiek naudojant `bin/console`, tiek ateinantis per `nginx` į `index.php`) 

=======

### Kaip pamatyti kas atsitiko?

Atsidarote naršyklę ir einate į `http://127.0.0.1:8000`,
 jei nematote užrašo "NFQ Akademija", reiškia, kažkur susimovėte,
 tokiu atveju viską ištrinat ir kartojate iš naujo tol kol gausis.
 Kai prarasite visiškai viltį, kreipkitės į [Google](http://lmgtfy.com/?q=docker+is+not+working), o po to į mentorių.  
>>>>>>> 849e895edaa0aa44bb175419cbb7e10ef84bde59

### Troubleshooting'as

Jeigu kažkas nutiko ne taip, na, atsirado raudona eilutė, ar tiesiog nutrūko ir nieko nerodo, neatsidaro naršyklėje svetainė, tai pirmas žingsnis būtų paleisti komandą:

```
<<<<<<< HEAD
docker-compose logs 
```

Nepamirškite, kad galima nurodyti norimą procesą ar filtruoti eilutes:

```
docker-compose logs mysql.symfony | grep Warning
```

Jei kažką su infrastrutkūrą žiauriai sugadinote, perkurti nuo nulio galima:
```
docker rm -f $(docker ps -aq)
docker rmi -f kickstartmaster_frontend.symfony
docker rmi -f kickstartmaster_prod.php.symfony
docker rmi -f kickstartmaster_php.symfony
=======
docker-compose logs
```

Nepamirškite, kad galima nurodyti norimą procesą. Taip pat ir 'grepinti'.

```
docker-compose logs mariadb
>>>>>>> 849e895edaa0aa44bb175419cbb7e10ef84bde59
```

### Feedbackas

Jeigu taip nutiktų, kad repositorijoje, projekto template ar instrukcijoje rastumėte klaidą, tai nesišnibždėkite vieni tarp kitų, o sukurkite "issue". 
O jei atidarysite "pull requestą" su fixu, gausite iškart 1000 karmos taškų.
