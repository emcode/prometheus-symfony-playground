<?php

namespace App\Controller;

use App\Prometheus\MetricsHelperService;
use Prometheus\Exception\MetricNotFoundException;
use Random\RandomException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SyntheticMeasurementsController extends AbstractController
{
    /**
     * @throws MetricNotFoundException
     * @throws RandomException
     */
    #[Route('/generate-measurements', name: 'app_generate_measurements')]
    public function respond(
        MetricsHelperService $metricsHelper,
    ): JsonResponse
    {
        $randomRequestDuration = random_int(1, 1000);
        $expectedStatusCodes = [ 200, 401, 404, 500 ];
        $randomStatusCode = $expectedStatusCodes[
            random_int(0, count($expectedStatusCodes) - 1)
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
