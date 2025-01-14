# Changelog

## v3.5.4 - 2025-01-14

### What's Changed

* Convert auth() helper to use Auth facade by @barryvdh in https://github.com/barryvdh/laravel-ide-helper/pull/1656
* Check if returnType from docblock is not null by @barryvdh in https://github.com/barryvdh/laravel-ide-helper/pull/1658

**Full Changelog**: https://github.com/barryvdh/laravel-ide-helper/compare/v3.5.3...v3.5.4

## v3.5.3 - 2025-01-08

### What's Changed

* Catch meta, tweak auth by @barryvdh in https://github.com/barryvdh/laravel-ide-helper/pull/1654
* Check if macro is valid by @barryvdh in https://github.com/barryvdh/laravel-ide-helper/pull/1655
* feat: use generics of return type to determine resulting models by @Bloemendaal in https://github.com/barryvdh/laravel-ide-helper/pull/1653

### New Contributors

* @Bloemendaal made their first contribution in https://github.com/barryvdh/laravel-ide-helper/pull/1653

**Full Changelog**: https://github.com/barryvdh/laravel-ide-helper/compare/v3.5.2...v3.5.3

## v3.5.2 - 2025-01-06

### Fixes

Fix empty/anonymous closure in meta command.

**Full Changelog**: https://github.com/barryvdh/laravel-ide-helper/compare/v3.5.1...v3.5.2

## v3.5.1 - 2025-01-06

### What's Changed

* Remove duplicate config, fix ->can() by @barryvdh in https://github.com/barryvdh/laravel-ide-helper/pull/1650

**Full Changelog**: https://github.com/barryvdh/laravel-ide-helper/compare/v3.5.0...v3.5.1

## v3.5.0 - 2025-01-06

### What's Changed

* Add phpstorm meta argument hints by @barryvdh in https://github.com/barryvdh/laravel-ide-helper/pull/1640
* Add meta override for user return types by @barryvdh in https://github.com/barryvdh/laravel-ide-helper/pull/1642
* Use forked ContextFactory by @barryvdh in https://github.com/barryvdh/laravel-ide-helper/pull/1643
* Remove php parser by @barryvdh in https://github.com/barryvdh/laravel-ide-helper/pull/1644
* Also add eloquent template tags from base class by @barryvdh in https://github.com/barryvdh/laravel-ide-helper/pull/1645
* Add more metadata by @barryvdh in https://github.com/barryvdh/laravel-ide-helper/pull/1646
* Fixed generating PHPDoc for methods with class templates by @chack1172 in https://github.com/barryvdh/laravel-ide-helper/pull/1647
* Feat guess macro types by @barryvdh in https://github.com/barryvdh/laravel-ide-helper/pull/1648
* Allow adding custom Macroable classes. by @mathieutu in https://github.com/barryvdh/laravel-ide-helper/pull/1629
* Add special `dev` to composer keywords by @jnoordsij in https://github.com/barryvdh/laravel-ide-helper/pull/1649

### New Contributors

* @chack1172 made their first contribution in https://github.com/barryvdh/laravel-ide-helper/pull/1647
* @mathieutu made their first contribution in https://github.com/barryvdh/laravel-ide-helper/pull/1629
* @jnoordsij made their first contribution in https://github.com/barryvdh/laravel-ide-helper/pull/1649

**Full Changelog**: https://github.com/barryvdh/laravel-ide-helper/compare/v3.4.0...v3.5.0

## v3.4.0 - 2024-12-29

### What's Changed

* fix: add @template TModel of static for Eloquent by @imzyf in https://github.com/barryvdh/laravel-ide-helper/pull/1631
* Add templates to Eloquent by @barryvdh in https://github.com/barryvdh/laravel-ide-helper/pull/1634
* Update testsuite for Generator, simplify service provider and mock by @barryvdh in https://github.com/barryvdh/laravel-ide-helper/pull/1635
* Add option for only eloquent by @barryvdh in https://github.com/barryvdh/laravel-ide-helper/pull/1636
* Add weak generics for array type objects by @LauJosefsen in https://github.com/barryvdh/laravel-ide-helper/pull/1621
* Make all "note" in README apply quote style by @hms5232 in https://github.com/barryvdh/laravel-ide-helper/pull/1590
* Update README.md by @Mtillmann in https://github.com/barryvdh/laravel-ide-helper/pull/1587
* Rename view var  by @barryvdh and @pb30 in https://github.com/barryvdh/laravel-ide-helper/pull/1637 and https://github.com/barryvdh/laravel-ide-helper/pull/1563
* Format IDE helper by @barryvdh in https://github.com/barryvdh/laravel-ide-helper/pull/1638
* Add TLDR section, update options by @barryvdh in https://github.com/barryvdh/laravel-ide-helper/pull/1639

### New Contributors

* @imzyf made their first contribution in https://github.com/barryvdh/laravel-ide-helper/pull/1631
* @LauJosefsen made their first contribution in https://github.com/barryvdh/laravel-ide-helper/pull/1621
* @hms5232 made their first contribution in https://github.com/barryvdh/laravel-ide-helper/pull/1590
* @Mtillmann made their first contribution in https://github.com/barryvdh/laravel-ide-helper/pull/1587
* @pb30 made their first contribution in https://github.com/barryvdh/laravel-ide-helper/pull/1563

**Full Changelog**: https://github.com/barryvdh/laravel-ide-helper/compare/v3.3.0...v3.4.0

## v3.3.0 - 2024-12-18

### What's Changed

* Feature: Add Config Option to Enforce Nullable Relationships by @jeramyhing in https://github.com/barryvdh/laravel-ide-helper/pull/1580
* Improve replacement of return type for methods from Query\Builder by @pjio in https://github.com/barryvdh/laravel-ide-helper/pull/1575
* Update CHANGELOG.md, fix typo(s) by @NicholasWilsonDEV in https://github.com/barryvdh/laravel-ide-helper/pull/1613
* Fixed PHP 8.4 deprecation warning by @eusonlito in https://github.com/barryvdh/laravel-ide-helper/pull/1622
* Fix PHP 8.4 deprecations by @JeppeKnockaert in https://github.com/barryvdh/laravel-ide-helper/pull/1618
* Assign $output method parameter to $this->output on Generator by @eusonlito in https://github.com/barryvdh/laravel-ide-helper/pull/1623

### New Contributors

* @jeramyhing made their first contribution in https://github.com/barryvdh/laravel-ide-helper/pull/1580
* @pjio made their first contribution in https://github.com/barryvdh/laravel-ide-helper/pull/1575
* @NicholasWilsonDEV made their first contribution in https://github.com/barryvdh/laravel-ide-helper/pull/1613
* @eusonlito made their first contribution in https://github.com/barryvdh/laravel-ide-helper/pull/1622

**Full Changelog**: https://github.com/barryvdh/laravel-ide-helper/compare/v3.2.2...v3.3.0

## v3.2.2 - 2024-10-29

### What’s Changed

* fix(pivot): only use unique classes in the pivot union (Fixes #1606) (#1607) @pataar
* docs(pr): remove the changelog checklist item (#1608) @pataar
* Create update-changelog.yaml (#1605) @barryvdh

**Full Changelog**: https://github.com/barryvdh/laravel-ide-helper/compare/v3.2.1...v3.2.2

## 3.2.1 - 2024-10-28

### What's Changed

* chore: Fix the description of unused option by @KentarouTakeda in https://github.com/barryvdh/laravel-ide-helper/pull/1600
* feat(pivot): add support for multiple pivot types when using the same accessor by @pataar in https://github.com/barryvdh/laravel-ide-helper/pull/1597
* Add support for `AsCollection::using` and `AsEnumCollection::of` casts by @uno-sw in https://github.com/barryvdh/laravel-ide-helper/pull/1577
* Smarter reset by @barryvdh in https://github.com/barryvdh/laravel-ide-helper/pull/1603
* feat: use `numeric` type on fields with `decimal` casts by @ekisu in https://github.com/barryvdh/laravel-ide-helper/pull/1583

### New Contributors

* @uno-sw made their first contribution in https://github.com/barryvdh/laravel-ide-helper/pull/1577
* @ekisu made their first contribution in https://github.com/barryvdh/laravel-ide-helper/pull/1583

**Full Changelog**: https://github.com/barryvdh/laravel-ide-helper/compare/v3.2.0...v3.2.1

## 3.2.0 - 2024-10-18

### Fixed

- Fix type of hashed model property to `string`

### Changed

- Update view "version" variable name to avoid potential conflicts
  
- Add support for EloquentBuilder generics introduced in Laravel 11.15.
  
- Drop support for Laravel versions earlier than 11.15.
  

### Added

- Introduce `enforce_nullable_relationships` configuration option to control how nullable Eloquent relationships are enforced during static analysis. This provides flexibility for scenarios where application logic ensures data integrity without relying on database constraints. [#1580 / jeramyhing](https://github.com/barryvdh/laravel-ide-helper/pull/1580)
  
- Add support for AsCollection::using and AsEnumCollection::of casts [#1577 / uno-sw](https://github.com/barryvdh/laravel-ide-helper/pull/1577)
  

## 3.1.0 - 2024-07-12

### Fixed

- Fix return value of query scopes from parent class [#1366 / sforward](https://github.com/barryvdh/laravel-ide-helper/pull/1366)
- Add static to isBuiltin() check in ide-helper:models [#1541 / bram-pkg](https://github.com/barryvdh/laravel-ide-helper/pull/1541)
- Fix for getSomethingAttribute functions which return a collection with type templating in the phpDoc. [#1567 / stefanScrumble](https://github.com/barryvdh/laravel-ide-helper/pull/1567)

### Added

- Add type to pivot when using a custom pivot class [#1518 / d3v2a](https://github.com/barryvdh/laravel-ide-helper/pull/1518)
- Add support in morphTo relationship for null values [#1547 / matysekmichal](https://github.com/barryvdh/laravel-ide-helper/pull/1547)
- Add support for AsEnumCollection casts [#1557 / Braunson](https://github.com/barryvdh/laravel-ide-helper/pull/1557)
- Support for Attribute class in attributes [#1567 / stefanScrumble](https://github.com/barryvdh/laravel-ide-helper/pull/1567)

## 3.0.0 - 2024-03-01

### Added

- Support for Laravel 11 [#1520 / KentarouTakeda](https://github.com/barryvdh/laravel-ide-helper/pull/1520)

### Changed

- Make `--reset` always keep the text and remove `--smart-reset`. Always skip the classname [#1523 / barryvdh](https://github.com/barryvdh/laravel-ide-helper/pull/1523) & [#1525 / mfn](https://github.com/barryvdh/laravel-ide-helper/pull/1525)
- Use short types (`int` and `bool` instead of `integer` and `boolean`) [#1524 / barryvdh](https://github.com/barryvdh/laravel-ide-helper/pull/1524)

### Removed

- Support for Laravel 9 and use of doctrine/dbal [#1512 / barryvdh](https://github.com/barryvdh/laravel-ide-helper/pull/1512)
  With this functionality gone, a few changes have been made:
  - support for custom datatypes has been dropped (config `custom_db_types`) unknown data types default to `string` now and to fix the type, add a proper cast in Eloquent
  - You *might* have top-level dependency on doctrine/dbal. This may have been in the past due to ide-helper, we suggest to check if you still need it and remove it otherwise
  - Minimum PHP version, due to Laravel 10, is now PHP 8.1
  

## 2024-02-15, 2.15.1

### Fixed

- Fix final class keyword in wrong position [#1517 / barryvdh](https://github.com/barryvdh/laravel-ide-helper/pull/1517)

### Changed

### Added

## 2024-02-14, 2.15.0

### Fixed

- Fix case issue in `ModelsCommand::unsetMethod()` [#1453 / leo108](https://github.com/barryvdh/laravel-ide-helper/pull/1453)
- Fix non-facade classes will result in no autocomplete [#841 / netpok](https://github.com/barryvdh/laravel-ide-helper/pull/841)
- Skip swoole, otherwise fatal error [#1477 / TimoFrenzel](https://github.com/barryvdh/laravel-ide-helper/pull/1477)
- Fix vulnerability CVE-2021-43608 [#1392 / allanlaal](https://github.com/barryvdh/laravel-ide-helper/pull/1392)
- Reset foreignKeyConstraintsColumns on model loop start [#1461 / snmatsui](https://github.com/barryvdh/laravel-ide-helper/pull/1461)
- Accept scope & scopes as relation [#1452 / Muetze42](https://github.com/barryvdh/laravel-ide-helper/pull/1452)
- Fix #1300 relation_return_type must take precedence if it is defined [#1394 / menthol](https://github.com/barryvdh/laravel-ide-helper/pull/1394)

### Changed

- Disable inspections of helper files [#1486 / eidng8](https://github.com/barryvdh/laravel-ide-helper/pull/1486)
- Removed support for Laravel 8 and therefore for PHP < 8.0 [#1504 / mfn](https://github.com/barryvdh/laravel-ide-helper/pull/1504)

### Added

- Add support for enum default arguments using enum cases. [#1464 / d8vjork](https://github.com/barryvdh/laravel-ide-helper/pull/1464)
- Add support for real-time facades in the helper file. [#1455 / filipac](https://github.com/barryvdh/laravel-ide-helper/pull/1455)
- Add support for relations with composite keys. [#1479 / calebdw](https://github.com/barryvdh/laravel-ide-helper/pull/1479)
- Add support for attribute accessors with no backing field or type hinting [#1411 / pindab0ter](https://github.com/barryvdh/laravel-ide-helper/pull/1411).
- Add support for AsCollection and AsArrayObject casts [#1393 / pataar](https://github.com/barryvdh/laravel-ide-helper/pull/1393)
- Reintroduce support for multi-db setups [#1426 / benpoulson](https://github.com/barryvdh/laravel-ide-helper/pull/1426)
- Support the BINARY(...) database field type [#1434 / Sfonxs](https://github.com/barryvdh/laravel-ide-helper/pull/1434)
- Add AllowDynamicProperties Attribute to cooperate with php8.2 deprecation [#1428 / GeoSot](https://github.com/barryvdh/laravel-ide-helper/pull/1428)

## 2024-02-05, 2.14.0

### Changed

- Official support for Lumen has been dropped [#1425 / mfn](https://github.com/barryvdh/laravel-ide-helper/pull/1425)
- Refactor resolving of null information for custom casted attribute types [#1330 / wimski](https://github.com/barryvdh/laravel-ide-helper/pull/1330)

### Fixed

- Catch exceptions when loading aliases [#1465 / dongm2ez](https://github.com/barryvdh/laravel-ide-helper/pull/1465)

### Added

- Add support for nikic/php-parser 5 (next to 4) [#1502 / mfn](https://github.com/barryvdh/laravel-ide-helper/pull/1502)
- Add support for `immutable_date:*` and `immutable_datetime:*` casts. [#1380 / thekonz](https://github.com/barryvdh/laravel-ide-helper/pull/1380)
- Add support for attribute accessors marked as protected. [#1339 / pindab0ter](https://github.com/barryvdh/laravel-ide-helper/pull/1339)

## 2023-02-04, 2.13.0

### Fixed

- Fix return type of methods provided by `SoftDeletes` [#1345 / KentarouTakeda](https://github.com/barryvdh/laravel-ide-helper/pull/1345)
- Handle PHP 8.1 deprecation warnings when passing `null` to `new \ReflectionClass` [#1351 / mfn](https://github.com/barryvdh/laravel-ide-helper/pull/1351)
- Fix issue where \Eloquent is not included when using write_mixin [#1352 / Jefemy](https://github.com/barryvdh/laravel-ide-helper/pull/1352)
- Fix model factory method arguments for Laravel >= 9 [#1361 / wimski](https://github.com/barryvdh/laravel-ide-helper/pull/1361)
- Improve return type of mock helper methods in tests [#1405 / bentleyo](https://github.com/barryvdh/laravel-ide-helper/pull/1405)
- Fix Castable class if failed to detect it from return types [#1388 / kwarcu](https://github.com/barryvdh/laravel-ide-helper/pull/1388)

### Added

- Added Laravel 10 support [#1407 / lptn](https://github.com/barryvdh/laravel-ide-helper/pull/1407)
- Add support for custom casts that implement `CastsInboundAttributes` [#1329 / sforward](https://github.com/barryvdh/laravel-ide-helper/pull/1329)
- Add option `use_generics_annotations` for collection type hints [#1298 / tanerkay](https://github.com/barryvdh/laravel-ide-helper/pull/1298)

## 2022-03-06, 2.12.3

### Fixed

- Fix date and datetime handling for attributes that set a serialization format option for the Carbon instance [#1324 / FLeudts](https://github.com/barryvdh/laravel-ide-helper/pull/1324)
- Fix composer conflict with composer/pcre version 2/3. [#1327 / barryvdh](https://github.com/barryvdh/laravel-ide-helper/pull/1327)

## 2022-02-08, 2.12.2

### Fixed

- Remove composer dependency, use copy of ClassMapGenerator [#1313 / barryvdh](https://github.com/barryvdh/laravel-ide-helper/pull/1313)

## 2022-01-24, 2.12.1

### Fixed

- Properly handle `Castable`s without return type. [#1306 / binotaliu](https://github.com/barryvdh/laravel-ide-helper/pull/1306)

## 2022-01-23, 2.12.0

### Added

- Add support for custom casts that using `Castable` [#1287 / binotaliu](https://github.com/barryvdh/laravel-ide-helper/pull/1287)
- Added Laravel 9 support [#1297 / rcerljenko](https://github.com/barryvdh/laravel-ide-helper/pull/1297)
- Added option `additional_relation_return_types` for custom relations that don't fit the typical naming scheme

## 2022-01-03, 2.11.0

### Added

- Add support for Laravel 8.77 Attributes [#1289 / SimonJnsson](https://github.com/barryvdh/laravel-ide-helper/pull/1289)
- Add support for cast types `decimal:*`, `encrypted:*`, `immutable_date`, `immutable_datetime`, `custom_datetime`, and `immutable_custom_datetime` [#1262 / miken32](https://github.com/barryvdh/laravel-ide-helper/pull/1262)
- Add support of variadic parameters in `ide-helper:models` [#1234 / shaffe-fr](https://github.com/barryvdh/laravel-ide-helper/pull/1234)
- Add support of custom casts without properties [#1267 / sparclex](https://github.com/barryvdh/laravel-ide-helper/pull/1267)

### Fixed

- Fix recursively searching for `HasFactory` and `Macroable` traits [#1216 / daniel-de-wit](https://github.com/barryvdh/laravel-ide-helper/pull/1216)
- Use platformName to determine db type when casting boolean types [#1212 / stockalexander](https://github.com/barryvdh/laravel-ide-helper/pull/1212)

### Changed

- Move default models helper filename to config [#1241 / wimski](https://github.com/barryvdh/laravel-ide-helper/pull/1241)

## 2021-06-18, 2.10.1

### Added

- Added Type registration according to [Custom Mapping Types documentation](https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/types.html#custom-mapping-types) [#1228 / wimski](https://github.com/barryvdh/laravel-ide-helper/pull/1241)

### Fixed

- Fixing issue where configured custom_db_types could cause a DBAL exception to be thrown while running `ide-helper:models` [#1228 / wimski](https://github.com/barryvdh/laravel-ide-helper/pull/1241)

## 2021-04-09, 2.10.0

### Added

- Allowing Methods to be set or unset in ModelHooks [#1198 / jenga201](https://github.com/barryvdh/laravel-ide-helper/pull/1198)
  Note: the visibility of `\Barryvdh\LaravelIdeHelper\Console\ModelsCommand::setMethod` has been changed to **public**!

### Fixed

- Fixing issue where incorrect autoloader unregistered [#1210 / tezhm](https://github.com/barryvdh/laravel-ide-helper/pull/1210)

## 2021-04-02, 2.9.3

### Fixed

- Support both customized namespace factories as well as default resolvable ones [#1201 / wimski](https://github.com/barryvdh/laravel-ide-helper/pull/1201)

## 2021-04-01, 2.9.2

### Added

- Model hooks for adding custom information from external sources to model classes through the ModelsCommand [#945 / wimski](https://github.com/barryvdh/laravel-ide-helper/pull/945)

### Fixed

- Fix ide-helper:models exception if model doesn't have factory [#1196 / ahmed-aliraqi](https://github.com/barryvdh/laravel-ide-helper/pull/1196)
- Running tests triggering post_migrate hooks [#1193 / netpok](https://github.com/barryvdh/laravel-ide-helper/pull/1193)
- Array_merge error when config is cached prior to package install [#1184 / netpok](https://github.com/barryvdh/laravel-ide-helper/pull/1184)

## 2021-03-15, 2.9.1

### Added

- Generate PHPDoc for Laravel 8.x factories [#1074 / ahmed-aliraqi](https://github.com/barryvdh/laravel-ide-helper/pull/1074)
- Add a comment to a property like table columns [#1168 / biiiiiigmonster](https://github.com/barryvdh/laravel-ide-helper/pull/1168)
- Added `post_migrate` hook to run commands after a migration [#1163 / netpok](https://github.com/barryvdh/laravel-ide-helper/pull/1163)
- Allow for PhpDoc for macros with union types [#1148 / riesjart](https://github.com/barryvdh/laravel-ide-helper/pull/1148)

### Fixed

- Error when generating helper for invokable classes [#1124 / standaniels](https://github.com/barryvdh/laravel-ide-helper/pull/1124)
- Fix broken ReflectionUnionTypes [#1132 / def-studio](https://github.com/barryvdh/laravel-ide-helper/pull/1132)
- Relative class names are not converted to fully-qualified class names [#1005 / SavKS](https://github.com/barryvdh/laravel-ide-helper/pull/1005)

## 2020-12-30, 2.9.0

### Changed

- Dropped support for Laravel 6 and Laravel 7, as well as support for PHP 7.2 and added support for doctrine/dbal:^3 [#1114 / mfn](https://github.com/barryvdh/laravel-ide-helper/pull/1114)

### Fixed

- `Macro::initPhpDoc()` will save original docblock if present [#1116 / LastDragon-ru](https://github.com/barryvdh/laravel-ide-helper/pull/1116)
- `Alias` will grab macros from `\Illuminate\Database\Eloquent\Builder` too [#1118 / LastDragon-ru](https://github.com/barryvdh/laravel-ide-helper/pull/1118)

## 2020-12-08, 2.8.2

### Added

- Fix phpdoc generate for custom cast with parameter [#986 / artelkr](https://github.com/barryvdh/laravel-ide-helper/pull/986)
- Created a possibility to add custom relation type [#987 / efinder2](https://github.com/barryvdh/laravel-ide-helper/pull/987)
- Added `@see` with macro/mixin definition location to PhpDoc [#1054 / riesjart](https://github.com/barryvdh/laravel-ide-helper/pull/1054)
- Initial compatibility for PHP8 [#1106 / mfn](https://github.com/barryvdh/laravel-ide-helper/pull/1106)

### Changed

- Implement DeferrableProvider [#914 / kon-shou](https://github.com/barryvdh/laravel-ide-helper/pull/914)

### Fixed

- Compatibility with Lumen [#1043 / mfn](https://github.com/barryvdh/laravel-ide-helper/pull/1043)
- Allow model_locations to have glob patterns [#1059 / saackearl](https://github.com/barryvdh/laravel-ide-helper/pull/1059)
- Error when generating helper for macroable classes which are not facades and contain a "fake" method [#1066 / domkrm] (https://github.com/barryvdh/laravel-ide-helper/pull/1066)
- Casts with a return type of `static` or `$this` now resolve to an instance of the cast [#1103 / riesjart](https://github.com/barryvdh/laravel-ide-helper/pull/1103)

### Removed

- Removed format and broken generateJsonHelper [#1053 / mfn](https://github.com/barryvdh/laravel-ide-helper/pull/1053)

## 2020-09-07, 2.8.1

### Added

- Support Laravel 8 [#1022 / barryvdh](https://github.com/barryvdh/laravel-ide-helper/pull/1022)
- Add option to force usage of FQN [#1031 / edvordo](https://github.com/barryvdh/laravel-ide-helper/pull/1031)
- Add support for macros of all macroable classes [#1006 / domkrm](https://github.com/barryvdh/laravel-ide-helper/pull/1006)

## 2020-08-11, 2.8.0

### Added

- Add static return type to builder methods [#924 / dmason30](https://github.com/barryvdh/laravel-ide-helper/pull/924)
- Add `optional` to meta generator for PhpStorm [#932 / halaei](https://github.com/barryvdh/laravel-ide-helper/pull/932)
- Decimal columns as string in Models [#948 / fgibaux](https://github.com/barryvdh/laravel-ide-helper/pull/948)
- Simplify full namespaces for already included resources [#954 / LANGERGabriel](https://github.com/barryvdh/laravel-ide-helper/pull/954)
- Make writing relation count properties optional [#969 / AegirLeet](https://github.com/barryvdh/laravel-ide-helper/pull/969)
- Add more methods able to resolve container instances [#996 / mfn](https://github.com/barryvdh/laravel-ide-helper/pull/996)

### Fixed

- Test `auth` is bound before detect Auth driver [#946 / zhwei](https://github.com/barryvdh/laravel-ide-helper/pull/946)
- Fix inline doc-block for final models [#944 / Gummibeer](https://github.com/barryvdh/laravel-ide-helper/pull/955)

## 2020-04-22, 2.7.0

### Added

- Add `ignored_models` as config option [#890 / pataar](https://github.com/barryvdh/laravel-ide-helper/pull/890)
- Infer return type from reflection if no phpdoc given [#906 / mfn](https://github.com/barryvdh/laravel-ide-helper/pull/906)
- Add custom collection support for get and all methods [#903 / dmason30](https://github.com/barryvdh/laravel-ide-helper/pull/903)
- if a model implements interfaces, include them in the stub [#920 / mr-feek](https://github.com/barryvdh/laravel-ide-helper/pull/920)
- Generate noinspections PHPStorm tags [#905 / mzglinski](https://github.com/barryvdh/laravel-ide-helper/pull/905)
- Added support for Laravel 7 custom casts [#913 / belamov](https://github.com/barryvdh/laravel-ide-helper/pull/913)
- Ability to use patterns for model_locations [#921 / 4n70w4](https://github.com/barryvdh/laravel-ide-helper/pull/921)

### Fixed

- MorphToMany relations with query not working [#894 / UksusoFF](https://github.com/barryvdh/laravel-ide-helper/pull/894)
- Fix camelCase duplicated properties generator [#881 / bop10](https://github.com/barryvdh/laravel-ide-helper/pull/881)
- Prevent generation of invalid code for certain parameter default values [#901 / loilo](https://github.com/barryvdh/laravel-ide-helper/pull/901)
- Make hasOne and morphOne nullable [#864 / leo108](https://github.com/barryvdh/laravel-ide-helper/pull/864)
- Remove unnecessary and wrong definition of SoftDelete methods [#918 / mfn](https://github.com/barryvdh/laravel-ide-helper/pull/918)
- Unregister meta command custom autoloader when it is no longer needed [#919 / mr-feek](https://github.com/barryvdh/laravel-ide-helper/pull/919)

## 2020-02-25, 2.6.7

### Added

- Support for Laravel 7 [commit by barryvdh](https://github.com/barryvdh/laravel-ide-helper/commit/edd69c5e0508972c81f1f7173236de2459c45814)

## 2019-12-02, 2.6.6

### Added

- Add splat operator (...) support [#860 / ngmy](https://github.com/barryvdh/laravel-ide-helper/pull/860)
- Add support for custom date class via Date::use() [#859 / mfn](https://github.com/barryvdh/laravel-ide-helper/pull/859)

### Fixed

- Prevent undefined property errors [#877 / matt-allan](https://github.com/barryvdh/laravel-ide-helper/pull/877)


---

Missing an older changelog? Feel free to submit a PR!
