start:
  just up
  just sf-start

stop:
  just down
  just sf-stop

up:
  docker compose up -d
    
down:
  docker compose down
    
sf-start:
    symfony server:start --no-tls -d --allow-http --dir ./symfony-app
    
sf-logs:
    symfony server:log --dir ./symfony-app --no-app-logs 
    
sf-stop:
    symfony server:stop --dir ./symfony-app
    
logs:
  docker compose logs --follow
  
ps:
  docker compose ps
  
flush-redis:
  docker compose exec redis redis-cli FLUSHALL
  
info:
  @echo ""
  @echo "symfony app web ui: http://127.0.0.1:8000"
  @echo "prometheus web ui: http://127.0.0.1:9090"
  @echo "redis: http://127.0.0.1:6379"
  @echo ""

send-1-req-per-sec:
  cd ./req-per-sec && \
  npx loadtest \
    --rps=1 \
    --maxRequests=9999999 \
    --concurrency=1 \
    --cores=1 \
    --timeout=1000 \
    http://127.0.0.1:8000/generate-measurements

