<?php

namespace App\Infrastructure\Controller;

use App\Application\Query\FilterCarsQuery;
use App\Application\Query\ListAllCarsEnabledQuery;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Application\Query\GetCarInfoQuery;

class CarController extends CustomAbstractController
{
    /**
     * @Route("/", name="list_cars")
     */
    public function index()
    {
        $query = new ListAllCarsEnabledQuery();

        return $this->render('car/list.html.twig', [
            'cars' => $this->handleMessage($query),
        ]);
    }

    /**
     * @Route("/car/{slug}", name="car_show")
     */
    public function show(string $slug)
    {
        $query = new GetCarInfoQuery($slug);

        return $this->render('car/show.html.twig', [
            'car' => $this->handleMessage($query),
        ]);
    }

    /**
     * @Route("/car/search/filter", name="car_filter")
     */
    public function filterCars(Request $request)
    {
        $query = new FilterCarsQuery(
            $request->request->get('field'),
            $request->request->get('search')
        );

        return $this->render('car/carsTable.html.twig', [
            'cars' => $this->handleMessage($query),
        ]);
    }
}