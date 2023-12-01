<?php

namespace App\Controller;

use App\Prometheus\MetricsHelperService;
use Prometheus\RenderTextFormat;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MetricsController extends AbstractController
{
    #[Route('/metrics', name: 'app_metrics')]
    public function serveMetrics(
        MetricsHelperService $metricsHelper,
    ): Response
    {
        $statsRenderer = new RenderTextFormat();
        $statsPayload = $statsRenderer->render(
            $metricsHelper->getRegistry()->getMetricFamilySamples()
        );

        return new Response(
            $statsPayload,
            headers: [ 'Content-Type' => RenderTextFormat::MIME_TYPE, ],
        );
    }
}
