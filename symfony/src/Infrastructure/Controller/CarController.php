<?php

namespace App\Infrastructure\Controller;

use App\Application\UseCases\Car\ListAllCarsEnabled;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Application\UseCases\Car\GetCarInfo;
use Symfony\Component\HttpFoundation\Request;
use App\Application\UseCases\Car\ListCarsFiltered;

class CarController extends AbstractController
{
    /**
     * @Route("/", name="list_cars")
     */
    public function index(ListAllCarsEnabled $query)
    {
        return $this->render('car/list.html.twig', [
            'cars' => $query->getCarsEnabled(),
        ]);
    }

    /**
     * @Route("/car/{slug}", name="car_show")
     */
    public function show(GetCarInfo $query, string $slug)
    {
        return $this->render('car/show.html.twig', [
            'car' => $query->getCarDetails($slug),
        ]);
    }

    /**
     * @Route("/car/search/filter", name="car_filter")
     */
    public function filterCars(Request $request, ListCarsFiltered $query)
    {
        return $this->render('car/carsTable.html.twig', [
            'cars' => $query->getCarsFiltered($request),
        ]);
    }
}