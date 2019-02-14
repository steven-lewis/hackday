<?php

namespace App\Controller;

use http\Client;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * DefaultController constructor.
     * @param Client $httpClient
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }


    /**
     * @Route("/", name="default")
     */
    public function index()
    {

        $messageFactory = MessageFactoryDiscovery::find();

        $req = $messageFactory->createRequest('get',    'http://www.google.com');

        $res = $this->httpClient->sendRequest($req);

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'shaz' =>         $res->getBody()
        ]);
    }
}
