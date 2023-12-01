<?php

namespace App\Controller;

use App\Prometheus\MetricsHelperService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GenerateStatsController extends AbstractController
{
    #[Route('/stats/counter/{value}', name: 'app_stats_counter')]
    public function updateCounter(
        MetricsHelperService $metricsHelper,
        float|int $value,
    ): JsonResponse
    {
        $counter = $metricsHelper->getSomeSpecificCounter();
        $counter->incBy($value, ['blue', 'another']);

        return new JsonResponse([
            'message' => "counter value increased by: $value",
        ]);
    }

    #[Route('/stats/gauge/{value}', name: 'app_stats_gauge')]
    public function updateGauge(
        MetricsHelperService $metricsHelper,
        float $value,
    ): JsonResponse
    {
        $gauge = $metricsHelper->getSomeSpecificGauge();
        $gauge->set($value, ['blue']);

        return new JsonResponse([
            'message' => "gauge value set to: $value",
        ]);
    }

    #[Route('/stats/histogram/{value}', name: 'app_stats_histogram')]
    public function updateHistogram(
        MetricsHelperService $metricsHelper,
        float $value,
    ): JsonResponse
    {
        $histogram = $metricsHelper->getSomeSpecificHistogram();
        $histogram->observe($value, ['blue']);

        return new JsonResponse([
            'message' => "histogram value $value observed",
        ]);
    }
}
