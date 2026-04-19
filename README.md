# Jocelyne Bosschot — thème WordPress

Thème WordPress one-page pour **Jocelyne Bosschot**, artiste sculpteur céramique à Saint-Laurent-du-Var (06700). Esthétique wabi-sabi, tons terre, bilingue FR/EN, SEO et référencement géographique intégrés.

> Cette branche (`claude/implement-wordpress-design-Lqkrc`) contient **uniquement le thème WordPress**. L'autre projet (thème Shopify Lumina) vit sur `main`.

## Installation

1. Zipper le contenu de ce dépôt (tous les fichiers à la racine) en `jocelyne-bosschot.zip`.
2. Dans WordPress (6.x) : **Apparence → Thèmes → Ajouter → Téléverser**, choisir le zip, activer.
3. Dans **Réglages → Lecture**, choisir « Une page statique » et assigner une page d'accueil vide — le thème utilisera `front-page.php`.

Alternative : copier le dossier dans `wp-content/themes/jocelyne-bosschot/` puis activer.

## Structure

```
style.css              En-tête officiel du thème
functions.php          Enqueue, supports, menus, textdomain
header.php             <head>, nav, bouton langue
footer.php             Pied de page + lightbox
front-page.php         Page d'accueil (somme des sections)
index.php              Fallback identique à front-page
inc/
  seo.php              Méta SEO/GEO + schema.org JSON-LD
  content.php          Données statiques (galeries, boutique, expos…)
  contact.php          Handler du formulaire (admin-post.php, wp_mail)
template-parts/
  hero.php             Hero + carrousel auto (5 images)
  galeries.php         6 collections avec onglets
  boutique.php         Grille boutique (9 pièces)
  demarche.php         Portrait + citation Monticelli
  parcours.php         Timeline + Diplôme d'Honneur
  news.php             Expositions avec schema.org Event
  presse.php           Articles + dossiers PDF
  contact.php          Formulaire + infos + notices
assets/
  css/theme.css        Styles portés du prototype
  js/theme.js          Carrousel, onglets, lightbox, langue, menu
```

## Fonctionnalités

**Design**
- Palette OKLCH : argile, sable, crème, terre foncée, or, sauge
- Polices Google : Cormorant Garamond (display) + DM Sans (texte)
- Texture de grain SVG subtile en overlay
- Animations d'apparition au scroll (IntersectionObserver)
- Respect de `prefers-reduced-motion`

**SEO & GEO (page d'accueil)**
- Meta `description`, `keywords`, Open Graph, Twitter Card
- `hreflang` FR/EN, `canonical`
- Balises `geo.region`, `geo.placename`, `geo.position`, `ICBM`
- Schema.org `LocalBusiness` + `Artist` en JSON-LD
- Microdonnées `schema.org/Event` sur chaque exposition
- HTML sémantique, hiérarchie H1 → H3 propre

**Bilingue FR/EN**
- Pas de plugin requis — bascule côté client via `html[lang]`
- Préférence persistée en `localStorage`
- Hooks `load_theme_textdomain` prêts pour WPML / Polylang si besoin

**Interactions**
- Navigation fixe avec fond flouté au scroll
- Menu mobile burger
- Carrousel hero (fade, 4 s)
- Onglets galerie
- Lightbox au clic
- Formulaire de contact via `admin-post.php` + `wp_mail()`

## Personnalisation

- Remplacer les images CDN dans `inc/content.php` par celles de la médiathèque (`wp_get_attachment_image_url()`).
- Adapter l'e-mail destinataire via le filtre `jb_contact_to` ou l'option `admin_email`.
- Ajuster les variables CSS `--clay`, `--cream`, etc. dans `assets/css/theme.css`.

## Licence

MIT — voir `LICENSE`.
