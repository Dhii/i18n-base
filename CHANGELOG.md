# Change log
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [0.2] - 2017-08-14
### Fixed
- Exception factories accepting translator instance, but impossible to acquire it in abstract layer.
- Missing support for `StringableInterface`.

### Changed
- `AbstractBaseFormatTranslator` now implements `FormatTranslatorInterface`.

## [0.1] - 2017-03-14
Initial release. Classes and tests included.
