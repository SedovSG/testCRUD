.PHONY: setup help

setup: ## Выполнить миграции и заполнить таблицы фейковыми данными
	composer install
	vendor/bin/phinx migrate
	vendor/bin/phinx seed:run
	php -S localhost:8001

help: ## Информация по командам
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

.DEFAULT_GOAL := help