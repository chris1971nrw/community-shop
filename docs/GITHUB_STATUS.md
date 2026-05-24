# 📊 GitHub Status Badges & Dashboard

## Overview

GitHub Status Badges für den Community Shop Projekt zeigen den aktuellen Projektstatus, Build-Status, Code-Qualität und Community-Metriken.

## Available Badges

### Core Status

#### Build Status
```markdown
[![GitHub Actions Status](https://img.shields.io/github/actions/workflow/status/chris1971nrw/community-shop/ci.yml?label=Build&logo=github&logoColor=white)](https://github.com/chris1971nrw/community-shop/actions)
```

#### License
```markdown
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
```

#### Version
```markdown
[![Version](https://img.shields.io/badge/version-0.2.0-dev-orange.svg)](CHANGELOG.md)
```

#### PHP Version
```markdown
[![PHP Version](https://img.shields.io/badge/PHP-8.3+-green.svg)](https://www.php.net/downloads)
```

### Code Quality

#### Code Coverage
```markdown
[![Code Coverage](https://img.shields.io/badge/code%20coverage-85%25-green.svg)](coverage.phpunit.x)
```

#### Test Status
```markdown
[![Tests](https://img.shields.io/badge/tests-passing-brightgreen.svg)](tests/)
```

#### Linting
```markdown
[![Linting](https://img.shields.io/badge/linting-clean-green.svg)](.)
```

### Community Metrics

#### Stars
```markdown
[![GitHub Stars](https://img.shields.io/github/stars/chris1971nrw/community-shop?style=social)](https://github.com/chris1971nrw/community-shop/stargazers)
```

#### Forks
```markdown
[![GitHub Forks](https://img.shields.io/github/forks/chris1971nrw/community-shop?style=social)](https://github.com/chris1971nrw/community-shop/network/members)
```

#### Watchers
```markdown
[![GitHub Watchers](https://img.shields.io/github/watchers/chris1971nrw/community-shop?style=social)](https://github.com/chris1971nrw/community-shop/watchers)
```

### Social Media

#### YouTube Video
```markdown
[![YouTube Video](https://img.shields.io/badge/YouTube-Watch%20Video-red?logo=youtube)](https://www.youtube.com/watch?v=pGYTQDRBVgk)
```

#### Twitter/X
```markdown
[![Twitter](https://img.shields.io/twitter/url?label=Follow&url=https%3A%2F%2Ftwitter.com%2Fchris1971nrw)](https://twitter.com/chris1971nrw)
```

### Project Health

#### Last Commit
```markdown
[![Last Commit](https://img.shields.io/github/last-commit/chris1971nrw/community-shop?logo=git)](https://github.com/chris1971nrw/community-shop/commits/main)
```

#### Issues Open
```markdown
[![Issues](https://img.shields.io/github/issues/chris1971nrw/community-shop?label=Open%20Issues)](https://github.com/chris1971nrw/community-shop/issues)
```

#### PRs Open
```markdown
[![PRs](https://img.shields.io/github/issues-pr/chris1971nrw/community-shop?label=Open%20PRs)](https://github.com/chris1971nrw/community-shop/pulls)
```

## Usage in README

Combine multiple badges in your GitHub README:

```markdown
# 🛒 Community Shop

[![Build](https://img.shields.io/github/actions/workflow/status/chris1971nrw/community-shop/ci.yml?label=Build&logo=github)](https://github.com/chris1971nrw/community-shop/actions)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
[![Version](https://img.shields.io/badge/version-0.2.0-dev-orange.svg)](CHANGELOG.md)
[![PHP](https://img.shields.io/badge/PHP-8.3+-green.svg)](https://www.php.net/downloads)
[![Tests](https://img.shields.io/badge/tests-passing-brightgreen.svg)](tests/)
[![Code Coverage](https://img.shields.io/badge/code%20coverage-85%25-green.svg)](coverage.phpunit.x)
[![YouTube](https://img.shields.io/badge/YouTube-Watch%20Video-red?logo=youtube)](https://www.youtube.com/watch?v=pGYTQDRBVgk)

## 🛍️ Features

- ✅ Produkt-Katalog (Amazon Links)
- ✅ Community Voting (👍 ⭐ 🛒)
- ✅ Preis-Monitoring
- ✅ RESTful API
- ✅ Open Source (MIT)
- ⏳ Score-Modell Entwicklung
- ⏳ Affiliate-Features
```

## Custom Badges

### Custom Build Status

```markdown
[![CI](https://github.com/chris1971nrw/community-shop/actions/workflows/ci.yml/badge.svg)](https://github.com/chris1971nrw/community-shop/actions)
```

### Release Badges

```markdown
[![Latest Release](https://img.shields.io/github/v/release/chris1971nrw/community-shop?include_prereleases)](https://github.com/chris1971nrw/community-shop/releases/latest)
```

### Download Badges

```markdown
[![Downloads](https://img.shields.io/github/downloads/chris1971nrw/community-shop/total)](https://github.com/chris1971nrw/community-shop/releases)
```

### GitHub Sponsors

```markdown
[![Sponsor](https://img.shields.io/badge/sponsor-GitHub%20Sponsors-orange.svg?logo=github)](https://github.com/sponsor/chris1971nrw)
```

## Badge Reference Table

| Badge | URL | Description |
|-------|-----|-------------|
| Build | `/actions/workflows/{name}.yml/badge.svg` | CI/CD Pipeline Status |
| License | `https://img.shields.io/badge/license-{type}-blue.svg` | License Type |
| Version | `https://img.shields.io/badge/version-{version}-orange.svg` | Project Version |
| PHP | `https://img.shields.io/badge/PHP-{version}-green.svg` | Required PHP Version |
| Tests | `https://img.shields.io/badge/tests-{status}-brightgreen.svg` | Test Results |
| Coverage | `https://img.shields.io/badge/code%20coverage-{percent}-green.svg` | Code Coverage % |
| GitHub Actions | `https://github.com/{user}/{repo}/actions/workflows/{name}.yml/badge.svg` | Specific Workflow Status |
| Releases | `https://img.shields.io/github/v/release/{user}/{repo}` | Latest Release |
| Downloads | `https://img.shields.io/github/downloads/{user}/{repo}/total` | Total Downloads |
| Issues | `https://img.shields.io/github/issues/{user}/{repo}` | Open Issues Count |
| PRs | `https://img.shields.io/github/issues-pr/{user}/{repo}` | Open PRs Count |
| Stars | `https://img.shields.io/github/stars/{user}/{repo}?style=social` | GitHub Stars (Social Style) |
| Forks | `https://img.shields.io/github/forks/{user}/{repo}?style=social` | GitHub Forks (Social Style) |
| Watchers | `https://img.shields.io/github/watchers/{user}/{repo}?style=social` | GitHub Watchers (Social Style) |
| Last Commit | `https://img.shields.io/github/last-commit/{user}/{repo}` | Last Commit Date |

## Maintenance

### Updating Badge Values

**Version Badge:** Update in `CHANGELOG.md` or create a release

**Build Status Badge:** GitHub Actions automatically updates

**Test Coverage Badge:** Manually update based on coverage.phpunit.xml

**Issue/PR Badge:** GitHub automatically updates

**YouTube Badge:** Update URL when new video is uploaded

### Best Practices

1. **Keep badges relevant**: Remove badges for discontinued features
2. **Use social-style badges for social metrics**: Stars, forks, watchers
3. **Link to relevant pages**: Badge links should point to detailed info
4. **Group related badges**: Build, test, and quality badges together
5. **Limit badge count**: Too many badges can clutter the README

## Contributing

Add new badges by:

1. Adding badge template to this documentation
2. Updating the reference table
3. Creating example usage in README

---

**Last Updated**: 2026-05-24  
**Badge Provider**: shields.io & GitHub Badges
