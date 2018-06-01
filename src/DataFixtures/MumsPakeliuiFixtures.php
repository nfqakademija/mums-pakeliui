<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Trip;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\DateTime;

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
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        $c = 0;
        $travellertype = 0;
        $day = new \DateTime('2018-07-01');

        for ($i = 1; $i <= 100; $i++) {
            $user = new User();
            $username = self::NAMES[$i - 1];
            $user->setUsername($username);
            $password = $this->encoder->encodePassword($user, 'baravykas' . $i);
            $user->setEmail(strtolower(self::NAMES[$i - 1]) . '@mail.com');
            $user->setPassword($password);
            $user->setEnabled(true);
            $manager->persist($user);

            $trip = new Trip();
            $trip->setUser($user);
            $trip->setTravelerType($travellertype);
            $trip->setDepartFrom(self::CITY_FROM_TO_1[$c]);
            $c++;
            $trip->setDestination(self::CITY_FROM_TO_1[$c]);
            $c++;
            $trip->setDepartTime($day);
            if ($i % 20 == 5) {
                $travellertype = 1;
            }
            if ($i % 20 == 0) {
                $travellertype = 0;
                $day = clone $day->modify('1days');
            }

            $trip->setSeats(rand(1, 7));
            $trip->setPets(rand(1, 0));
            $trip->setSmoke(rand(1, 0));
            $trip->setPhone('+ 370' . rand(10000, 99999));
            $manager->persist($trip);
        }
        $manager->flush();
    }
}
