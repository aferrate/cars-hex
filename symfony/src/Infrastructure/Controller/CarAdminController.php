<?php

namespace App\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Application\UseCases\Car\ListAllCars;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Application\UseCases\Car\DeleteCar;
use App\Application\UseCases\Car\InsertCar;
use App\Infrastructure\Form\CarFormType;
use Symfony\Component\HttpFoundation\Response;
use App\Application\UseCases\Car\CitySelect;
use App\Domain\Model\Car;
use App\Application\UseCases\Car\UpdateCar;

class CarAdminController extends AbstractController
{
    /**
     * @Route("/admin/car", name="admin_list_cars")
     */
    public function list(ListAllCars $query)
    {
        return $this->render('car_admin/list.html.twig', [
            'cars' => $query->findAllCars()
        ]);
    }

    /**
     * @Route("/admin/car/delete")
     */
    public function delete(Request $request, DeleteCar $query)
    {
        if(!$query->delete($request->request->get('carid'))) {
            return new JsonResponse('not found', 500);
        }

        return new JsonResponse('deleted', 200);
    }

    /**
     * @Route("/admin/car/new", name="admin_car_new")
     */
    public function new(Request $request, InsertCar $query)
    {
        $form = $this->createForm(CarFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $query->insert($form->getData(), $form['imageFile']->getData());

            $this->addFlash('success', 'Car Created!');

            return $this->redirectToRoute('admin_list_cars');
        }

        return $this->render('car_admin/new.html.twig', [
            'carForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/car/{id}/edit", name="admin_car_edit")
     */
    public function edit(Car $car, Request $request, UpdateCar $query)
    {
        $form = $this->createForm(CarFormType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $query->update($car, $form['imageFile']->getData());

            $this->addFlash('success', 'Car Updated!');

            return $this->redirectToRoute('admin_list_cars');
        }

        return $this->render('car_admin/edit.html.twig', [
            'carForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/car/country-select", name="admin_car_country_select")
     */
    public function getCitySelect(Request $request, CitySelect $query)
    {
        $form = $this->createForm(CarFormType::class, $query->setCountry($request->query->get('country')));

        if (!$form->has('city')) {
            return new Response(null, 204);
        }

        return $this->render('car_admin/city_name.html.twig', [
            'carForm' => $form->createView(),
        ]);
    }
}