![Mums pakeliui](https://github.com/nfqakademija/mums-pakeliui/blob/sprint4/public/images/logo-or.png)

Mums pakeliui
============

## Turinys

* [Apie projektą](#project-description)
* [Reikalavimai](#requirements)
* [Projekto paleidimas](#how-to-run)
* [Komanda](#team-members)

## <a name="project-description"></a>Apie projektą

Sveiki!

 Mėgstate keliauti? 
 Mūsų svetainėje vairuotojai ir keleiviai lengvai randa vieni kitus.

 Rasite mėgstančių keliauti su gyvūnais, todėl nereikės skirtis su augintiniu.

 Nepakenčiate cigarečių dūmų, o gal mėgaujatės rūkymo pertraukėlėmis? Padėsime rasti bendraminčių ir keliauti be rūpesčių.

## <a name="requirements"></a>Reikalavimai
 * docker: `18.x-ce`
 * docker-compose: `1.20.1`


## <a name="how-to-run"></a>Projekto paleidimas
 1. Atsisiųskite šią repositoriją.
 2. Išskleiskite turinį į norimame projektų kataloge.
 3. Pereikite į tą katalogą naudodami terminalą.
 4. Terminale atsidarykite (**atskirus langus frontend ir backend aplinkoms**) ir įvykdykite šias komandas:

    ```
    docker-compose up -d
    ```
  
#### Frontend aplinka
* Pirmą kartą:
  ```
  npm install --no-save
  ```

* Pirmą ir kitus kartus:
  ```
  docker-compose run --rm frontend.symfony
  ```
  
* Jei pakeitimai neatsinaujina arba yra klaidų:
  ```
  //Development aplinka
  yarn run encore dev --watch

  //Production aplinka
  yarn run encore production
  
  ```

#### Backend aplinka
* Pirmą kartą:
  ```
  composer install
  ```
* Pirmą ir kitus kartus:
  ```
  //Development aplinka
  docker exec -it php.symfony bash

  //Production aplinka
  docker exec -it prod.php.symfony bash
  ```
* Jei pakeitimai neatsinaujina:
  ```
  bin/console cache:clear
  bin/console assets:install
  ```

#### Svetainės URL

* Numatytasis (veikia tik prisijungimas svetainėje) [127.0.0.1:8000](http://127.0.0.1:8000)
* SSL (veikia prisijungimas per soc. tinklus) [https://localhost:44300](https://localhost:44300)
* Live versija (veikia tik prisijungimas svetainėje) http://mumspakeliui.projektai.nfqakademija.lt/


#### MySql duomenų bazė

   ```
   mysql -uroot -h127.0.0.1 --port=3307 -p
   ```
 Slaptažodžiui naudoti `p9iijKcfgENjBWDYgSH7`

## <a name="team-members"></a>Komanda

#### Mentorius:

* Paulius Jarmalavičius

#### Programuotojos:

* Eglė Burneikė
* Svetlana Mur
