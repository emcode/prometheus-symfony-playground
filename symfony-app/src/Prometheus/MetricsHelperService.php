<?php

namespace App\Prometheus;

use PHPUnit\Framework\Constraint\Count;
use Prometheus\CollectorRegistry;
use Prometheus\Counter;
use Prometheus\Gauge;
use Prometheus\Histogram;

class MetricsHelperService
{
    public function __construct(
        private readonly CollectorRegistry $registry,
    ) {
    }

    public function getSomeSpecificCounter(): Counter
    {
        return $this->registry->getCounter(
            'test',
            'some_counter',
        );
    }

    public function getSomeSpecificGauge(): Gauge
    {
        return $this->registry->getGauge(
            'test',
            'some_gauge',
        );
    }

    public function getSomeSpecificHistogram(): Histogram
    {
        return $this->registry->getHistogram(
            'test',
            'some_histogram',
        );
    }

    public function getRequestDurationHistogram(): Histogram
    {
        return $this->registry->getHistogram(
            'test',
            'request_duration',
        );
    }

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