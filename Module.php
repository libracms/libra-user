<?php

namespace LibraUser;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\MvcEvent;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
    /**
     * executes on boostrap
     * @param \Zend\Mvc\MvcEvent $e
     * @return null
     */
    public function onBootstrap(MvcEvent $e)
    {
        $sl = $e->getApplication()->getServiceManager();
        // Add guest role to registered user
        $zfcuserAuth = $sl->get('zfcuser_user_service');
        $zfcuserAuth->getEventManager()->attach('register', function($e) use ($sl) {
            $newUser = $e->getParam('user');
            $roleRepo = $sl->get('libra_user_em')->getRepository('LibraUser\Entity\Role');
            $guestRole = $roleRepo->findOneBy(['name' => 'guest']);
            $newUser->getRoles()->add($guestRole);
        });
    }

    public function getServiceConfig()
    {
        return array(
            'aliases' => array(
                'libra_user_em' => 'Doctrine\ORM\EntityManager',
            ),
            'factories' => array(
                'libra_user_options' => function ($sm) {
                    $config = $sm->get('Configuration');
                    return new Options\Module((array)($config['zfcuser']));
                },
                'zfcuser_user_mapper' => function ($sm) {
                    $em = $sm->get('libra_user_em');
                    $options = $sm->get('libra_user_options');
                    return $em->getRepository($options->getUserEntityClass());
                },
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
