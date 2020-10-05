<?php

namespace App\Controller;


use App\Entity\CurrencyExchangerate;
use App\Entity\Currencies;
use App\Entity\Banana;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

class currencyController extends AbstractController{

    /**
     * @Route("/")
     * Methond({"GET", "POST"})
     */
    public function index(Request $request) {

        $entityManager = $this->getDoctrine()->getManager();

        $currency = new Currencies();
        $exchangeRate = new CurrencyExchangerate();

        // $exchangeRate->setToCurrencyId(12);
        // $exchangeRate->setRateDate(new \DateTime());
        // $exchangeRate->setExchangeRate('23');

        $fromCurrency = $this->getDoctrine()->getRepository(Currencies::class)->findAll();
        
        $form = $this->createFormBuilder([$fromCurrency,  $exchangeRate])
        ->add('value', TextareaType::class, array('label' => 'Amount' ,'attr' => array('class' => 'form-control')))
        ->add('fromCurr', EntityType::class, [
            // looks for choices from this entity
            'class' => Currencies::class,
            // uses the User.username property as the visible option string
            'choice_label' => 'Name',
        
            // used to render a select box, check boxes or radios
             //'multiple' => true,
             //'mapped' => false,
             'attr' => array('class' => 'form-control'),
             'label' => 'From'
            // 'expanded' => true,
        ])
        ->add('toCurr', EntityType::class, [
            // looks for choices from this entity
            'class' => Currencies::class,
        
            // uses the User.username property as the visible option string
            'choice_label' => 'Name',
        
            // used to render a select box, check boxes or radios
             //'multiple' => true,
             'attr' => array('class' => 'form-control'),
             'label' => 'Το'
            // 'expanded' => true,
        ])
       
        ->add('save', SubmitType::class, [
            'label' => 'find currency',
            'attr' => array('class' => 'btn btn-primary mt-3')
            ])
        ->getForm();

        $form->handleRequest($request);
           
        if($form->isSubmitted() && $form->isValid()){
            
            
            $data = $form->getData();
            $from = $form['fromCurr']->getName();
           //var_dump($data['value']);
            $amount = (float) $data['value'];
            //var_dump($amount);
            $fromCurrencyObject = $form->get('fromCurr')->getData();
            $toCurrencyObject = $form->get('toCurr')->getData();

            $fromCurrency = $fromCurrencyObject->getName();
            $toCurrency = $toCurrencyObject->getName();
            $fromCurrencyId = $fromCurrencyObject->getId();
            $toCurrencyId = $toCurrencyObject->getId();
           // echo $fromCurrencyId;
            //echo $toCurrencyId;
            
            //$banana = $this->getDoctrine()->getRepository(Banana::class)->find($id);
            $myCurrency = $this->getDoctrine()->getRepository(Banana::class)->findCurrency($fromCurrencyId, $toCurrencyId);
            //var_dump($myCurrency[0]->getExchangeRate());
            if($myCurrency){
                $currency = $myCurrency[0]->getExchangeRate();
                $result = $amount * $currency;

                return $this->render('index.html.twig', [
                    'form' => $form->createView(),
                    'result' => $result,
                    'fromCurrency' => $fromCurrency,
                    'toCurrency' => $toCurrency,
                    'amount' => $amount
                ]);
            }
            
            //echo ':::'. $result;
            
            //compute currency
            
            //var_dump($from);
            
            // $from = $form->request->get('Name');
            
            
            //echo $to;
            //var_dump(get_declared_classes());
            
            //  $row = $banana->findOneBy([
            //      'from_currency_id' => '$fromCurrencyId',
            //      'to_currency_id' => '$toCurrencyId'
            //  ]);
            //var_dump($row);
            // echo $data->fromCurr;
            // echo $data->toCurr;
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($data);
            // $entityManager->flush();

            
        }

        return $this->render('index.html.twig', [
            'form' => $form->createView(),
            
        ]);

        
        //return $this->render('index.html');


    }

      /**
     * @Route("/changeCurrency")
     * Methond({"GET", "POST"})
     */
    public function changeCurrency(Request $request){
        
        
        $entityManager = $this->getDoctrine()->getManager();

        $currency = new Currencies();
        $exchangeRate = new CurrencyExchangerate();

        // $exchangeRate->setToCurrencyId(12);
        // $exchangeRate->setRateDate(new \DateTime());
        // $exchangeRate->setExchangeRate('23');

        $fromCurrency = $this->getDoctrine()->getRepository(Currencies::class)->findAll();
        
        $form = $this->createFormBuilder([$fromCurrency,  $exchangeRate])
        ->add('value', TextareaType::class, array('label' => 'Amount' ,'attr' => array('class' => 'form-control')))
        ->add('fromCurr', EntityType::class, [
            // looks for choices from this entity
            'class' => Currencies::class,
            // uses the User.username property as the visible option string
            'choice_label' => 'Name',
        
            // used to render a select box, check boxes or radios
             //'multiple' => true,
             //'mapped' => false,
             'attr' => array('class' => 'form-control'),
             'label' => 'From'
            // 'expanded' => true,
        ])
        ->add('toCurr', EntityType::class, [
            // looks for choices from this entity
            'class' => Currencies::class,
        
            // uses the User.username property as the visible option string
            'choice_label' => 'Name',
        
            // used to render a select box, check boxes or radios
             //'multiple' => true,
             'attr' => array('class' => 'form-control'),
             'label' => 'Το'
            // 'expanded' => true,
        ])
       
        ->add('save', SubmitType::class, [
            'label' => 'find currency',
            'attr' => array('class' => 'btn btn-primary mt-3')
            ])
        ->getForm();

        $form->handleRequest($request);
           
        if($form->isSubmitted() && $form->isValid()){
            
            
            $data = $form->getData();
            $from = $form['fromCurr']->getName();
           //var_dump($data['value']);
            $amount = (float) $data['value'];
            //var_dump($amount);
            $fromCurrencyObject = $form->get('fromCurr')->getData();
            $toCurrencyObject = $form->get('toCurr')->getData();

            $fromCurrency = $fromCurrencyObject->getName();
            $toCurrency = $toCurrencyObject->getName();
            $fromCurrencyId = $fromCurrencyObject->getId();
            $toCurrencyId = $toCurrencyObject->getId();
           // echo $fromCurrencyId;
            //echo $toCurrencyId;
            
            //$banana = $this->getDoctrine()->getRepository(Banana::class)->find($id);
            $myCurrency = $this->getDoctrine()->getRepository(Banana::class)->findCurrency($fromCurrencyId, $toCurrencyId);
            //var_dump($myCurrency[0]->getExchangeRate());
            if($myCurrency){
                $currency = $myCurrency[0]->getExchangeRate();
                $result = $amount * $currency;

                return $this->render('index.html.twig', [
                    'form' => $form->createView(),
                    'result' => $result,
                    'fromCurrency' => $fromCurrency,
                    'toCurrency' => $toCurrency,
                    'amount' => $amount
                ]);
            }
            
        }


        return $this->render('changeCurrency.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/computeCurrency")
     * Methond({"POST", "GET"})
     */
    public function computeCurrency(Request $request, Response $response) {
        echo $request;
        $response = 'this is the best day of your life';
        return $response;
    }
}