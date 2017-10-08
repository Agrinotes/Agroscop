<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Crop;


class LoadCrops extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Add default data for crops
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
      $manager->getConnection()->getConfiguration()->setSQLLogger(null);

        $names = array(
            array('Abricot','#ff9800'),
            array('Ail','#9e9e9e'),
            array('Ail à 3 angles','#9e9e9e'),
            array('Ail des ours','#9e9e9e'),
            array('Ail rocambole','#9e9e9e'),
            array('Anacardier (Noix de cajou)','#9e9e9e'),
            array('Ananas','#ff9800'),
            array('Aneth','#689F38'),
            array('Angelique','#689F38'),
            array('Anone ou Pomme-canelle','#4caf50'),
            array('Arachide','#FFB300'),
            array('Armoise','#689F38'),
            array('Artichaud','#689F38'),
            array('Asperge','#4caf50'),
            array('Aubergine','#9c27b0'),
            array('Avocat','#4caf50'),
            array('Avoine','#9E9D24'),
            array('Banane','#FFD600'),
            array('Barbadine','#558B2F'),
            array('Bardane','#689F38'),
            array('Basilic','#689F38'),
            array('Betterave commune','#B71C1C'),
            array('Betterave rouge','#B71C1C'),
            array('Betterave sucrière','#B71C1C'),
            array('Betterave fourragère','#B71C1C'),
            array('Blé tendre','#9E9D24'),
            array('Blé dur','#9E9D24'),
            array('Blette','#689F38'),
            array('Bleuet','#689F38'),
            array('Cacao','#3E2723'),
            array('Café','#C62828'),
            array('Canne à sucre','#558B2F'),
            array('Carambole','#F9A825'),
            array('Carotte','#EF6C00'),
            array('Cassissier',' #8E24AA'),
            array('Céléri-rave','#689F38'),
            array('Céléri-branche','#689F38'),
            array('Cerfeuil','#689F38'),
            array('Cerisier','#C62828'),
            array('Chanvre','#558B2F'),
            array('Chardon-Marie','#689F38'),
            array('Chicorée pour la production de racines','#689F38'),
            array('Chouchoute','#689F38'),
            array('Choux de Chine','#33691E'),
            array('Choux kanak','#33691E'),
            array('Choux-vert','#33691E'),
            array('Choux-pommés','#33691E'),
            array('Choux-raves','#33691E'),
            array('Choux romanesco','#33691E'),
            array('Choux-fleurs','#33691E'),
            array('Choux','#33691E'),
            array('Ciboulette','#689F38'),
            array('Citronelle','#AFB42B'),
            array('Citron','#FFB300'),
            array('Citron vert','#C0CA33'),
            array('Citrouille','#EF6C00'),
            array('Clémentine','#EF6C00'),
            array('Coco','#4E342E'),
            array('Coriandre','#689F38'),
            array('Colza','#FFB300'),
            array('Concombre','#558B2F'),
            array('Cornichon','#689F38'),
            array('Courge','#E64A19'),
            array('Courgette','#E64A19'),
            array('Cresson','#33691E'),
            array('Cumin','#689F38'),
            array('Curcuma','#ff9800'),
            array('Dolique','#689F38'),
            array('Endive','#7CB342'),
            array('Epeautre','#689F38'),
            array('Epinard','#7CB342'),
            array('Estragon','#689F38'),
            array('Fabacées ou Légumineuses diverses','#7CB342'),
            array('Fenouil','#00695C'),
            array('Fève','#00695C'),
            array('Fèverolle','#004D40'),
            array('Ficus',' #8E24AA'),
            array('Figue',' #8E24AA'),
            array('Fraise','#f44336'),
            array('Framboise','#FF5252'),
            array('Fruits à pain','#4caf50'),
            array('Gingembre','#C0CA33'),
            array('Goyave','#AB47BC'),
            array('Grenade','#F44336'),
            array('Groseille','#C62828'),
            array('Haricot','#7CB342'),
            array('Houblon','#7CB342'),
            array('Igname','#5D4037'),
            array('Kiwi','#43A047'),
            array('Kumquat','#43A047'),
            array('Laitue','#AFB42B'),
            array('Lavande','#689F38'),
            array('Lentille','#689F38'),
            array('Lime','#C0CA33'),
            array('Lin','#43A047'),
            array('Litchi','#B71C1C'),
            array('Lupin','#689F38'),
            array('Luzerne','#558B2F'),
            array('Maïs','#558B2F'),
            array('Maïs doux ou maïs sucré','#558B2F'),
            array('Mandarine','#F57F17'),
            array('Mangue','#F57F17'),
            array('Manioc','#795548'),
            array('Marjolaine','#689F38'),
            array('Mauve','#689F38'),
            array('Melon','#F57F17'),
            array('Mélisse','#689F38'),
            array('Menthe','#43A047'),
            array('Millet','#558B2F'),
            array('Millepertuis','#689F38'),
            array('Moutarde','#FFB300'),
            array('Myrtille','#E53935'),
            array('Navet','#009688'),
            array('Noix de pécan','#004D40'),
            array('Oignon','#558B2F'),
            array('Orange','#EF6C00'),
            array('Orge','#558B2F'),
            array('Oseille','#689F38'),
            array('Palmier','#7CB342'),
            array('Pamplemousse','#ff9800'),
            array('Papaye','#F57F17'),
            array('Patate douce','#F9A825'),
            array('Pastèque','#F44336'),
            array('Pâtisson','#F44336'),
            array('Pavot','#f44336'),
            array('Pêcher','#F57F17'),
            array('Persil','#827717'),
            array('Piment doux','#f44336'),
            array('Piment','#f44336'),
            array('Pithaya ou Fruit du dragon','#f44336'),
            array('Plantain','#33691E'),
            array('Poacées ou Graminées diverses','#558B2F'),
            array('Poireau','#33691E'),
            array('Pois','#33691E'),
            array('Pois-chiche','#689F38'),
            array('Poivre','#757575'),
            array('Poivron','#f44336'),
            array('Potiron','#F44336'),
            array('Potimarron','#F44336'),
            array('Pommelo','#FFB300'),
            array('Pommier','#00695C'),
            array('Pomme de terre','#00695C'),
            array('Pomme-liane ou fruit de la passion','#558B2F'),
            array('Pomme-caillou','#558B2F'),
            array('PPAMC','#43A047'),
            array('Prunier','#C62828'),
            array('Radis','#D32F2F'),
            array('Radis noir','#D32F2F'),
            array('Raisin ou Vigne','#D32F2F'),
            array('Rhubarbe','#D32F2F'),
            array('Ricin','#558B2F'),
            array('Riz','#558B2F'),
            array('Roses','#B71C1C'),
            array('Salsifis','#D32F2F'),
            array('Sariette','#689F38'),
            array('Sauge','#689F38'),
            array('Seigle','#9E9D24'),
            array('Soja','#FFB300'),
            array('Sorgho','#9E9D24'),
            array('Tabac','#D32F2F'),
            array('Tamarinier','#9E9D24'),
            array('Taro','#1B5E20'),
            array('Thym','#689F38'),
            array('Tomate','#f44336'),
            array('Tournesol','#ff9800'),
            array('Triticale','#689F38'),
            array('Trèfle','#9c27b0'),
            array('Vanille','#795548')
        );

        foreach ($names as $name) {
            $crop = new Crop();
            $crop->setName($name[0]);
            $crop->setColor($name[1]);
            $manager->persist($crop);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 5;
    }
}
