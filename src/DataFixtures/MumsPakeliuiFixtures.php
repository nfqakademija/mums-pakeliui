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
        $names=['Matas','Lukas','Dominykas','Jokūbas','Kajus','Jonas','Nojus','Domas','Benas','Joris',
            'Emilija','Kamilė','Sofija','Lėja','Amelija','Gabija','Austėja','Ema','Viltė','Liepa',
            'Darius','Mantas','Tomas','Karolis','Rokas','Paulius','Deividas','Marius','Martynas','Dovydas',
    'Gabrielė','Karolina','Greta','Giedrė','Viktorija','Ieva','Monika','Nijolė','Evelina','Laura',
    'Ignas','Arnas','Justas','Danielius','Emilis','Augustas','Domantas','Gabrielius','Kristupas','Gustas',
    'Ugnė','Urtė','Viltė','Rugilė','Miglė','Goda','Augustė','Deimantė','Saulė','Paulina',
            'Titas','Edvinas','Laurynas','Eimantas','Adomas','Vilius','Armandas','Erikas','Pijus','Tadas',
    'Aistė','Kotryna','Karina','Gustė','Agnė','Smiltė','Akvilė','Patricija','Eva','Rusnė',
            'Nedas','Ernestas','Ugnius','Nikita','Simonas','Gytis','Viktoras','Aivaras','Eligijus','Nerijus',
    'Marija','Samanta','Erika','Eglė','Simona','Kornelija','Milda','Gintarė','Svetlana','Tamara'];

        for ($i = 1; $i <= 100; $i++) {
            $user = new User();
            $user->setUsername($names[$i-1]);
            $user->setEmail(strtolower($names[$i-1]).'@mail.com');
            $user->setPassword('baravykas'.$i);
            $user->setEnabled(true);
            $manager->persist($user);
        }
        $cityFromTo1=[
            ['Vilnius', 'Kaunas'],
            ['Vilnius', 'Palanga'],
            ['Vilnius', 'Zarasai'],
            ['Klaipėda', 'Šiauliai'],
            ['Zapyškis', 'Baisiogala']
        ];
        $cityFromTo2=[
            ['Klaipėda', 'Kaunas'],
            ['Klaipėda', 'Palanga'],
            ['Klaipėda', 'Zarasai'],
            ['Vilnius', 'Šiauliai'],
            ['Kaunas', 'Baisiogala']
        ];
        $cityFromTo3=[
            ['Baisiogala', 'Kaunas'],
            ['Baisiogala', 'Palanga'],
            ['Klaipėda', 'Zarasai'],
            ['Baisiogala', 'Šiauliai'],
            ['Vilnius', 'Baisiogala']
        ];
        $cityFromTo4=[
            ['Palanga', 'Kaunas'],
            ['Mažeikiai', 'Palanga'],
            ['Palanga', 'Zarasai'],
            ['Pasvalys', 'Šiauliai'],
            ['Vilnius', 'Trakai']
        ];
        $cityFromTo5=[
            ['Garliava', 'Kaunas'],
            ['Mažeikiai', 'Biržai'],
            ['Palanga', 'Alytus'],
            ['Alytus', 'Šiauliai'],
            ['Kaunas', 'Trakai']
        ];
        $c=0;
        $tt=0;
        $day=1;
        $seat=1;
        $pets=0;
        $smoke=0;
        for ($i = 1; $i <= 100; $i++) {
            $trip = new Trip();
            $trip->setUser($i);
            $trip->setTravelerType($tt);
            $location='$cityFromTo'.'$day';
            $trip->setDepartFrom($location[$c][0]);
            $trip->setDestination($location[$c][1]);
            $c++;
            if ($c==5) {
                $c=0;
            }
            $trip->setDepartTime('2018-07-0'.$day);
            if ($i==5||$i==25||$i==45||$i==65||$i==85) {
                $tt=1;
            }
            if ($i==20||$i==40||$i==60||$i==80) {
                $tt=0;
                $day++;
            }
            $trip->setSeats($seat);
            if ($i==20||$i==40||$i==60||$i==80) {
                $seat++;
            }
            $trip->setPets($pets);
            $trip->setSmoke($smoke);
            if ($i==5||$i==15||$i==25||$i==35||$i==45||$i==55||$i==65||$i==75||$i==85||$i==95) {
                $pets=1;
                $smoke=1;
            }
            if ($i==10||$i==20||$i==30||$i==40||$i==50||$i==60||$i==70||$i==80||$i==90) {
                $pets=0;
                $smoke=0;
            }
            $manager->persist($trip);
        }
        $manager->flush();
    }
}
