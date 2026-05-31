# ShineBox — Car Detailing Landing Page (WordPress)

A bilingual **(English / Georgian)** one-page WordPress site for **ShineBox**, a
mobile car polishing & detailing service. Built as a **custom theme** (no page
builder), with vanilla HTML/CSS/JS and PHP.

## ✨ Features

- **One-page responsive design** — modern dark "glossy" look.
- **Bilingual EN / KA** — flag dropdown switcher, SEO-friendly separate URLs
  (`/` and `/ka/`) via **Polylang**, with `hreflang` tags. Works standalone via
  a built-in translation layer if Polylang is disabled.
- **Services & pricing** — body polishing, interior cleaning, headlight
  restoration (single source of truth in `inc/pricing.php`).
- **Interactive price calculator** — total = selected services × vehicle-type
  multiplier.
- **Before / after gallery** — comparison sliders.
- **Booking form** — Name + Phone + Car model, sent to email via AJAX.
- **Floating WhatsApp button** + click-to-chat links.
- **Photoreal hero image** generated with Google's Gemini image model.

## 🧱 Tech stack

- WordPress (custom theme, no page builder)
- PHP 8 · vanilla JavaScript · CSS
- Polylang (multilingual)
- Docker + Docker Compose (local environment)

## 🚀 Local setup (Docker)

```bash
docker compose up -d        # WordPress on http://localhost:8090
docker compose down         # stop
docker compose down -v      # stop and wipe the database
```

Then open `http://localhost:8090`, finish the WordPress install, and activate
the **ShineBox** theme under *Appearance → Themes*.

## 📁 Theme structure

```
wp-content/themes/shinebox/
├── functions.php            # assets, theme support, JS localization
├── header.php / footer.php  # header (nav + language dropdown) and footer
├── front-page.php           # home page — assembles the sections
├── inc/
│   ├── i18n.php             # EN/KA dictionary + helpers
│   ├── pricing.php          # car types & services (single source of truth)
│   └── contact-handler.php  # AJAX booking handler + Customizer settings
├── template-parts/          # hero, services, calculator, gallery, reviews, booking
└── assets/                  # css, js, images
```

## ⚙️ Configuration

Contact details (email, phone, WhatsApp, social links) are set under
**Appearance → Customize → ShineBox — Contact & Social**.

---

*Built by [your name]. Demo content & placeholder images included.*
