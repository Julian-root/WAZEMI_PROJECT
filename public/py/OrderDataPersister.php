<?php

namespace App\DataPersister;

use ApiPlatform\Core\Api\IriConverterInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Order;
use App\Entity\PromoCode;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class OrderDataPersister implements ContextAwareDataPersisterInterface
{

    public function recommendDrivers($client)
    {
        // making predictions
        $cmd = 'py/tp_uber_recommender/bin/python';
        $cmd = $cmd . ' ' . 'py/predict.py';

        $query = 'SELECT ' . $client->getId() . ' AS client_id,' . ' id AS driver_id FROM driver_profiles';
        // $filter = ''; // where

        $args = [
            '--database' => $_ENV['DATABASE_URL'],
            '--predictions-table' => 'client_driver_predicted_rates',
            '--sql-query' => $query,
            '--model' => 'py/model',
            '--users-col' => 'client_id',
            '--items-col' => 'driver_id',
            '--rates-col' => 'ratings'
        ];

        foreach ($args as $arg => $val) {
            $cmd = $cmd . ' ' . $arg . ' ' . $val;
        }
        exec($cmd, $output, $error);

        if ($error) {
            return new JsonResponse([
                'message' => 'An unexpected error occured'
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
