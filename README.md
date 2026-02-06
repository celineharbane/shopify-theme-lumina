# LUMINA - Premium Shopify Theme

![LUMINA Theme](https://via.placeholder.com/1200x600/1a1a2e/ffffff?text=LUMINA+Premium+Theme)

**LUMINA** is a premium, conversion-optimized Shopify theme built from the ground up with Online Store 2.0 architecture. Designed for fashion, lifestyle, and luxury brands, LUMINA combines elegant aesthetics with powerful e-commerce features.

## ✨ Key Features

### Design & UX
- **Modern, Minimalist Design** - Clean typography and generous whitespace
- **Fully Responsive** - Optimized for mobile, tablet, and desktop
- **Dark Mode Ready** - Color schemes for light and dark aesthetics
- **Smooth Animations** - AOS (Animate on Scroll) with reduced motion support
- **Accessible** - WCAG 2.1 AA compliant

### E-commerce Features
- **Ajax Cart Drawer** - Add to cart without page reload
- **Quick View Modal** - Preview products without leaving the page
- **Predictive Search** - Real-time search suggestions
- **Product Zoom** - High-resolution image zoom on hover
- **Variant Picker** - Button and dropdown styles with color swatches
- **Trust Badges** - Build customer confidence

### Performance
- **Fast Loading** - Optimized CSS and minimal JavaScript
- **Lazy Loading** - Images load as needed
- **Modern CSS** - CSS Grid and Flexbox layout
- **No jQuery Dependency** - Vanilla JavaScript only

### Sections Available
- Hero Slideshow with video support
- Featured Collection
- Image with Text
- Multicolumn (icons, stats, content)
- Testimonials (slider, grid, carousel)
- Newsletter (centered, split, background)
- FAQ / Collapsible content
- Collection List
- Product page (gallery layouts, tabs)
- Customer account pages

## 📦 Installation

### Via Shopify Admin
1. Download the theme as a ZIP file
2. Go to **Online Store > Themes** in your Shopify admin
3. Click **Add theme > Upload ZIP file**
4. Select the LUMINA ZIP file
5. Click **Customize** to configure

### Via Shopify CLI
```bash
shopify theme push --store your-store.myshopify.com
```

## 🎨 Customization

### Theme Settings

Access theme settings via **Customize > Theme settings**:

#### Colors
- Primary color (buttons, links)
- Secondary color (accents)
- Background colors
- Text colors

#### Typography
- Heading font family
- Body font family
- Font scale

#### Layout
- Page width
- Section spacing
- Border radius

#### Cart
- Cart type (drawer/page)
- Cart notes
- Upsell products

### Section Settings

Each section includes comprehensive settings:
- Color schemes (none, light, dark, accent)
- Padding controls
- Animation options
- Layout variations

## 📁 Theme Structure

```
lumina/
├── assets/
│   ├── base.css              # Core styles
│   ├── animations.css        # AOS animations
│   ├── component-*.css       # Component styles
│   ├── section-*.css         # Section styles
│   └── lumina.js             # Main JavaScript
├── config/
│   └── settings_schema.json  # Theme settings
├── layout/
│   └── theme.liquid          # Main layout
├── locales/
│   ├── en.default.json       # English translations
│   └── fr.json               # French translations
├── sections/
│   ├── header.liquid
│   ├── footer.liquid
│   ├── hero-slideshow.liquid
│   ├── featured-collection.liquid
│   ├── image-with-text.liquid
│   ├── multicolumn.liquid
│   ├── testimonials.liquid
│   ├── newsletter.liquid
│   ├── faq.liquid
│   ├── collection-list.liquid
│   ├── main-product.liquid
│   ├── main-login.liquid
│   ├── main-register.liquid
│   ├── main-account.liquid
│   └── main-404.liquid
├── snippets/
│   ├── css-variables.liquid  # CSS custom properties
│   ├── icons.liquid          # SVG icon library
│   ├── product-card.liquid   # Product card component
│   ├── cart-drawer.liquid    # Ajax cart drawer
│   ├── testimonial-card.liquid
│   ├── quick-view-modal.liquid
│   ├── search-modal.liquid
│   └── social-icons.liquid
└── templates/
    ├── index.json
    ├── product.json
    ├── collection.json
    ├── cart.json
    ├── page.json
    ├── 404.json
    └── customers/
        ├── login.json
        ├── register.json
        └── account.json
```

## 🔧 Development

### Requirements
- Node.js 18+
- Shopify CLI 3.x

### Local Development
```bash
# Install Shopify CLI
npm install -g @shopify/cli @shopify/theme

# Start development server
shopify theme dev --store your-store.myshopify.com
```

### Code Standards
- BEM methodology for CSS classes
- Semantic HTML5 elements
- ARIA labels for accessibility
- CSS custom properties for theming

## 🌐 Browser Support

- Chrome (last 2 versions)
- Firefox (last 2 versions)
- Safari (last 2 versions)
- Edge (last 2 versions)
- iOS Safari
- Chrome for Android

## 📝 Translations

LUMINA includes translations for:
- English (default)
- French

To add a new language:
1. Copy `locales/en.default.json`
2. Rename to `locales/[language_code].json`
3. Translate all strings

## ⚡ Performance Tips

1. **Optimize Images** - Use WebP format when possible
2. **Limit Sections** - Avoid more than 10-15 sections per page
3. **Lazy Load** - Enable lazy loading for below-fold content
4. **Minimize Apps** - Each app adds JavaScript overhead

## 🤝 Support

Pour toute question ou demande de personnalisation :
- GitHub Issues : [github.com/celineharbane/shopify-theme-lumina/issues](https://github.com/celineharbane/shopify-theme-lumina/issues)

## 📄 Licence

**MIT License** - Copyright (c) 2024 Céline Harbane

Ce thème est open source. Vous êtes libre de l'utiliser, le modifier et le distribuer.
Travail personnel réalisé avec passion.

## 🔄 Changelog

### Version 1.0.0
- Initial release
- Online Store 2.0 architecture
- 15+ customizable sections
- Full customer account pages
- Ajax cart functionality
- Predictive search
- Multi-language support

---

**LUMINA** - Elevate your e-commerce experience.
