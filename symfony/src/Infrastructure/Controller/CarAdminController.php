<?php

namespace App\Infrastructure\Controller;

use App\Application\Command\DeleteCarCommand;
use App\Application\Command\CreateCarCommand;
use App\Application\Command\UpdateCarCommand;
use App\Domain\Photo\PhotoManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Infrastructure\Form\CarFormType;
use Symfony\Component\HttpFoundation\Response;
use App\Application\UseCases\Car\CitySelect;
use App\Domain\Model\Car;
use App\Application\Query\ListAllCarsQuery;

class CarAdminController extends CustomAbstractController
{
    /**
     * @Route("/admin/car", name="admin_list_cars")
     */
    public function list()
    {
        $command = new ListAllCarsQuery();

        return $this->render('car_admin/list.html.twig', [
            'cars' => $this->handleMessage($command)
        ]);
    }

    /**
     * @Route("/admin/car/delete")
     */
    public function delete(Request $request)
    {
        $command = new DeleteCarCommand($request->request->get('carid'));

        try {
            $this->handleMessage($command);

            return new JsonResponse('deleted', 200);
        } catch (\Exception $e) {
            return new JsonResponse('car not found', 500);
        }
    }

    /**
     * @Route("/admin/car/new", name="admin_car_new")
     */
    public function new(Request $request, PhotoManager $photoManager)
    {
        $form = $this->createForm(CarFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form['imageFile']->getData();
            $imageName = $image === null ? '' : $photoManager->uploadArticleImage($image, null);
            $enabled = isset($request->request->get('car_form')['enabled']) ? 1 : 0;

            $command = new CreateCarCommand(
                $request->request->get('car_form')['mark'],
                $request->request->get('car_form')['model'],
                $request->request->get('car_form')['country'],
                $request->request->get('car_form')['city'],
                $request->request->get('car_form')['description'],
                $request->request->get('car_form')['year'],
                $enabled,
                $imageName
            );

            $this->handleMessage($command);

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
    public function edit(Car $car, Request $request, PhotoManager $photoManager)
    {
        $form = $this->createForm(CarFormType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $oldImage = $car->getImageFilename();
            $image = $form['imageFile']->getData();
            $imageName = $image === null ? '' : $photoManager->uploadArticleImage($image, $oldImage);
            $enabled = isset($request->request->get('car_form')['enabled']) ? 1 : 0;

            $command = new UpdateCarCommand(
                $car->getId(),
                $request->request->get('car_form')['mark'],
                $request->request->get('car_form')['model'],
                $request->request->get('car_form')['country'],
                $request->request->get('car_form')['city'],
                $request->request->get('car_form')['description'],
                $request->request->get('car_form')['year'],
                $enabled,
                $imageName
            );

            $this->handleMessage($command);

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