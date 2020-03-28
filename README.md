# PHP Template

This is an **opinionated** project template that includes some repetitive and time consuming setups.

## Sources

Source folder `src` with a code file.

## Tests

Tests folder `tests` with a test file. Uses `phpunit` to execute tests.

> `composer test`

### Code coverage

Tests also generates coverage reports.

## Formatting

File formatter, that can automatically fix fix source files. Uses `php-cs-fixer` to format files.

> `composer format`.

## Style checks

Checks for files that doesn't conform with the project style rules. Uses `php-cs-fixer` to check files.

> `composer lint:php-cs-fixer`

## Static analysis

Static code analysis. Uses `phpstan` with `phpstan-strict-rules`.

> `composer lint:phpstan`

## Linter

Can run both style checks and static analysis.

> `composer lint`

## Code quality

Code quality analysis. Uses `phpinsights` for quality checks.

> `composer insights`

## Code metrics

Code metrics report with complexity, volume, maintainability and more. Uses `phpmetrics` to provide project metrics.

> `composer metrics`

## CI

Provides a GitHub workflow to run tests and linter. Caches composer dependencies, and uses `hirak/prestissimo` to speed up installations.

> `composer ci`

## Integrations

Provides basic configuration integration to [SonarCloud](https://sonarcloud.io) and [Coveralls](https://coveralls.io)
