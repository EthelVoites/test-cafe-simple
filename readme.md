# Kirjeldus

Meil on kohvik, kus inimesed saavad osta endale meelepärase joogi. Et motiveerida inimesi kohvikusse tihedamini sisse astuma, tahame juurutada uut boonussüsteemi. Klient saab oma tegevuste eest meie kohvikus/saidil punkte ja saab vastavalt oma eelmise kuu tegevustele selleks kuuks mingi taseme, mis võiks siis näiteks soodustusi pakkuda vmt. Antud hetkel on nendeks tegevusteks ainult ostud, aga kaalume ka sisselogimiste või siis näiteks kuu aja pärast lisanduva raamatulaenutusklubi tegevuses osalemise eest punkte anda.

## Ülesanne

Tuleb luua punktisüsteem:
* juba olemas olevad eelmiste kuude tegevused peavad punktideks muutuma
    * praegu anname punkte ainult ostude eest, näiteks nii
      * 1 ost = 1 punkt
      * iga 5. punkt tõstab kliendi taset 1 võrra
* iga kuu peab kasutajal olema õige tase vastavalt tema eelmise kuu punktidele
* punktisüsteem peaks olema iseseisev moodul
    * olemasolevat koodi võimalikult vähe muuta 
    * uute punkte lisavate tegevuste lisamine peab olema lihtne
    * kasutata võib ja on soovitav Laraveli võimalusi ja tavasid, et seda eristatust saavutada
    
* kohvikuomanikule eraldi vaade, kust 
   * ta saaks näha klientide praeguseid punktisummasid, hetkel kehtivat taset
   * klientidele punkte käsitsi juurde lisada. 
   * turvamise ja õiguste pärast pole hetkel vaja muretseda
* kliendile võimalus näha oma hetke taset

* dokumentatsiooni/kommentaare/seletusi hinnatakse kõrgelt :)

## Kohviku töölepanemise instruktsioonid

1. git clone 
2. kopeeri .env.example fail ja nimeta .env-iks
3. jooksuta käske
```
 composer install
 composer dump-autoload
 php artisan key:generate
 ``` 
4. localhostis näitamiseks näiteks:
 ```
 php artisan serve
 ```
5. kui on vaja andmebaasi uuesti luua, siis
```
 php artisan migrate:refresh
 php artisan db:seed
 ```