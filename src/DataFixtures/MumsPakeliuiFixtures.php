<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Trip;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MumsPakeliuiFixtures extends Fixture
{
    const NAMES = ['Matas', 'Lukas', 'Dominykas', 'Jokūbas', 'Kajus', 'Jonas', 'Nojus', 'Domas', 'Benas', 'Joris',
            'Emilija', 'Kamilė', 'Sofija', 'Lėja', 'Amelija', 'Gabija', 'Austėja', 'Ema', 'Viltė', 'Liepa',
            'Darius', 'Mantas', 'Tomas', 'Karolis', 'Rokas', 'Paulius', 'Deividas', 'Marius', 'Martynas', 'Dovydas',
            'Gabrielė', 'Karolina', 'Greta', 'Giedrė', 'Viktorija', 'Ieva', 'Monika', 'Nijolė', 'Evelina', 'Laura',
            'Ignas', 'Arnas', 'Justas', 'Danielius', 'Emilis', 'Augustas', 'Domantas', 'Gabrielius', 'Kristupas',
            'Gustas', 'Ugnė', 'Urtė', 'Vilma', 'Rugilė', 'Miglė', 'Goda', 'Augustė', 'Deimantė', 'Saulė', 'Paulina',
            'Titas', 'Edvinas', 'Laurynas', 'Eimantas', 'Adomas', 'Vilius', 'Armandas', 'Erikas', 'Pijus', 'Tadas',
            'Aistė', 'Kotryna', 'Karina', 'Gustė', 'Agnė', 'Smiltė', 'Akvilė', 'Patricija', 'Eva', 'Rusnė',
            'Nedas', 'Ernestas', 'Ugnius', 'Nikita', 'Simonas', 'Gytis', 'Viktoras', 'Aivaras', 'Eligijus', 'Nerijus',
            'Marija', 'Samanta', 'Erika', 'Eglė', 'Simona', 'Kornelija', 'Milda', 'Gintarė', 'Svetlana', 'Tamara'];

    const CITY_FROM_TO_1 = ['Vilnius', 'Kaunas',
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

            'Vilnius, Lithuania', 'London',
            'Vilnius, Lithuania', 'Frankfurt, Germany',
            'Kaunas', 'Amsterdam, Netherlands',
            'Klaipėda', 'Munich, Germany',
            'Amsterdam, Netherlands', 'Trakai',
            'Rome, Metropolitan City of Rome, Italy', 'Kaunas',
            'Paris, France', 'Biržai',
            'Tilburg, Netherlands', 'Alytus',
            'Madrid, Spain', 'Šiauliai',
            'Alesund, Norway', 'Trakai',
            'Vilnius', 'Tilburg, Netherlands',
            'Mažeikiai', 'Amsterdam, Netherlands',
            'Palanga', 'Alesund, Norway',
            'Alytus', 'Munich, Germany',
            'Frankfurt, Germany', 'Trakai',
            'Kiruna, Sweden', 'Kaunas',
            'Bialystok, Poland', 'Kaunas',
            'Vilnius', ' Bialystok, Poland',
            'Warsaw, Poland', 'Vilnius',
            'Munich, Germany', 'Kaunas',
            'Kaunas', 'Kiruna, Sweden',
            'Paris, France', 'Biržai',
            'Madrid, Spain', 'Alytus',
            'Alytus', 'Paris, France',
            'Munich, Germany', 'Vilnius',

            'Kaunas', 'London',
            'Alytus', 'Frankfurt, Germany',
            'Vilnius', 'Amsterdam, NethLoerlands',
            'Vilnius', 'Munich, Germany',
            'Amsterdam, Netherlands', 'Klaipėda',
            'Rome, Metropolitan City of Rome, Italy', 'Klaipėda',
            'Paris, France', 'Kaunas',
            'Tilburg, Netherlands', 'Biržai',
            'Madrid, Spain', 'Kaunas',
            'Alesund, Norway', 'Trakai',
            'Šiauliai', 'Breda, Netherlands',
            'Trakai', 'The Hague, Netherlands',
            'Vilnius', 'Alesund, Norway',
            'Palanga', 'Munich, Germany',
            'Frankfurt, Germany', 'Trakai',
            'Kiruna, Sweden', 'Klaipėda',
            'Bialystok, Poland', 'Kaunas',
            'Alytus', ' Bialystok, Poland',
            'Warsaw, Poland', 'Vilnius',
            'Munich, Germany', 'Klaipėda',
            'Kaunas', 'Kiruna, Sweden',
            'Paris, France', 'Vilnius',
            'Madrid, Spain', 'Alytus',
            'Alytus', 'Paris, France',
            'Munich, Germany', 'Vilnius'
        ];
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $count = 200;
        $c = 0;
        $travellertype = 0;
        $day = new \DateTime('2018-06-05 05:00');
        $day2 = new \DateTime('2018-07-05 05:00');

        for ($i = 1; $i <= 100; $i++) {
            $user = new User();
            $username = self::NAMES[$i - 1];
            $user->setUsername($username);
            $password = $this->encoder->encodePassword($user, 'baravykas' . $i);
            $user->setEmail(strtolower(self::NAMES[$i - 1]) . '@mail.com');
            $user->setPassword($password);
            $user->setEnabled(true);
            $manager->persist($user);

            if ($i % 20 == 5) {
                $travellertype = 1;
                $day = clone $day->modify('2hour');
            }
            if ($i % 20 == 0) {
                $travellertype = 0;
                $day = clone $day->modify('1days 30minutes');
            }

            $this-> addTrip($user, $travellertype, $c, $day, $manager);
            $c++;

            if ($count <= 250) {
                $this->addTrip($user, $travellertype, $count, $day2, $manager);
                $count = $count + 2;
                $day2 = clone $day2->modify('3hour');

            }
        }
        $manager->flush();
    }

    public function addTrip($user, $travellertype, $c, $day, ObjectManager $manager)
    {
        $trip = new Trip();
        $trip->setUser($user);
        $trip->setTravelerType($travellertype);
        $c++;
        $trip->setDepartFrom(self::CITY_FROM_TO_1[$c]);
        $c++;
        $trip->setDestination(self::CITY_FROM_TO_1[$c]);
        $trip->setDepartTime($day);
        $trip->setSeats(rand(1, 7));
        $trip->setPets(rand(1, 0));
        $trip->setSmoke(rand(1, 0));
        $trip->setPhone('+370' . rand(10000, 99999));
        $manager->persist($trip);
    }
}
