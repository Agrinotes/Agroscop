<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Farm;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;
use UserBundle\Entity\User;

class LoadFarm implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $em)
    {
        // Create User
        $user = new User();
        $user->setFirstName("farmer_first_name");
        $user->setLastName("farmer_last_name");
        $user->setEmail("farmer@repair.nc");
        $user->setPlainPassword("farmer");
        $user->setEnabled(true);

        $em->persist($user);
        $em->flush();

        // Add ROLE_FARMER to current user
        $user->setRoles(array('ROLE_FARMER'));

        $em->persist($user);

        // Create a farm
        $farm = new Farm();
        $farm->setName('Farm 1');
        $farm->setFarmer($user);
        $em->persist($farm);
        $em->flush();
    }
}