<?php

namespace App\Controller;

use App\Prometheus\MetricsHelperService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SyntheticMeasurementsController extends AbstractController
{
    #[Route('/generate-measurements', name: 'app_generate_measurements')]
    public function respond(
        MetricsHelperService $metricsHelper,
    ): JsonResponse
    {
        $randomRequestDuration = mt_rand(1, 1000);
        $expectedStatusCodes = [ 200, 401, 404, 500 ];
        $randomStatusCode = $expectedStatusCodes[
            mt_rand(0, count($expectedStatusCodes) - 1)
        ];

        $metricsHelper
            ->getRequestDurationHistogram()
            ->observe($randomRequestDuration / 1000);

        $metricsHelper
            ->getResponseStatusCounter()
            ->incBy(1, [$randomStatusCode]);

        return new JsonResponse([
            'message' => sprintf(
                'Duration %sms and status: %s',
                $randomRequestDuration,
                $randomStatusCode,
            )
        ]);
    }
}
