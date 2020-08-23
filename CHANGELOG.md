# Changelog

All notable changes to this project will be documented in this file.

[Next release](https://github.com/barryvdh/laravel-ide-helper/compare/v2.8.0...master)
--------------
### Added
- Support Laravel 8 [\#1022 / barryvdh](https://github.com/barryvdh/laravel-ide-helper/pull/1022)
- Add option to force usage of FQN [\#1031 / edvordo](https://github.com/barryvdh/laravel-ide-helper/pull/1031)
- Add support for macros of all macroable classes [\#1006 / domkrm](https://github.com/barryvdh/laravel-ide-helper/pull/1006)

2020-08-11, 2.8.0
-----------------
### Added
- Add static return type to builder methods [\#924 / dmason30](https://github.com/barryvdh/laravel-ide-helper/pull/924)
- Add `optonal` to meta generator for PhpStorm [\#932 / halaei](https://github.com/barryvdh/laravel-ide-helper/pull/932)
- Decimal columns as string in Models [\#948 / fgibaux](https://github.com/barryvdh/laravel-ide-helper/pull/948)
- Simplify full namespaces for already included resources [\#954 / LANGERGabriel](https://github.com/barryvdh/laravel-ide-helper/pull/954)
- Make writing relation count properties optional [\#969 / AegirLeet](https://github.com/barryvdh/laravel-ide-helper/pull/969)
- Add more methods able to resolve container instances [\#996 / mfn](https://github.com/barryvdh/laravel-ide-helper/pull/996)

### Fixed
- Test `auth` is bound before detect Auth driver [\#946 / zhwei](https://github.com/barryvdh/laravel-ide-helper/pull/946)
- Fix inline doc-block for final models [\#944 / Gummibeer](https://github.com/barryvdh/laravel-ide-helper/pull/955)

2020-04-22, 2.7.0
-----------------
### Added
- Add `ignored_models` as config option [\#890 / pataar](https://github.com/barryvdh/laravel-ide-helper/pull/890)
- Infer return type from reflection if no phpdoc given [\#906 / mfn](https://github.com/barryvdh/laravel-ide-helper/pull/906)
- Add custom collection support for get and all methods [\#903 / dmason30](https://github.com/barryvdh/laravel-ide-helper/pull/903)
- if a model implements interfaces, include them in the stub [\#920 / mr-feek](https://github.com/barryvdh/laravel-ide-helper/pull/920)
- Generate noinspections PHPStorm tags [\#905 / mzglinski](https://github.com/barryvdh/laravel-ide-helper/pull/905)
- Added support for Laravel 7 custom casts [\#913 / belamov](https://github.com/barryvdh/laravel-ide-helper/pull/913)
- Ability to use patterns for model_locations [\#921 / 4n70w4](https://github.com/barryvdh/laravel-ide-helper/pull/921)

### Fixed
- MorphToMany relations with query not working [\#894 / UksusoFF](https://github.com/barryvdh/laravel-ide-helper/pull/894)
- Fix camelCase duplicated properties generator [\#881 / bop10](https://github.com/barryvdh/laravel-ide-helper/pull/881)
- Prevent generation of invalid code for certain parameter default values [\#901 / loilo](https://github.com/barryvdh/laravel-ide-helper/pull/901)
- Make hasOne and morphOne nullable [\#864 / leo108](https://github.com/barryvdh/laravel-ide-helper/pull/864)
- Remove unnecessary and wrong definition of SoftDelete methods [\#918 / mfn](https://github.com/barryvdh/laravel-ide-helper/pull/918)
- Unregister meta command custom autoloader when it is no longer needed [\#919 / mr-feek](https://github.com/barryvdh/laravel-ide-helper/pull/919)

2020-02-25, 2.6.7
-----------------
### Added
- Support for Laravel 7 [commit by barryvdh](https://github.com/barryvdh/laravel-ide-helper/commit/edd69c5e0508972c81f1f7173236de2459c45814)

2019-12-02, 2.6.6
-----------------
### Added
- Add splat operator (...) support [\#860 / ngmy](https://github.com/barryvdh/laravel-ide-helper/pull/860)
- Add support for custom date class via Date::use() [\#859 / mfn](https://github.com/barryvdh/laravel-ide-helper/pull/859)

### Fixed
- Prevent undefined property errors [\#877 / matt-allan](https://github.com/barryvdh/laravel-ide-helper/pull/877)

----
Missing an older changelog? Feel free to submit a PR!
