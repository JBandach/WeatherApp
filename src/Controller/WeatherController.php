<?php

namespace App\Controller;

use App\Entity\Measurement;
use App\Entity\Location;
use App\Repository\LocationRepository;
use App\Repository\MeasurementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{
    #[Route('/weather/{country}/{city}', name: 'app_weather', requirements: ['id' => '\d+', 'country' => '^[A-Z]{2}', 'city' => '^[a-zA-Z]+$'])]
public function city(string $country, string $city, MeasurementRepository $measurementRepository, LocationRepository $locationRepository): Response
{
    $location = $locationRepository->findLocationByCodeAndCity($country, $city);

    $measurements = $measurementRepository->findByLocation($location);
    
    return $this->render('weather/city.html.twig', [
        'location' => $location,
        'measurements' => $measurements,
    ]);
}

}
