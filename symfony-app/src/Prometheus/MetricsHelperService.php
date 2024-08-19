<?php

namespace App\Prometheus;

use Prometheus\CollectorRegistry;
use Prometheus\Counter;
use Prometheus\Exception\MetricNotFoundException;
use Prometheus\Gauge;
use Prometheus\Histogram;

class MetricsHelperService
{
    public function __construct(
        private readonly CollectorRegistry $registry,
    ) {
    }

    /**
     * @throws MetricNotFoundException
     */
    public function getSomeSpecificCounter(): Counter
    {
        return $this->registry->getCounter(
            'test',
            'some_counter',
        );
    }

    /**
     * @throws MetricNotFoundException
     */
    public function getSomeSpecificGauge(): Gauge
    {
        return $this->registry->getGauge(
            'test',
            'some_gauge',
        );
    }

    /**
     * @throws MetricNotFoundException
     */
    public function getSomeSpecificHistogram(): Histogram
    {
        return $this->registry->getHistogram(
            'test',
            'some_histogram',
        );
    }

    /**
     * @throws MetricNotFoundException
     */
    public function getRequestDurationHistogram(): Histogram
    {
        return $this->registry->getHistogram(
            'test',
            'request_duration',
        );
    }

    /**
     * @throws MetricNotFoundException
     */
    public function getResponseStatusCounter(): Counter
    {
        return $this->registry->getCounter(
            'test',
            'response_status_code',
        );
    }

    public function getRegistry(): CollectorRegistry
    {
        return $this->registry;
    }
}