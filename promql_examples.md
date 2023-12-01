
```promql
test_some_counter
test_some_gauge
test_some_histogram_bucket{le="300"}
```

rate() calculates the per-second average rate
of increase of the time series in the range vector.

The following example expression returns
the per-second rate of HTTP requests as measured
over the last 5 minutes, per time series
in the range vector:

```promql
rate(test_request_duration_count[5m])
rate(test_response_status_code{status_code="401"}[30s])
```

Histograms

They track the number of observations
and the sum of the observed values,
allowing you to calculate the average 
of the observed values.


To calculate the 90th percentile of request durations
over the last 10m, use the following expression:

```promql
histogram_quantile(0.90, rate(test_request_duration_bucket[1m]))
```

To calculate the average request duration
during the last 1 minute from a histogram,
use the following expression:

```promql
rate(test_request_duration_sum[1m])
/
rate(test_request_duration_count[1m])
```
