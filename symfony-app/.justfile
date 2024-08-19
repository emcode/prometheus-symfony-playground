up:
  ./bin/symfony server:start --no-tls -d --allow-http --dir .

logs:
  ./bin/symfony server:log --dir . --no-app-logs

down:
  ./bin/symfony server:stop --dir .

install:
  ./bin/composer install

info:
  @echo ""
  @echo "symfony app web ui: http://127.0.0.1:8000"
  @echo "prometheus web ui: http://127.0.0.1:9090"
  @echo "redis: http://127.0.0.1:6379"
  @echo ""

