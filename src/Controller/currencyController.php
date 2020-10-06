<?php

namespace App\Controller;


use App\Entity\CurrencyExchangerate;
use App\Entity\Currencies;
use App\Entity\Banana;

// src/Form/Type/CurrenciesType.php
use App\Form\Type\CurrenciesType;
use App\Form\Type\ChangeType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpClient\HttpClient;

//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;



class currencyController extends AbstractController{

    /**
     * @Route("/")
     * Methond({"GET", "POST"})
     */
    public function index(Request $request) {

        $entityManager = $this->getDoctrine()->getManager();
        // creates a Currencies object
        $currency = new Currencies();
        $currency = $this->getDoctrine()->getRepository(Currencies::class)->findAll();
    
        $form = $this->createForm(CurrenciesType::class, $currency);
        $form->handleRequest($request);
         
        //if the form is submitted
        if($form->isSubmitted() && $form->isValid()){
            
            //
            $data = $form->getData(); // get the form data
            //$from = $form['fromCurr']->getName(); // get base currency name
            //var_dump($from);
            $amount = (float) $data['value'];// get the user amount that must converted 
            $fromCurrencyObject = $form->get('fromCurr')->getData(); // get base currency  | Currencies object
            $toCurrencyObject = $form->get('toCurr')->getData();// get the currency | Currencies object

            $fromCurrency = $fromCurrencyObject->getName(); // get the name of currency
            $toCurrency = $toCurrencyObject->getName();
            $fromCurrencyId = $fromCurrencyObject->getId(); // get the id 
            $toCurrencyId = $toCurrencyObject->getId();
           
            if($fromCurrencyId == $toCurrencyId){
                $currency = 1;
                $result = $amount * $currency;
            }else{
                $myCurrency = $this->getDoctrine()->getRepository(Banana::class)->findCurrency($fromCurrencyId, $toCurrencyId);
                if(!$myCurrency){
                    $myCurrencyReversed = $this->getDoctrine()->getRepository(Banana::class)->findCurrency( $toCurrencyId, $fromCurrencyId);
                    $currency = $myCurrencyReversed[0]->getExchangeRate();
                    $result = $amount * 1/$currency;
                }else{
                    $currency = $myCurrency[0]->getExchangeRate();
                    $result = $amount * $currency;
                }
            }
            
            if($currency){
                return $this->render('index.html.twig', [
                    'form' => $form->createView(),
                    'result' => $result,
                    'fromCurrency' => $fromCurrency,
                    'toCurrency' => $toCurrency,
                    'amount' => $amount
                ]);
            }
        }

        return $this->render('index.html.twig', [
            'form' => $form->createView(),
            
        ]);
    }

      /**
     * @Route("/changeCurrency")
     * Methond({"GET", "POST"})
     */
    public function changeCurrency(Request $request){
        
        //fetch the EntityManager via $this->getDoctrine()
        $entityManager = $this->getDoctrine()->getManager();

        $currency = new Currencies();
        $banana = new Banana();

        $currency = $this->getDoctrine()->getRepository(Currencies::class)->findAll();
        $form = $this->createForm(ChangeType::class, $currency);

        $form->handleRequest($request);
           
        if($form->isSubmitted() && $form->isValid()){
            
            $data = $form->getData();
            $from = $form['fromCurr']->getName();
           //var_dump($data['value']);
            $amount = (float) $data['value'];
            $newCurrency = (float) $data['value'];
            //var_dump($amount);
            $fromCurrencyObject = $form->get('fromCurr')->getData();
            $toCurrencyObject = $form->get('toCurr')->getData();

            $fromCurrency = $fromCurrencyObject->getName();
            $toCurrency = $toCurrencyObject->getName();
            $fromCurrencyId = $fromCurrencyObject->getId();
            $toCurrencyId = $toCurrencyObject->getId();
            if($fromCurrencyId == $toCurrencyId){
                $currency = 1;
            }else{
                $myCurrency = $this->getDoctrine()->getRepository(Banana::class)->findCurrency($fromCurrencyId, $toCurrencyId);
                

                if($myCurrency && $fromCurrencyId == $myCurrency[0]->getFromCurrencyId($fromCurrencyId)){
                    //var_dump($myCurrency);
                $myCurrency[0]->setExchangeRate($newCurrency);
                $myCurrency[0]->setFromCurrencyId($fromCurrencyId);
                $myCurrency[0]->setToCurrencyId($toCurrencyId);
                $myCurrency[0]->setRateDate(new \DateTime());
                    $entityManager->flush();
                    $currency = $myCurrency[0]->getExchangeRate();
                }else if( $myCurrency = $this->getDoctrine()->getRepository(Banana::class)->findCurrency($toCurrencyId, $fromCurrencyId)){
                    //echo 'trolll';
                    $myCurrency[0]->setExchangeRate(1/$newCurrency);
                    $myCurrency[0]->setFromCurrencyId($fromCurrencyId);
                    $myCurrency[0]->setToCurrencyId($toCurrencyId);
                    $myCurrency[0]->setRateDate(new \DateTime());
                        $entityManager->flush();
                        $currency = $myCurrency[0]->getExchangeRate();

                }else{
                    $banana->setExchangeRate($newCurrency);
                    $banana->setFromCurrencyId($fromCurrencyId);
                    $banana->setToCurrencyId($toCurrencyId);
                    $banana->setRateDate(new \DateTime());

                     // tell Doctrine you want to (eventually) save the Product (no queries yet)
                    $entityManager->persist($banana);

                     // actually executes the queries (i.e. the INSERT query)
                    $entityManager->flush();
                    $currency = $newCurrency;// this is the new currency
                }
                
            }
            if($currency){
                //show the currency
                $result = 1 * $currency;

                return $this->render('index.html.twig', [
                    'form' => $form->createView(),
                    'result' => $result,
                    'fromCurrency' => $fromCurrency,
                    'toCurrency' => $toCurrency,
                    'amount' => 1
                ]);
            }
            
        }


        
        return $this->render('changeCurrency.html.twig', [
            'form' => $form->createView(),
        ]);
    }

     /**
     * @Route("/editCurrency")
     * Methond({"GET", "POST"})
     */
    // this function takes the currencies with get request and fetch them
    // you can use it in later version to update the values automatically
    public function editCurrency(Request $request){
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://api.exchangeratesapi.io/latest');

        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $contentJSON = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]
        //var_dump($content['rates']);

        $entityManager = $this->getDoctrine()->getManager();
        //$banana = new Banana();
        $currency = new Currencies();
        //$this->getDoctrine()->getRepository(Banana::class)->findCurrency($fromCurrencyId, $toCurrencyId);
        // foreach ($content['rates'] as $key => $value) {
        //     $currency = new Currencies();
        //     $currency->setName($key);
        //     $entityManager->persist($currency);
        //     $entityManager->flush();

        // }
         
        return $this->render('edit.html.twig', [
            'rates' => $content['rates'],
            'ratesJSON' => $contentJSON
        ]);
    }


}