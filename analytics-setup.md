# 📊 Analytics Setup für Community Shop

## Overview

Dieses Dokument erklärt, wie du Analytics für den Community Shop einrichtest.

---

## 📊 Google Analytics

### 1. Setup

```html
<!-- public/index.html -->
<script>
(function(i,s,o,g,j,r){i['GoogleAnalyticsObject']=j;
    r=i.createElement(o);
    r.src=g;
    r.async=1;
    i.getElementsByTagName('head')[0].appendChild(r);
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-XXXXX-Y', 'auto');
ga('set', 'anonymizeIp', true);
ga('set', 'cookieExpiration', 365);
ga('send', 'pageview');
</script>
```

### 2. Event Tracking

```javascript
// Voting-Events
function trackVote(voteType, productId) {
    ga('send', 'event', {
        'eventCategory': 'Voting',
        'eventAction': voteType,
        'eventLabel': productId,
        'value': 1
    });
}

// Amazon-Click-Tracking
function trackAmazonClick(url) {
    ga('send', 'event', {
        'eventCategory': 'Affiliate',
        'eventAction': 'click',
        'eventLabel': url,
        'value': 1
    });
}

// Feature-Interaktion
function trackFeature(featureName) {
    ga('send', 'event', {
        'eventCategory': 'Feature',
        'eventAction': featureName,
        'eventLabel': 'viewed',
        'value': 1
    });
}
```

### 3. Enhanced Ecommerce

```javascript
// Product Views
ga('ecommerce:addItem', {
    'productCode': productId,
    'productName': productTitle,
    'category': productCategory,
    'price': productPrice,
    'quantity': 1
});

// Product Added to Cart
ga('ecommerce:addTransaction', {
    'id': transactionId,
    'revenue': totalRevenue,
    'currency': 'EUR',
    'items': [{
        'itemCode': productId,
        'itemLabel': productTitle,
        'itemCategory': productCategory,
        'itemPrice': productPrice,
        'itemQuantity': 1
    }]
});
```

### 4. Conversion Tracking

```javascript
// Form Submissions
function trackForm(formId) {
    ga('send', 'event', {
        'eventCategory': 'Form',
        'eventAction': 'submit',
        'eventLabel': formId
    });
}

// Button Clicks
function trackButton(buttonId) {
    ga('send', 'event', {
        'eventCategory': 'Interaction',
        'eventAction': 'button',
        'eventLabel': buttonId
    });
}
```

---

## 📊 Matomo

### 1. Setup

```php
// .env
PWA_MANIFEST_URL=https://chris1971nrw.github.io/community-shop/public/manifest.json
```

### 2. Tracking Code

```javascript
<!-- public/index.html -->
<script>
var _paq = window._paq = window._paq || [];
/* tracker methods like "setTrackerId", "trackPageview" */
_paq.push(['trackPageView']);
_paq.push(['enableLinkTracking']);
_paq.push(['setDocumentTitle', document.title]);
_paq.push(['setCustomUrl', window.location.href]);
_paq.push(['enableCollected']);
_paq.push(['setTrackerUrl', 'https://matomo.example.com/matomo.php']);
_paq.push(['setSiteId', '1']);
_paq.push(['enableLinkTracking']);
_paq.push(['setCustomTrackerUrl', 'https://matomo.example.com/matomo.js']);
_paq.push(['setDomainJoin', '.example.com']);
_paq.push(['disableCookies', true]);
_paq.push(['doNotTrack', true]);
_paq.push(['disableCookies', false]);

(function() {
    var u = "https://matomo.example.com/";
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript';
    g.async=true;
    g.src=u+'matomo.js';
    s.parentNode.insertBefore(g,s);
})();
</script>
```

---

## 📊 Analytics Metriken

### 1. Page Views

```javascript
// Track Page Views
function trackPageView(page, viewParams) {
    ga('send', 'pageview', {
        'page': page,
        'title': document.title,
        'location': window.location.href,
        'referrer': document.referrer,
        'userAgent': navigator.userAgent,
        'timeOnPage': new Date() - pageLoadTime,
        'viewParams': viewParams
    });
}
```

### 2. User Behavior

```javascript
// Track User Scroll
function trackScroll() {
    var winScroll = window.scrollY,
        windowHeight = window.innerHeight,
        docHeight = document.documentElement.scrollHeight,
        scrollPercent = ((winScroll + windowHeight) / docHeight) * 100;
    
    if (scrollPercent > 50) {
        ga('send', 'event', {
            'eventCategory': 'Scroll',
            'eventAction': 'scrolled',
            'eventLabel': scrollPercent + '%',
            'value': scrollPercent
        });
    }
}

// Track Clicks
function trackClick(element) {
    ga('send', 'event', {
        'eventCategory': 'Click',
        'eventAction': element.tagName.toLowerCase(),
        'eventLabel': element.innerText.substring(0, 30),
        'value': 1
    });
}
```

### 3. Conversion Tracking

```javascript
// Track Conversions
function trackConversion(conversionName, conversionValue) {
    ga('send', 'event', {
        'eventCategory': 'Conversion',
        'eventAction': conversionName,
        'eventValue': conversionValue
    });
}

// Amazon Affiliate Conversion
function trackAmazonConversion() {
    ga('send', 'event', {
        'eventCategory': 'Affiliate',
        'eventAction': 'conversion',
        'eventLabel': 'amazon_de',
        'value': 1.0
    });
}
```

---

## 📊 Performance Monitoring

### 1. LCP (Largest Contentful Paint)

```javascript
// LCP Monitoring
const observer = new PerformanceObserver((list) => {
    list.getEntries().forEach(entry => {
        console.log(`LCP: ${entry.startTime}ms`);
        if (entry.startTime > 2500) {
            // Slow LCP alert
        }
    });
});

observer.observe({ entryTypes: ['largest-blocking-task'] });
```

### 2. First Contentful Paint

```javascript
// FCP Monitoring
window.addEventListener('load', () => {
    const fcp = new PerformanceObserver((entryList) => {
        console.log(`FCP: ${entryList.getEntries()[0].startTime}ms`);
    });
    
    fcp.observe({ entryTypes: ['paint'] });
});
```

### 3. Time to Interactive

```javascript
// TTI Monitoring
if ('performance' in window) {
    window.addEventListener('load', () => {
        const tti = performance.timing.domInteractive - performance.timing.navigationStart;
        console.log(`TTI: ${tti}ms`);
    });
}
```

---

## 📊 Error Tracking

### 1. Error Monitoring

```javascript
// Error Tracking
window.onerror = (message, source, lineno, colno, error) => {
    ga('send', 'exception', {
        'exDescription': message,
        'exFatal': true,
        'exLocation': source,
        'exLine': lineno,
        'exColumn': colno
    });
};

// Uncaught Errors
window.onunhandledrejection = (event) => {
    ga('send', 'exception', {
        'exDescription': event.reason
    });
};
```

### 2. Crash Reporting

```javascript
// Crash Reporting
if (process.env.NODE_ENV !== 'production') {
    // Only in development
    return;
}

// Production
throw new Error(`Error: ${error.message} - ${error.stack}`);
```

---

## 📊 Heatmaps (Hotjar/CrazyEgg)

### 1. Hotjar Setup

```html
<!-- public/index.html -->
<script>
(function(h,o,t,j,a,r){
    h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
    h.nj=h.nj||function(){(h.nj.q=h.nj.q||[]).push(arguments)};
    r=o.createElement(t);
    r.async=1;
    r.src=j;
    h._hjID=a;
    o.getElementsByTagName("head")[0].appendChild(r);
})(window,document,"script","https://static.hotjar.com/c/hotjar-XXXXX.js?cv=1",0);
</script>
```

### 2. Session Recording

```javascript
// Session Recording
Hotjar('config', {
    'enableTracking': true,
    'enableHeatmaps': true,
    'enableRecordings': true,
    'recordCaptcha': false,
    'recordCORS': false
});
```

---

## 📊 Analytics Dashboard

### 1. Dashboard Layout

```html
<!-- public/analytics.html -->
<!DOCTYPE html>
<html>
<head>
    <title>Analytics Dashboard</title>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>
    <div id="dashboard"></div>
    
    <script>
        // Load Analytics Data
        fetch('/api/analytics')
            .then(response => response.json())
            .then(data => {
                // Render Charts
            });
    </script>
</body>
</html>
```

### 2. Chart Examples

```javascript
// Page Views Over Time
const pageViewsData = [
    {name: 'Page Views', y: [100, 200, 150, 300]},
    {name: 'Unique Visitors', y: [50, 100, 80, 150]}
];

const pageViewsLayout = {
    title: 'Page Views & Unique Visitors',
    xaxis: {title: 'Date'},
    yaxis: {title: 'Count'},
    showlegend: true
};

Plotly.newPlot('pageViews', pageViewsData, pageViewsLayout);
```

---

## 📊 Privacy & GDPR

### 1. Consent Mode

```html
<!-- Consent Banner -->
<div id="consent-banner">
    <p>Wir verwenden Cookies für Analytics.</p>
    <button onclick="acceptCookies()">Akzeptieren</button>
    <button onclick="declineCookies()">Ablehnen</button>
</div>

<script>
function acceptCookies() {
    // Enable Tracking
    ga('send', 'event', {
        'eventCategory': 'Analytics',
        'eventAction': 'consent',
        'eventLabel': 'accepted'
    });
}

function declineCookies() {
    // Disable Tracking
    ga('send', 'event', {
        'eventCategory': 'Analytics',
        'eventAction': 'consent',
        'eventLabel': 'declined'
    });
}
</script>
```

### 2. Do Not Track

```javascript
// Respect Do Not Track
if (navigator.doNotTrack === "1") {
    ga('set', 'anonymizeIp', true);
}
```

---

## 📊 Data Retention

### 1. Retention Policy

```php
// .env
ANALYTICS_RETENTION_DAYS=365
ANALYTICS_MAX_RECORDS=100000
```

### 2. Cleanup Job

```php
// app/Console/Commands/CleanupAnalytics.php

class CleanupAnalytics extends Command
{
    protected $signature = 'analytics:cleanup';
    protected $description = 'Clean up old analytics data';
    
    public function handle()
    {
        $cutoff = now()->subDays(config('analytics.retention_days'));
        
        // Delete old data
        AnalyticsRecord::where('created_at', '<', $cutoff)->delete();
        
        // Compress data
        $this->info('Analytics data cleaned up.');
    }
}
```

---

**Version:** 0.1.0-dev  
**Last Updated:** 2026-05-24  
**Author:** Community Shop Team  
**License:** MIT
