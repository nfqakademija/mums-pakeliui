<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Trip;

class MumsPakeliuiFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $names = ['Matas', 'Lukas', 'Dominykas', 'Jokūbas', 'Kajus', 'Jonas', 'Nojus', 'Domas', 'Benas', 'Joris',
            'Emilija', 'Kamilė', 'Sofija', 'Lėja', 'Amelija', 'Gabija', 'Austėja', 'Ema', 'Viltė', 'Liepa',
            'Darius', 'Mantas', 'Tomas', 'Karolis', 'Rokas', 'Paulius', 'Deividas', 'Marius', 'Martynas', 'Dovydas',
            'Gabrielė', 'Karolina', 'Greta', 'Giedrė', 'Viktorija', 'Ieva', 'Monika', 'Nijolė', 'Evelina', 'Laura',
            'Ignas', 'Arnas', 'Justas', 'Danielius', 'Emilis', 'Augustas', 'Domantas', 'Gabrielius', 'Kristupas', 'Gustas',
            'Ugnė', 'Urtė', 'Vilma', 'Rugilė', 'Miglė', 'Goda', 'Augustė', 'Deimantė', 'Saulė', 'Paulina',
            'Titas', 'Edvinas', 'Laurynas', 'Eimantas', 'Adomas', 'Vilius', 'Armandas', 'Erikas', 'Pijus', 'Tadas',
            'Aistė', 'Kotryna', 'Karina', 'Gustė', 'Agnė', 'Smiltė', 'Akvilė', 'Patricija', 'Eva', 'Rusnė',
            'Nedas', 'Ernestas', 'Ugnius', 'Nikita', 'Simonas', 'Gytis', 'Viktoras', 'Aivaras', 'Eligijus', 'Nerijus',
            'Marija', 'Samanta', 'Erika', 'Eglė', 'Simona', 'Kornelija', 'Milda', 'Gintarė', 'Svetlana', 'Tamara'];
        $c = 0;
        $tt = 0;
        $day = 2018-07-01;
        $seat = 1;
        $pets = 0;
        $smoke = 0;

        $cityFromTo1 = ['Vilnius', 'Kaunas',
            'Vilnius', 'Palanga',
            'Vilnius', 'Zarasai',
            'Klaipėda', 'Šiauliai',
            'Zapyškis', 'Baisiogala',
            'Vilnius', 'Kaunas',
            'Vilnius', 'Palanga',
            'Vilnius', 'Zarasai',
            'Klaipėda', 'Šiauliai',
            'Zapyškis', 'Baisiogala',
            'Vilnius', 'Kaunas',
            'Vilnius', 'Palanga',
            'Vilnius', 'Zarasai',
            'Klaipėda', 'Šiauliai',
            'Zapyškis', 'Baisiogala',
            'Vilnius', 'Kaunas',
            'Vilnius', 'Palanga',
            'Vilnius', 'Zarasai',
            'Klaipėda', 'Šiauliai',
            'Zapyškis', 'Baisiogala',
            'Vilnius', 'Kaunas',
            'Vilnius', 'Palanga',
            'Vilnius', 'Zarasai',
            'Klaipėda', 'Šiauliai',
            'Zapyškis', 'Baisiogala',

            'Klaipėda', 'Kaunas',
            'Klaipėda', 'Palanga',
            'Klaipėda', 'Zarasai',
            'Vilnius', 'Šiauliai',
            'Kaunas', 'Baisiogala',
            'Klaipėda', 'Kaunas',
            'Klaipėda', 'Palanga',
            'Klaipėda', 'Zarasai',
            'Vilnius', 'Šiauliai',
            'Kaunas', 'Baisiogala',
            'Klaipėda', 'Kaunas',
            'Klaipėda', 'Palanga',
            'Klaipėda', 'Zarasai',
            'Vilnius', 'Šiauliai',
            'Kaunas', 'Baisiogala',
            'Klaipėda', 'Kaunas',
            'Klaipėda', 'Palanga',
            'Klaipėda', 'Zarasai',
            'Vilnius', 'Šiauliai',
            'Kaunas', 'Baisiogala',
            'Klaipėda', 'Kaunas',
            'Klaipėda', 'Palanga',
            'Klaipėda', 'Zarasai',
            'Vilnius', 'Šiauliai',
            'Kaunas', 'Baisiogala',

            'Baisiogala', 'Kaunas',
            'Baisiogala', 'Palanga',
            'Klaipėda', 'Zarasai',
            'Baisiogala', 'Šiauliai',
            'Vilnius', 'Baisiogala',
            'Baisiogala', 'Kaunas',
            'Baisiogala', 'Palanga',
            'Klaipėda', 'Zarasai',
            'Baisiogala', 'Šiauliai',
            'Vilnius', 'Baisiogala',
            'Baisiogala', 'Kaunas',
            'Baisiogala', 'Palanga',
            'Klaipėda', 'Zarasai',
            'Baisiogala', 'Šiauliai',
            'Vilnius', 'Baisiogala',
            'Baisiogala', 'Kaunas',
            'Baisiogala', 'Palanga',
            'Klaipėda', 'Zarasai',
            'Baisiogala', 'Šiauliai',
            'Vilnius', 'Baisiogala',
            'Baisiogala', 'Kaunas',
            'Baisiogala', 'Palanga',
            'Klaipėda', 'Zarasai',
            'Baisiogala', 'Šiauliai',
            'Vilnius', 'Baisiogala',

            'Palanga', 'Kaunas',
            'Mažeikiai', 'Palanga',
            'Palanga', 'Zarasai',
            'Pasvalys', 'Šiauliai',
            'Vilnius', 'Trakai',
            'Palanga', 'Kaunas',
            'Mažeikiai', 'Palanga',
            'Palanga', 'Zarasai',
            'Pasvalys', 'Šiauliai',
            'Vilnius', 'Trakai',
            'Palanga', 'Kaunas',
            'Mažeikiai', 'Palanga',
            'Palanga', 'Zarasai',
            'Pasvalys', 'Šiauliai',
            'Vilnius', 'Trakai',
            'Palanga', 'Kaunas',
            'Mažeikiai', 'Palanga',
            'Palanga', 'Zarasai',
            'Pasvalys', 'Šiauliai',
            'Vilnius', 'Trakai',
            'Palanga', 'Kaunas',
            'Mažeikiai', 'Palanga',
            'Palanga', 'Zarasai',
            'Pasvalys', 'Šiauliai',
            'Vilnius', 'Trakai',

            'Garliava', 'Kaunas',
            'Mažeikiai', 'Biržai',
            'Palanga', 'Alytus',
            'Alytus', 'Šiauliai',
            'Kaunas', 'Trakai',
            'Garliava', 'Kaunas',
            'Mažeikiai', 'Biržai',
            'Palanga', 'Alytus',
            'Alytus', 'Šiauliai',
            'Kaunas', 'Trakai',
            'Garliava', 'Kaunas',
            'Mažeikiai', 'Biržai',
            'Palanga', 'Alytus',
            'Alytus', 'Šiauliai',
            'Kaunas', 'Trakai',
            'Garliava', 'Kaunas',
            'Mažeikiai', 'Biržai',
            'Palanga', 'Alytus',
            'Alytus', 'Šiauliai',
            'Kaunas', 'Trakai',
            'Garliava', 'Kaunas',
            'Mažeikiai', 'Biržai',
            'Palanga', 'Alytus',
            'Alytus', 'Šiauliai',
            'Kaunas', 'Trakai'
        ];
        $location = $cityFromTo1;
        for ($i = 1; $i <= 100; $i++) {
            $user = new User();
            $user->setUsername($names[$i - 1]);
            $user->setEmail(strtolower($names[$i - 1]) . '@mail.com');
            $user->setPassword('baravykas' . $i);
            $user->setEnabled(true);
            $manager->persist($user);
            //$manager->flush();
//        }
//
//
//        for ($i = 1; $i <= 100; $i++) {
            $trip = new Trip();
            //$user = MumsPakeliuiFixtures.getUser($i);
            $trip->setUser($user);
            $trip->setTravelerType($tt);

            $trip->setDepartFrom($location[$c]);
            $c++;
            $trip->setDestination($location[$c]);
            $c++;
//            if ($c == 19) {
//                $c = 0;
//            }
            $trip->setDepartTime($day);
            if ($i == 5 || $i == 25 || $i == 45 || $i == 65 || $i == 85) {
                $tt = 1;
            }
            if ($i == 20 || $i == 40 || $i == 60 || $i == 80) {
                $tt = 0;
                if ($i == 20) {
                    $day = 2018-07-02;
                }
                if ($i == 40) {
                    $day = 2018-07-03;
                }
                if ($i == 60) {
                    $day = 2018-07-04;
                }
                if ($i == 80) {
                    $day = 2018-07-05;
                }
            }
            $trip->setSeats($seat);
            if ($i == 20 || $i == 40 || $i == 60 || $i == 80) {
                $seat++;
            }
            $trip->setPets($pets);
            $trip->setSmoke($smoke);
            if ($i == 5 || $i == 15 || $i == 25 || $i == 35 || $i == 45 || $i == 55 || $i == 65 || $i == 75 || $i == 85 || $i == 95) {
                $pets = 1;
                $smoke = 1;
            }
            if ($i == 10 || $i == 20 || $i == 30 || $i == 40 || $i == 50 || $i == 60 || $i == 70 || $i == 80 || $i == 90) {
                $pets = 0;
                $smoke = 0;
            }
            $manager->persist($trip);
        }
        $manager->flush();
    }
}
