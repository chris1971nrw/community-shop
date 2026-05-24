# 📧 Newsletter Template für Community Shop

## Overview

Dieses Template zeigt, wie du einen Newsletter für den Community Shop erstellst.

---

## 📧 Weekly Digest

### HTML Template

```html
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Shop Weekly Digest</title>
</head>
<body>
    <div style="max-width: 600px; margin: 0 auto; font-family: Arial, sans-serif;">
        <!-- Header -->
        <div style="background: #2563eb; color: white; padding: 20px; text-align: center;">
            <h1>🛒 Community Shop</h1>
            <p>Weekly Digest - {{DATE}}</p>
        </div>
        
        <!-- Content -->
        <div style="padding: 20px;">
            <h2>📊 Diese Woche im Überblick</h2>
            
            <div style="margin-bottom: 20px;">
                <h3>🔥 Top Produkte</h3>
                
                <div style="background: #f5f5f5; padding: 15px; margin-bottom: 10px;">
                    <h4>{{PRODUCT_1}}</h4>
                    <p>Score: {{SCORE_1}}</p>
                    <a href="{{PRODUCT_1_URL}}" style="color: #2563eb;">🛒 Kaufen</a>
                </div>
                
                <div style="background: #f5f5f5; padding: 15px; margin-bottom: 10px;">
                    <h4>{{PRODUCT_2}}</h4>
                    <p>Score: {{SCORE_2}}</p>
                    <a href="{{PRODUCT_2_URL}}" style="color: #2563eb;">🛒 Kaufen</a>
                </div>
            </div>
            
            <h2>🚀 Neue Features</h2>
            <p>{{NEW_FEATURE}}</p>
            
            <h2>📝 Blog-Updates</h2>
            <ul>
                <li><a href="{{BLOG_1_URL}}">{{BLOG_1_TITLE}}</a></li>
                <li><a href="{{BLOG_2_URL}}">{{BLOG_2_TITLE}}</a></li>
            </ul>
            
            <h2>👥 Community</h2>
            <p>{{COMMUNITY_UPDATE}}</p>
        </div>
        
        <!-- Footer -->
        <div style="background: #f5f5f5; padding: 20px; text-align: center;">
            <p>Community Shop | Made with ❤️</p>
            <p>Unsubscribe | Settings</p>
        </div>
    </div>
</body>
</html>
```

---

## 📧 Feature Release

### HTML Template

```html
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feature Release: {{FEATURE_NAME}}</title>
</head>
<body>
    <div style="max-width: 600px; margin: 0 auto; font-family: Arial, sans-serif;">
        <!-- Header -->
        <div style="background: #2563eb; color: white; padding: 20px; text-align: center;">
            <h1>🚀 New Feature: {{FEATURE_NAME}}</h1>
        </div>
        
        <!-- Content -->
        <div style="padding: 20px;">
            <h2>✨ Was ist neu?</h2>
            <p>{{FEATURE_DESCRIPTION}}</p>
            
            <h3>🎯 Use Cases</h3>
            <ul>
                <li>{{USE_CASE_1}}</li>
                <li>{{USE_CASE_2}}</li>
                <li>{{USE_CASE_3}}</li>
            </ul>
            
            <h3>📋 Installation</h3>
            <pre><code>composer require chris1971nrw/community-shop:{{VERSION}}</code></pre>
            
            <h3>🎥 Tutorial Video</h3>
            <div style="width: 100%; max-width: 560px;">
                <!-- YouTube Embed -->
            </div>
            
            <h3>🔗 Links</h3>
            <ul>
                <li><a href="{{DOCS_URL}}">{{DOCS_TITLE}}</a></li>
                <li><a href="{{REPO_URL}}">{{REPO_TITLE}}</a></li>
                <li><a href="{{DEMO_URL}}">{{DEMO_TITLE}}</a></li>
            </ul>
        </div>
        
        <!-- Footer -->
        <div style="background: #f5f5f5; padding: 20px; text-align: center;">
            <p>Community Shop | Made with ❤️</p>
            <p>Unsubscribe | Settings</p>
        </div>
    </div>
</body>
</html>
```

---

## 📧 Community Spotlight

### HTML Template

```html
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Spotlight</title>
</head>
<body>
    <div style="max-width: 600px; margin: 0 auto; font-family: Arial, sans-serif;">
        <!-- Header -->
        <div style="background: #2563eb; color: white; padding: 20px; text-align: center;">
            <h1>🌟 Community Spotlight</h1>
            <p>{{DATE}}</p>
        </div>
        
        <!-- Content -->
        <div style="padding: 20px;">
            <h2>🎉 Community-Mitglied der Woche</h2>
            
            <div style="text-align: center; margin: 30px 0;">
                <img src="{{PROFILE_PICTURE}}" alt="{{USERNAME}}" style="width: 120px; height: 120px; border-radius: 50%;">
                <h3>{{USERNAME}}</h3>
                <p>{{ROLE}}</p>
            </div>
            
            <h3>🏆 Erfolge</h3>
            <ul>
                <li>{{ACHIEVEMENT_1}}</li>
                <li>{{ACHIEVEMENT_2}}</li>
                <li>{{ACHIEVEMENT_3}}</li>
            </ul>
            
            <h3>💬 Kommentare</h3>
            <blockquote>{{QUOTE}}</blockquote>
            
            <h3>📊 Beiträge</h3>
            <p>{{CONTRIBUTION_STATS}}</p>
            
            <h3>🔗 GitHub Profile</h3>
            <a href="{{GITHUB_PROFILE}}">👤 GitHub</a>
        </div>
        
        <!-- Footer -->
        <div style="background: #f5f5f5; padding: 20px; text-align: center;">
            <p>Community Shop | Made with ❤️</p>
            <p>Unsubscribe | Settings</p>
        </div>
    </div>
</body>
</html>
```

---

## 📧 Product Launch

### HTML Template

```html
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Launch: {{PRODUCT_NAME}}</title>
</head>
<body>
    <div style="max-width: 600px; margin: 0 auto; font-family: Arial, sans-serif;">
        <!-- Header -->
        <div style="background: #2563eb; color: white; padding: 20px; text-align: center;">
            <h1>🛍️ Neu: {{PRODUCT_NAME}}</h1>
            <p>{{LAUNCH_DATE}}</p>
        </div>
        
        <!-- Content -->
        <div style="padding: 20px;">
            <div style="text-align: center;">
                <img src="{{PRODUCT_IMAGE}}" alt="{{PRODUCT_NAME}}" style="width: 100%; max-width: 400px; border-radius: 10px;">
            </div>
            
            <h2>📝 Beschreibung</h2>
            <p>{{PRODUCT_DESCRIPTION}}</p>
            
            <h3>🌟 Features</h3>
            <ul>
                <li>{{FEATURE_1}}</li>
                <li>{{FEATURE_2}}</li>
                <li>{{FEATURE_3}}</li>
            </ul>
            
            <h3>💰 Preis</h3>
            <p style="font-size: 24px; color: #2563eb;">{{PRICE}}</p>
            
            <h3>🔗 Kaufen</h3>
            <a href="{{AMAZON_URL}}" style="display: block; background: #ff9900; color: white; padding: 15px; text-align: center; border-radius: 5px;">
                🛒 Auf Amazon kaufen
            </a>
            
            <h3>📝 Bewertungen</h3>
            <div style="margin-top: 20px;">
                <div style="color: gold;">⭐⭐⭐⭐⭐</div>
                <p>Score: {{SCORE}}</p>
            </div>
            
            <h3>📝 Reviews</h3>
            <div style="background: #f5f5f5; padding: 15px;">
                <p><strong>{{USER_NAME}}</strong></p>
                <p>"{{REVIEW_TEXT}}"</p>
            </div>
        </div>
        
        <!-- Footer -->
        <div style="background: #f5f5f5; padding: 20px; text-align: center;">
            <p>Community Shop | Made with ❤️</p>
            <p>Unsubscribe | Settings</p>
        </div>
    </div>
</body>
</html>
```

---

## 📧 Welcome Email

### HTML Template

```html
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Community Shop</title>
</head>
<body>
    <div style="max-width: 600px; margin: 0 auto; font-family: Arial, sans-serif;">
        <!-- Header -->
        <div style="background: #2563eb; color: white; padding: 20px; text-align: center;">
            <h1>👋 Willkommen!</h1>
            <p>Thank you for subscribing to Community Shop</p>
        </div>
        
        <!-- Content -->
        <div style="padding: 20px;">
            <h2>📚 Was ist Community Shop?</h2>
            <p>{{INTRODUCTION}}</p>
            
            <h3>🛍️ Features</h3>
            <ul>
                <li>{{FEATURE_1}}</li>
                <li>{{FEATURE_2}}</li>
                <li>{{FEATURE_3}}</li>
            </ul>
            
            <h3>🚀 Starten</h3>
            <a href="{{DEMO_URL}}" style="display: block; background: #2563eb; color: white; padding: 15px; text-align: center; border-radius: 5px;">
                🚀 Demo ansehen
            </a>
            
            <h3>📖 Dokumentation</h3>
            <a href="{{DOCS_URL}}">{{DOCS_TITLE}}</a>
            
            <h3>📬 Folgen</h3>
            <ul>
                <li><a href="{{YOUTUBE_URL}}">YouTube</a></li>
                <li><a href="{{TWITTER_URL}}">Twitter/X</a></li>
                <li><a href="{{DISCORD_URL}}">Discord</a></li>
                <li><a href="{{GITHUB_URL}}">GitHub</a></li>
            </ul>
            
            <h3>🤝 Beitrag</h3>
            <p><a href="{{CONTRIBUTING_URL}}">{{CONTRIBUTING_TITLE}}</a></p>
        </div>
        
        <!-- Footer -->
        <div style="background: #f5f5f5; padding: 20px; text-align: center;">
            <p>Community Shop | Made with ❤️</p>
            <p>Unsubscribe | Settings</p>
        </div>
    </div>
</body>
</html>
```

---

## 📊 Newsletter-Metriken

| Metrik | Ziel | Status |
|-----------|-------|-------|--|
| **Abonnenten** | >500 | ⏳ In Arbeit |
| **Open Rate** | >30% | ⏳ In Arbeit |
| **Click Rate** | >5% | ⏳ In Arbeit |
| **Unsubscribe** | <1% | ✅ Met |

---

## 🔧 Automation Setup

### 1. Mail Service

```php
// .env
MAIL_MAILER=smtp
MAIL_HOST=mailgun
MAIL_PORT=587
MAIL_USERNAME=***
MAIL_PASSWORD=***
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@community-shop.example.com
MAIL_FROM_NAME="${APP_NAME}"
```

### 2. Mailgun Setup

```bash
# Mailgun API Key
export MG_API_KEY=***

# Domain erstellen
mg domains create -n community-shop.example.com

# SMTP Credentials
export MAIL_HOST=smtp.mailgun.org
export MAIL_USERNAME=postmaster@community-shop.example.com
export MAIL_PASSWORD=***
```

### 3. Scheduled Jobs

```php
// app/Console/Commands/NewsletterCommand.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\NewsletterService;

class NewsletterCommand extends Command
{
    protected $signature = 'newsletter:weekly';
    protected $description = 'Sende wöchentlichen Newsletter';
    
    public function handle(NewsletterService $newsletterService)
    {
        $newsletter = $newsletterService->getWeeklyDigest();
        
        foreach ($newsletter->subscribers as $subscriber) {
            $mailer->send(
                'emails.weekly',
                [
                    'subscriber' => $subscriber,
                    'newsletter' => $newsletter,
                ]
            );
        }
    }
}
```

---

**Version:** 0.1.0-dev  
**Last Updated:** 2026-05-24  
**Author:** Community Shop Team  
**License:** MIT
