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

    const CITY_FROM_TO_1 = ['Vilnius, Lithuania', 'Kaunas, Lithuania',
            'Vilnius, Lithuania', 'Palanga, Lithuania',
            'Vilnius, Lithuania', 'Zarasai, Lithuania',
            'Klaipėda, Lithuania', 'Šiauliai, Lithuania',
            'Zapyškis, Lithuania', 'Baisiogala, Lithuania',
            'Vilnius, Lithuania', 'Kaunas, Lithuania',
            'Vilnius, Lithuania', 'Palanga, Lithuania',
            'Vilnius, Lithuania', 'Zarasai, Lithuania',
            'Klaipėda, Lithuania', 'Šiauliai, Lithuania',
            'Zapyškis, Lithuania', 'Baisiogala, Lithuania',
            'Vilnius, Lithuania', 'Kaunas, Lithuania',
            'Vilnius, Lithuania', 'Palanga, Lithuania',
            'Vilnius, Lithuania', 'Zarasai, Lithuania',
            'Klaipėda, Lithuania', 'Šiauliai, Lithuania',
            'Zapyškis, Lithuania', 'Baisiogala, Lithuania',
            'Vilnius, Lithuania', 'Kaunas, Lithuania',
            'Vilnius, Lithuania', 'Palanga, Lithuania',
            'Vilnius, Lithuania', 'Zarasai, Lithuania',
            'Klaipėda, Lithuania', 'Šiauliai, Lithuania',
            'Zapyškis, Lithuania', 'Baisiogala, Lithuania',
            'Vilnius, Lithuania', 'Kaunas, Lithuania',
            'Vilnius, Lithuania', 'Palanga, Lithuania',
            'Vilnius, Lithuania', 'Zarasai, Lithuania',
            'Klaipėda, Lithuania', 'Šiauliai, Lithuania',
            'Zapyškis, Lithuania', 'Baisiogala, Lithuania',

            'Klaipėda, Lithuania', 'Kaunas, Lithuania',
            'Klaipėda, Lithuania', 'Palanga, Lithuania',
            'Klaipėda, Lithuania', 'Zarasai, Lithuania',
            'Vilnius, Lithuania', 'Šiauliai, Lithuania',
            'Kaunas, Lithuania', 'Baisiogala, Lithuania',
            'Klaipėda, Lithuania', 'Kaunas, Lithuania',
            'Klaipėda, Lithuania', 'Palanga, Lithuania',
            'Klaipėda, Lithuania', 'Zarasai, Lithuania',
            'Vilnius, Lithuania', 'Šiauliai, Lithuania',
            'Kaunas, Lithuania', 'Baisiogala, Lithuania',
            'Klaipėda, Lithuania', 'Kaunas, Lithuania',
            'Klaipėda, Lithuania', 'Palanga, Lithuania',
            'Klaipėda, Lithuania', 'Zarasai, Lithuania',
            'Vilnius, Lithuania', 'Šiauliai, Lithuania',
            'Kaunas, Lithuania', 'Baisiogala, Lithuania',
            'Klaipėda, Lithuania', 'Kaunas, Lithuania',
            'Klaipėda, Lithuania', 'Palanga, Lithuania',
            'Klaipėda, Lithuania', 'Zarasai, Lithuania',
            'Vilnius, Lithuania', 'Šiauliai, Lithuania',
            'Kaunas, Lithuania', 'Baisiogala, Lithuania',
            'Klaipėda, Lithuania', 'Kaunas, Lithuania',
            'Klaipėda, Lithuania', 'Palanga, Lithuania',
            'Klaipėda, Lithuania', 'Zarasai, Lithuania',
            'Vilnius, Lithuania', 'Šiauliai, Lithuania',
            'Kaunas, Lithuania', 'Baisiogala, Lithuania',

            'Baisiogala, Lithuania', 'Kaunas, Lithuania',
            'Baisiogala, Lithuania', 'Palanga, Lithuania',
            'Klaipėda, Lithuania', 'Zarasai, Lithuania',
            'Baisiogala, Lithuania', 'Šiauliai, Lithuania',
            'Vilnius, Lithuania', 'Baisiogala, Lithuania',
            'Baisiogala, Lithuania', 'Kaunas, Lithuania',
            'Baisiogala, Lithuania', 'Palanga, Lithuania',
            'Klaipėda, Lithuania', 'Zarasai, Lithuania',
            'Baisiogala, Lithuania', 'Šiauliai, Lithuania',
            'Vilnius, Lithuania', 'Baisiogala, Lithuania',
            'Baisiogala, Lithuania', 'Kaunas, Lithuania',
            'Baisiogala, Lithuania', 'Palanga, Lithuania',
            'Klaipėda, Lithuania', 'Zarasai, Lithuania',
            'Baisiogala, Lithuania', 'Šiauliai, Lithuania',
            'Vilnius, Lithuania', 'Baisiogala, Lithuania',
            'Baisiogala, Lithuania', 'Kaunas, Lithuania',
            'Baisiogala, Lithuania', 'Palanga, Lithuania',
            'Klaipėda, Lithuania', 'Zarasai, Lithuania',
            'Baisiogala, Lithuania', 'Šiauliai, Lithuania',
            'Vilnius, Lithuania', 'Baisiogala, Lithuania',
            'Baisiogala, Lithuania', 'Kaunas, Lithuania',
            'Baisiogala, Lithuania', 'Palanga, Lithuania',
            'Klaipėda, Lithuania', 'Zarasai, Lithuania',
            'Baisiogala, Lithuania', 'Šiauliai, Lithuania',
            'Vilnius, Lithuania', 'Baisiogala, Lithuania',

            'Palanga, Lithuania', 'Kaunas, Lithuania',
            'Mažeikiai, Lithuania', 'Palanga, Lithuania',
            'Palanga, Lithuania', 'Zarasai, Lithuania',
            'Pasvalys, Lithuania', 'Šiauliai, Lithuania',
            'Vilnius, Lithuania', 'Trakai, Lithuania',
            'Palanga, Lithuania', 'Kaunas, Lithuania',
            'Mažeikiai, Lithuania', 'Palanga, Lithuania',
            'Palanga, Lithuania', 'Zarasai, Lithuania',
            'Pasvalys, Lithuania', 'Šiauliai, Lithuania',
            'Vilnius, Lithuania', 'Trakai, Lithuania',
            'Palanga, Lithuania', 'Kaunas, Lithuania',
            'Mažeikiai, Lithuania', 'Palanga, Lithuania',
            'Palanga, Lithuania', 'Zarasai, Lithuania',
            'Pasvalys, Lithuania', 'Šiauliai, Lithuania',
            'Vilnius, Lithuania', 'Trakai, Lithuania',
            'Palanga, Lithuania', 'Kaunas, Lithuania',
            'Mažeikiai, Lithuania', 'Palanga, Lithuania',
            'Palanga, Lithuania', 'Zarasai, Lithuania',
            'Pasvalys, Lithuania', 'Šiauliai, Lithuania',
            'Vilnius, Lithuania', 'Trakai, Lithuania',
            'Palanga, Lithuania', 'Kaunas, Lithuania',
            'Mažeikiai, Lithuania', 'Palanga, Lithuania',
            'Palanga, Lithuania', 'Zarasai, Lithuania',
            'Pasvalys, Lithuania', 'Šiauliai, Lithuania',
            'Vilnius, Lithuania', 'Trakai, Lithuania',

            'Vilnius, Lithuania', 'London, UK',
            'Vilnius, Lithuania', 'Frankfurt, Germany',
            'Kaunas, Lithuania', 'Amsterdam, Netherlands',
            'Klaipėda, Lithuania', 'Munich, Germany',
            'Amsterdam, Netherlands', 'Trakai, Lithuania',
            'Rome, Metropolitan City of Rome, Italy', 'Kaunas, Lithuania',
            'Paris, France', 'Biržai, Lithuania',
            'Tilburg, Netherlands', 'Alytus, Lithuania',
            'Madrid, Spain', 'Šiauliai, Lithuania',
            'Alesund, Norway', 'Trakai, Lithuania',
            'Vilnius, Lithuania', 'Tilburg, Netherlands',
            'Mažeikiai, Lithuania', 'Amsterdam, Netherlands',
            'Palanga, Lithuania', 'Alesund, Norway',
            'Alytus, Lithuania', 'Munich, Germany',
            'Frankfurt, Germany', 'Trakai, Lithuania',
            'Kiruna, Sweden', 'Kaunas, Lithuania',
            'Bialystok, Poland', 'Kaunas, Lithuania',
            'Vilnius, Lithuania', ' Bialystok, Poland',
            'Warsaw, Poland', 'Vilnius, Lithuania',
            'Munich, Germany', 'Kaunas, Lithuania',
            'Kaunas, Lithuania', 'Kiruna, Sweden',
            'Paris, France', 'Biržai, Lithuania',
            'Madrid, Spain', 'Alytus, Lithuania',
            'Alytus, Lithuania', 'Paris, France',
            'Munich, Germany', 'Vilnius, Lithuania',

            'Kaunas, Lithuania', 'London, UK',
            'Alytus, Lithuania', 'Frankfurt, Germany',
            'Vilnius, Lithuania', 'Amsterdam, NethLoerlands',
            'Vilnius, Lithuania', 'Munich, Germany',
            'Amsterdam, Netherlands', 'Klaipėda, Lithuania',
            'Rome, Metropolitan City of Rome, Italy', 'Klaipėda, Lithuania',
            'Paris, France', 'Kaunas, Lithuania',
            'Tilburg, Netherlands', 'Biržai, Lithuania',
            'Madrid, Spain', 'Kaunas, Lithuania',
            'Alesund, Norway', 'Trakai, Lithuania',
            'Šiauliai, Lithuania', 'Breda, Netherlands',
            'Trakai, Lithuania', 'The Hague, Netherlands',
            'Vilnius, Lithuania', 'Alesund, Norway',
            'Palanga, Lithuania', 'Munich, Germany',
            'Frankfurt, Germany', 'Trakai, Lithuania',
            'Kiruna, Sweden', 'Klaipėda, Lithuania',
            'Bialystok, Poland', 'Kaunas, Lithuania',
            'Alytus, Lithuania', ' Bialystok, Poland',
            'Warsaw, Poland', 'Vilnius, Lithuania',
            'Munich, Germany', 'Klaipėda, Lithuania',
            'Kaunas, Lithuania', 'Kiruna, Sweden',
            'Paris, France', 'Vilnius, Lithuania',
            'Madrid, Spain', 'Alytus, Lithuania',
            'Alytus, Lithuania', 'Paris, France',
            'Munich, Germany', 'Vilnius, Lithuania'
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
