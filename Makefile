test:
	mkdir -p output
	rm -rf output/*
	SYMFONY_DEPRECATIONS_HELPER="weak" vendor/bin/simple-phpunit -c phpunit.xml.dist \
		--coverage-html output/coverage \
		--coverage-clover output/clover.xml \
		--log-junit output/junit.xml

lint:
	find -L ./src -name '*.php' -print0 | xargs -0 -n 1 -P 4 php -l
