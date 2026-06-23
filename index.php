<?php
$supported_langs = ['fr', 'en'];
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
if (in_array($uri, $supported_langs)) {
    $current_lang = $uri;
} elseif (isset($_GET['lang']) && in_array($_GET['lang'], $supported_langs)) {
    $current_lang = $_GET['lang'];
} else {
    $current_lang = 'fr';
}
require_once __DIR__ . '/lang/' . $current_lang . '.php';
$base_url = 'https://nodule-thyroide.ch';
$other_lang_url = '/' . $lang['other_lang'];
$canonical = $current_lang === 'fr' ? $base_url . '/fr' : $base_url . '/en';
?>
<!DOCTYPE html>
<html lang="<?= $lang['lang_code'] ?>">
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-PW8M8CRN');</script>
    <!-- End Google Tag Manager -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $lang['site_title'] ?></title>
    <meta name="description" content="<?= $lang['meta_description'] ?>">
    <meta name="keywords" content="<?= $lang['meta_keywords'] ?>">
    <link rel="canonical" href="<?= $canonical ?>">
    <link rel="alternate" hreflang="fr" href="<?= $base_url ?>/fr">
    <link rel="alternate" hreflang="en" href="<?= $base_url ?>/en">
    <link rel="alternate" hreflang="x-default" href="<?= $base_url ?>/fr">

    <!-- Open Graph -->
    <meta property="og:title" content="<?= $lang['site_title'] ?>">
    <meta property="og:description" content="<?= $lang['meta_description'] ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= $canonical ?>">
    <meta property="og:image" content="<?= $base_url ?>/images/hero-cover.jpg">
    <meta property="og:locale" content="<?= $current_lang === 'fr' ? 'fr_CH' : 'en_GB' ?>">
    <meta property="og:site_name" content="nodule-thyroide.ch">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= $lang['site_title'] ?>">
    <meta name="twitter:description" content="<?= $lang['meta_description'] ?>">

    <!-- Geo -->
    <meta name="geo.region" content="CH-GE">
    <meta name="geo.placename" content="Genève, Lausanne">
    <meta name="geo.position" content="46.2044;6.1432">
    <meta name="ICBM" content="46.2044, 6.1432">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">

    <!-- Schema.org Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [
            {
                "@type": "MedicalWebPage",
                "name": "<?= addslashes($lang['site_title']) ?>",
                "description": "<?= addslashes($lang['meta_description']) ?>",
                "url": "<?= $canonical ?>",
                "inLanguage": "<?= $current_lang ?>",
                "dateModified": "2026-06-08",
                "about": {
                    "@type": "MedicalProcedure",
                    "name": "<?= addslashes($lang['schema_procedure']) ?>",
                    "procedureType": "https://schema.org/NoninvasiveProcedure",
                    "description": "<?= addslashes($lang['schema_description']) ?>",
                    "howPerformed": "Radiofrequency thermoablation under ultrasound guidance",
                    "bodyLocation": "Thyroid gland"
                }
            },
            {
                "@type": "Physician",
                "name": "Dr Nicolas Villard",
                "description": "<?= $current_lang === 'fr' ? 'Radiologue interventionnel spécialisé dans le traitement mini-invasif des nodules thyroïdiens. Plus de 1000 traitements réalisés.' : 'Interventional radiologist specialised in minimally invasive thyroid nodule treatment. Over 1,000 treatments performed.' ?>",
                "medicalSpecialty": "Interventional Radiology",
                "url": "<?= $base_url ?>",
                "image": "<?= $base_url ?>/images/nicolas-villard.jpg",
                "knowsAbout": ["Thyroid Radiofrequency Ablation", "Thyroid Nodule Treatment", "Thermoablation", "Interventional Radiology"],
                "areaServed": [
                    {
                        "@type": "City",
                        "name": "Genève",
                        "containedInPlace": {"@type": "AdministrativeArea", "name": "Suisse Romande"}
                    },
                    {
                        "@type": "City",
                        "name": "Lausanne",
                        "containedInPlace": {"@type": "AdministrativeArea", "name": "Suisse Romande"}
                    }
                ],
                "availableService": {
                    "@type": "MedicalProcedure",
                    "name": "<?= addslashes($lang['schema_procedure']) ?>",
                    "procedureType": "https://schema.org/NoninvasiveProcedure"
                }
            },
            {
                "@type": "FAQPage",
                "mainEntity": [
                    <?php foreach ($lang['faq'] as $i => $faq_item): ?>
                    {
                        "@type": "Question",
                        "name": "<?= addslashes($faq_item['q']) ?>",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "<?= addslashes($faq_item['a']) ?>"
                        }
                    }<?= $i < count($lang['faq']) - 1 ? ',' : '' ?>
                    <?php endforeach; ?>
                ]
            },
            {
                "@type": "MedicalBusiness",
                "name": "Dr Nicolas Villard — Radiologie interventionnelle",
                "url": "<?= $base_url ?>",
                "image": "<?= $base_url ?>/images/nicolas-villard.jpg",
                "telephone": "+41582553144",
                "email": "secretariat@drvillard.ch",
                "priceRange": "Pris en charge LAMal",
                "address": [
                    {
                        "@type": "PostalAddress",
                        "name": "Clinique Générale Beaulieu",
                        "streetAddress": "Chemin de Beau-Soleil 20",
                        "postalCode": "1206",
                        "addressLocality": "Genève",
                        "addressRegion": "GE",
                        "addressCountry": "CH"
                    },
                    {
                        "@type": "PostalAddress",
                        "name": "Medbase Lausanne",
                        "streetAddress": "Place de la Gare 9a-11",
                        "postalCode": "1003",
                        "addressLocality": "Lausanne",
                        "addressRegion": "VD",
                        "addressCountry": "CH"
                    },
                    {
                        "@type": "PostalAddress",
                        "name": "Clinique Montchoisi",
                        "streetAddress": "Chemin des Allinges 10",
                        "postalCode": "1006",
                        "addressLocality": "Lausanne",
                        "addressRegion": "VD",
                        "addressCountry": "CH"
                    },
                    {
                        "@type": "PostalAddress",
                        "name": "Clinique Amiia",
                        "streetAddress": "Rue Centrale 19",
                        "postalCode": "1003",
                        "addressLocality": "Lausanne",
                        "addressRegion": "VD",
                        "addressCountry": "CH"
                    }
                ],
                "geo": [
                    {
                        "@type": "GeoCoordinates",
                        "latitude": 46.1988,
                        "longitude": 6.1615
                    },
                    {
                        "@type": "GeoCoordinates",
                        "latitude": 46.5167,
                        "longitude": 6.6294
                    }
                ],
                "areaServed": "Suisse Romande",
                "medicalSpecialty": "Interventional Radiology"
            }
        ]
    }
    </script>
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PW8M8CRN"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<!-- ===================== HEADER ===================== -->
<header class="header" role="banner">
    <div class="header-inner">
        <a href="/<?= $current_lang ?>" class="logo"><img src="/images/icon.png" alt="" class="logo-icon"><span class="logo-text">nodule-thyroide<span class="logo-tld">.ch</span></span></a>
        <nav class="nav" role="navigation" aria-label="<?= $current_lang === 'fr' ? 'Navigation principale' : 'Main navigation' ?>">
            <a href="#thyroide"><?= $lang['nav_thyroid'] ?></a>
            <a href="#nodules"><?= $lang['nav_nodules'] ?></a>
            <a href="#traitements"><?= $lang['nav_treatments'] ?></a>
            <a href="#comparaison"><?= $lang['nav_comparison'] ?></a>
            <a href="#expert"><?= $lang['nav_expert'] ?></a>
            <a href="#faq"><?= $lang['nav_faq'] ?></a>
            <a href="#rdv" class="nav-cta"><?= $lang['nav_contact'] ?></a>
            <a href="<?= $other_lang_url ?>" class="lang-switch" aria-label="<?= $current_lang === 'fr' ? 'Switch to English' : 'Passer en français' ?>"><?= $lang['other_lang_name'] ?></a>
        </nav>
        <button class="hamburger" aria-label="Menu" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>
    </div>
</header>

<!-- ===================== HERO ===================== -->
<section class="hero" id="accueil">
    <div class="hero-bg" role="img" aria-label="<?= $current_lang === 'fr' ? 'Consultation thyroïde' : 'Thyroid consultation' ?>"></div>
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="hero-content">
            <h1><?= $lang['hero_title'] ?></h1>
            <p class="subtitle"><?= $lang['hero_subtitle'] ?></p>
            <p><?= $lang['hero_description'] ?></p>
            <div class="hero-buttons">
                <a href="#rdv" class="btn btn-primary"><?= $lang['hero_cta'] ?></a>
                <a href="#thyroide" class="btn btn-outline"><?= $lang['hero_learn_more'] ?></a>
            </div>
        </div>
    </div>
</section>

<!-- ===================== BENEFITS ===================== -->
<section class="benefits section" aria-label="<?= $lang['benefits_title'] ?>">
    <div class="container">
        <h2 class="section-title text-center"><?= $lang['benefits_title'] ?></h2>
        <div class="benefits-grid">
            <div class="benefit-card">
                <div class="benefit-icon">
                    <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <h3><?= $lang['benefit_1_title'] ?></h3>
                <p><?= $lang['benefit_1_text'] ?></p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">
                    <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                </div>
                <h3><?= $lang['benefit_2_title'] ?></h3>
                <p><?= $lang['benefit_2_text'] ?></p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">
                    <svg viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                </div>
                <h3><?= $lang['benefit_3_title'] ?></h3>
                <p><?= $lang['benefit_3_text'] ?></p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">
                    <svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
                <h3><?= $lang['benefit_4_title'] ?></h3>
                <p><?= $lang['benefit_4_text'] ?></p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">
                    <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                </div>
                <h3><?= $lang['benefit_5_title'] ?></h3>
                <p><?= $lang['benefit_5_text'] ?></p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">
                    <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                </div>
                <h3><?= $lang['benefit_6_title'] ?></h3>
                <p><?= $lang['benefit_6_text'] ?></p>
            </div>
        </div>
    </div>
</section>

<!-- ===================== THYROID ===================== -->
<section class="section section-alt" id="thyroide">
    <div class="container">
        <div class="content-with-image">
            <div>
                <h2 class="section-title"><?= $lang['thyroid_title'] ?></h2>
                <div class="content-block">
                    <p><?= $lang['thyroid_text_1'] ?></p>
                    <p><?= $lang['thyroid_text_2'] ?></p>
                    <p><?= $lang['thyroid_text_3'] ?></p>
                </div>
            </div>
            <div class="content-image">
                <img src="images/thyroide-vue-frontale.png" alt="<?= $current_lang === 'fr' ? 'Schéma anatomique de la thyroïde en vue frontale' : 'Anatomical diagram of the thyroid, front view' ?>" width="600" height="600" loading="lazy">
            </div>
        </div>

        <div class="content-with-image reverse mt-40">
            <div>
                <h3 class="section-title" style="font-size:1.4rem;"><?= $lang['tsh_title'] ?></h3>
                <div class="content-block">
                    <p><?= $lang['tsh_text_1'] ?></p>
                    <p><?= $lang['tsh_text_2'] ?></p>
                </div>
            </div>
            <div class="content-image">
                <img src="images/controle-hormonal.png" alt="<?= $current_lang === 'fr' ? 'Schéma de la régulation hormonale thyroïdienne : hypophyse, TSH, T3, T4' : 'Thyroid hormone regulation diagram: pituitary, TSH, T3, T4' ?>" width="500" height="600" loading="lazy">
            </div>
        </div>

        <div class="mt-40" style="display:grid; grid-template-columns:1fr 1fr; gap:32px;">
            <div class="content-block">
                <h3><?= $lang['hyper_title'] ?></h3>
                <p><?= $lang['hyper_text'] ?></p>
            </div>
            <div class="content-block">
                <h3><?= $lang['hypo_title'] ?></h3>
                <p><?= $lang['hypo_text'] ?></p>
            </div>
        </div>
    </div>
</section>

<!-- ===================== NODULES ===================== -->
<section class="section" id="nodules">
    <div class="container">
        <h2 class="section-title"><?= $lang['nodules_title'] ?></h2>

        <div class="content-with-image">
            <div class="content-block">
                <p><?= $lang['nodules_intro'] ?></p>
                <p><?= $lang['nodules_text_2'] ?></p>
                <p><?= $lang['nodules_text_3'] ?></p>
            </div>
            <div class="content-image">
                <img src="images/types-nodule.png" alt="<?= $current_lang === 'fr' ? 'Illustration des différents types et tailles de nodules thyroïdiens' : 'Illustration of different thyroid nodule types and sizes' ?>" width="700" height="300" loading="lazy">
            </div>
        </div>

        <h3 class="section-title mt-40" style="font-size:1.5rem;"><?= $lang['nodules_types_title'] ?></h3>

        <div class="nodule-types">
            <!-- Cold nodule -->
            <div class="nodule-card">
                <h3><?= $lang['cold_title'] ?></h3>
                <h4><?= $lang['cold_subtitle'] ?></h4>
                <p><?= $lang['cold_text_1'] ?></p>
                <p><?= $lang['cold_text_2'] ?></p>
                <div class="treatment-note"><?= $lang['cold_treatment'] ?></div>
            </div>

            <!-- Hot nodule -->
            <div class="nodule-card">
                <h3><?= $lang['hot_title'] ?></h3>
                <h4><?= $lang['hot_subtitle'] ?></h4>
                <p><?= $lang['hot_text_1'] ?></p>
                <p><?= $lang['hot_text_2'] ?></p>
                <div class="treatment-note"><?= $lang['hot_treatment'] ?></div>
            </div>

            <!-- Multinodular -->
            <div class="nodule-card">
                <h3><?= $lang['multi_title'] ?></h3>
                <div class="content-image-small">
                    <img src="images/thyroide-multinodulaire.png" alt="<?= $current_lang === 'fr' ? 'Illustration d\'un goitre multinodulaire' : 'Illustration of multinodular goitre' ?>" width="400" height="300" loading="lazy">
                </div>
                <p><?= $lang['multi_text'] ?></p>
            </div>

            <!-- Malignant -->
            <div class="nodule-card">
                <h3><?= $lang['malignant_title'] ?></h3>
                <p><?= $lang['malignant_text_1'] ?></p>
                <p><?= $lang['malignant_text_2'] ?></p>
                <p><?= $lang['malignant_text_3'] ?></p>
                <div class="treatment-note"><?= $lang['malignant_text_4'] ?></div>
            </div>

            <!-- Parathyroid -->
            <div class="nodule-card">
                <h3><?= $lang['parathyroid_title'] ?></h3>
                <p><?= $lang['parathyroid_text'] ?></p>
            </div>
        </div>
    </div>
</section>

<!-- ===================== TREATMENTS ===================== -->
<section class="section section-alt" id="traitements">
    <div class="container">
        <h2 class="section-title"><?= $lang['treatments_title'] ?></h2>

        <div class="content-block">
            <p><?= $lang['treatments_intro'] ?></p>
            <p><?= $lang['treatments_ambul'] ?></p>
        </div>

        <!-- Thermoablation -->
        <div class="content-with-image mt-40">
            <div>
                <h3 class="section-title" style="font-size:1.4rem;"><?= $lang['thermo_title'] ?></h3>
                <div class="content-block">
                    <p><?= $lang['thermo_concept'] ?></p>
                    <p><?= $lang['thermo_tech'] ?></p>
                </div>
            </div>
            <div class="content-image">
                <img src="images/rfa.png" alt="<?= $current_lang === 'fr' ? 'Illustration du traitement par radiofréquence d\'un nodule thyroïdien' : 'Illustration of radiofrequency treatment of a thyroid nodule' ?>" width="500" height="500" loading="lazy">
            </div>
        </div>

        <!-- Moving-shot technique -->
        <div class="content-with-image reverse mt-40">
            <div>
                <h3 class="section-title" style="font-size:1.3rem;"><?= $current_lang === 'fr' ? 'Technique du moving-shot : vers une destruction complète' : 'Moving-shot technique: towards complete destruction' ?></h3>
                <div class="content-block">
                    <p><?= $current_lang === 'fr'
                        ? 'Le Dr Villard a fait évoluer la technique en visant systématiquement une <strong>destruction complète du nodule, bord à bord</strong>. Alors que la plupart des opérateurs se contentent de détruire la partie centrale du nodule, cette approche exhaustive combinée à l\'hydrodissection systématique rend la repousse quasi impossible.'
                        : 'Dr Villard has advanced the technique by systematically targeting <strong>complete nodule destruction, edge to edge</strong>. While most operators only destroy the central part of the nodule, this comprehensive approach combined with systematic hydrodissection makes regrowth virtually impossible.' ?></p>
                </div>
            </div>
            <div class="content-image">
                <img src="images/movingshot.png" alt="<?= $current_lang === 'fr' ? 'Technique du moving-shot : destruction complète du nodule par déplacements successifs de l\'aiguille' : 'Moving-shot technique: complete nodule destruction through successive needle movements' ?>" width="503" height="550" loading="lazy">
            </div>
        </div>

        <!-- Procedure steps -->
        <h3 class="section-title mt-40" style="font-size:1.3rem;"><?= $lang['steps_title'] ?></h3>
        <div class="steps-list">
            <div class="step-item"><div class="step-number">1</div><div class="step-text"><?= $lang['step_1'] ?></div></div>
            <div class="step-item"><div class="step-number">2</div><div class="step-text"><?= $lang['step_2'] ?></div></div>
            <div class="step-item"><div class="step-number">3</div><div class="step-text"><?= $lang['step_3'] ?></div></div>
            <div class="step-item"><div class="step-number">4</div><div class="step-text"><?= $lang['step_4'] ?></div></div>
            <div class="step-item"><div class="step-number">5</div><div class="step-text"><?= $lang['step_5'] ?></div></div>
            <div class="step-item"><div class="step-number">6</div><div class="step-text"><?= $lang['step_6'] ?></div></div>
            <div class="step-item"><div class="step-number">7</div><div class="step-text"><?= $lang['step_7'] ?></div></div>
            <div class="step-item"><div class="step-number">8</div><div class="step-text"><?= $lang['step_8'] ?></div></div>
        </div>

        <!-- Echographic images -->
        <div class="echo-images mt-40">
            <div class="echo-image">
                <img src="images/vue-echographique.jpg" alt="<?= $current_lang === 'fr' ? 'Vue échographique du traitement par thermoablation d\'un nodule thyroïdien' : 'Ultrasound view of thyroid nodule thermoablation treatment' ?>" loading="lazy">
                <div class="echo-caption"><?= $current_lang === 'fr' ? 'Vue échographique pendant le traitement' : 'Ultrasound view during treatment' ?></div>
            </div>
            <div class="echo-image">
                <img src="images/resultat-echographique.jpg" alt="<?= $current_lang === 'fr' ? 'Résultat échographique après traitement d\'un nodule thyroïdien par radiofréquence' : 'Ultrasound result after radiofrequency treatment of a thyroid nodule' ?>" loading="lazy">
                <div class="echo-caption"><?= $current_lang === 'fr' ? 'Résultat échographique après traitement' : 'Ultrasound result after treatment' ?></div>
            </div>
        </div>

        <!-- Alcoholization -->
        <div class="content-block mt-40">
            <h3 class="section-title" style="font-size:1.3rem;"><?= $lang['alcohol_title'] ?></h3>
            <p><?= $lang['alcohol_text'] ?></p>
        </div>

        <!-- Follow-up -->
        <div class="mt-40">
            <h3 class="section-title" style="font-size:1.3rem;"><?= $lang['followup_title'] ?></h3>
            <div class="content-block">
                <p><?= $lang['followup_text_1'] ?></p>
                <p><?= $lang['followup_text_2'] ?></p>
                <p><?= $lang['followup_text_3'] ?></p>
            </div>
            <div class="evolution-image">
                <img src="images/evolution-nodule.png" alt="<?= $current_lang === 'fr' ? 'Évolution d\'un nodule thyroïdien après traitement par radiofréquence : réduction progressive de la taille' : 'Thyroid nodule evolution after radiofrequency treatment: progressive size reduction' ?>" loading="lazy">
                <p class="evolution-caption"><?= $current_lang === 'fr' ? 'Évolution progressive du nodule après thermoablation : réduction de 65 à 85 % du volume' : 'Progressive nodule evolution after thermoablation: 65–85% volume reduction' ?></p>
            </div>
            <div class="content-block" style="margin-top:24px;">
                <p><?= $lang['followup_text_4'] ?></p>
                <p><?= $lang['followup_text_5'] ?></p>
            </div>
        </div>

        <!-- Side effects -->
        <div class="mt-40">
            <h3 class="section-title" style="font-size:1.3rem;"><?= $lang['side_effects_title'] ?></h3>
            <p style="font-weight:500;color:var(--success);margin-bottom:24px;"><?= $lang['side_effects_intro'] ?></p>
            <div class="side-effects-list">
                <div class="side-effect-item">
                    <h4><?= $lang['side_effect_1_title'] ?></h4>
                    <p><?= $lang['side_effect_1_text'] ?></p>
                </div>
                <div class="side-effect-item">
                    <h4><?= $lang['side_effect_2_title'] ?></h4>
                    <p><?= $lang['side_effect_2_text'] ?></p>
                </div>
                <div class="side-effect-item">
                    <h4><?= $lang['side_effect_3_title'] ?></h4>
                    <p><?= $lang['side_effect_3_text'] ?></p>
                </div>
                <div class="side-effect-item side-effect-positive">
                    <h4><?= $lang['side_effect_4_title'] ?></h4>
                    <p><?= $lang['side_effect_4_text'] ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===================== COMPARISON TABLE ===================== -->
<section class="section section-blue" id="comparaison">
    <div class="container">
        <h2 class="section-title text-center"><?= $lang['comparison_title'] ?></h2>
        <div class="comparison-table-wrapper">
            <table class="comparison-table">
                <thead>
                    <tr>
                        <th><?= $lang['comp_criteria'] ?></th>
                        <th><?= $lang['comp_surgery'] ?></th>
                        <th><?= $lang['comp_rfa'] ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td><?= $lang['comp_hospital'] ?></td><td><?= $lang['comp_hospital_surg'] ?></td><td><?= $lang['comp_hospital_rfa'] ?></td></tr>
                    <tr><td><?= $lang['comp_anesthesia'] ?></td><td><?= $lang['comp_anesthesia_surg'] ?></td><td><?= $lang['comp_anesthesia_rfa'] ?></td></tr>
                    <tr><td><?= $lang['comp_scar'] ?></td><td><?= $lang['comp_scar_surg'] ?></td><td><?= $lang['comp_scar_rfa'] ?></td></tr>
                    <tr><td><?= $lang['comp_hypocalcemia'] ?></td><td><?= $lang['comp_hypocalcemia_surg'] ?></td><td><?= $lang['comp_hypocalcemia_rfa'] ?></td></tr>
                    <tr><td><?= $lang['comp_dysphonia'] ?></td><td><?= $lang['comp_dysphonia_surg'] ?></td><td><?= $lang['comp_dysphonia_rfa'] ?></td></tr>
                    <tr><td><?= $lang['comp_hypothyroid'] ?></td><td><?= $lang['comp_hypothyroid_surg'] ?></td><td><?= $lang['comp_hypothyroid_rfa'] ?></td></tr>
                    <tr><td><?= $lang['comp_reoperation'] ?></td><td><?= $lang['comp_reoperation_surg'] ?></td><td><?= $lang['comp_reoperation_rfa'] ?></td></tr>
                    <tr><td><?= $lang['comp_metastasis'] ?></td><td><?= $lang['comp_metastasis_surg'] ?></td><td><?= $lang['comp_metastasis_rfa'] ?></td></tr>
                    <tr><td><?= $lang['comp_inoperable'] ?></td><td><?= $lang['comp_inoperable_surg'] ?></td><td><?= $lang['comp_inoperable_rfa'] ?></td></tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- ===================== EXPERT ===================== -->
<section class="section" id="expert">
    <div class="container">
        <h2 class="section-title"><?= $lang['expert_title'] ?></h2>

        <div class="expert-profile">
            <div class="expert-photo">
                <img src="images/nicolas-villard.jpg" alt="Dr Nicolas Villard — <?= $lang['expert_role'] ?>" width="280" height="374">
            </div>
            <div class="expert-info">
                <h2><?= $lang['expert_name'] ?></h2>
                <p class="role"><?= $lang['expert_role'] ?></p>
                <p><?= $lang['expert_text_1'] ?></p>
                <p><?= $lang['expert_text_2'] ?></p>
                <p><?= $lang['expert_text_3'] ?></p>
                <p><?= $lang['expert_text_4'] ?></p>
                <p><?= $lang['expert_text_5'] ?></p>
            </div>
        </div>

        <!-- Locations -->
        <h3 class="locations-heading"><?= $lang['expert_locations'] ?></h3>
        <div class="locations">
            <div class="location-block">
                <div class="location-city">
                    <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    <?= $lang['expert_location_ge_title'] ?>
                </div>
                <div class="location-entry">
                    <span class="location-label"><?= $current_lang === 'fr' ? 'Consultations & interventions' : 'Consultations & procedures' ?></span>
                    <p class="location-address"><strong>Clinique Générale Beaulieu</strong><br>Chemin de Beau-Soleil 20, 1206 <?= $current_lang === 'fr' ? 'Genève' : 'Geneva' ?></p>
                    <a href="https://maps.google.com/?q=Clinique+Générale+Beaulieu+Chemin+de+Beau-Soleil+20+1206+Genève" target="_blank" rel="noopener" class="location-map-link">
                        <svg viewBox="0 0 24 24" width="13" height="13"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                        Google Maps
                    </a>
                </div>
            </div>
            <div class="location-block">
                <div class="location-city">
                    <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    <?= $lang['expert_location_la_title'] ?>
                </div>
                <div class="location-entry">
                    <span class="location-label">Consultations</span>
                    <p class="location-address"><strong>Medbase Lausanne</strong><br>Place de la Gare 9a-11, 1003 Lausanne</p>
                    <a href="https://maps.google.com/?q=Medbase+Lausanne+Place+de+la+Gare+9a+1003+Lausanne" target="_blank" rel="noopener" class="location-map-link">
                        <svg viewBox="0 0 24 24" width="13" height="13"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                        Google Maps
                    </a>
                </div>
                <div class="location-entry">
                    <span class="location-label">Interventions</span>
                    <p class="location-address"><strong>Clinique Montchoisi</strong> · Chemin des Allinges 10, 1006 Lausanne</p>
                    <p class="location-address"><strong>Clinique Amiia</strong> · Rue Centrale 19, 1003 Lausanne</p>
                    <a href="https://maps.google.com/?q=Clinique+Montchoisi+Chemin+des+Allinges+10+1006+Lausanne" target="_blank" rel="noopener" class="location-map-link">
                        <svg viewBox="0 0 24 24" width="13" height="13"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                        Google Maps
                    </a>
                </div>
            </div>
        </div>

        <!-- Gallery -->
        <div class="expert-gallery">
            <div class="gallery-item">
                <img src="images/congres.jpg" alt="<?= $lang['expert_caption_congress'] ?>" loading="lazy">
                <div class="gallery-caption"><?= $lang['expert_caption_congress'] ?></div>
            </div>
            <div class="gallery-item">
                <img src="images/operation-1.jpg" alt="<?= $lang['expert_caption_operation'] ?>" loading="lazy">
                <div class="gallery-caption"><?= $lang['expert_caption_operation'] ?></div>
            </div>
            <div class="gallery-item">
                <img src="images/formation.jpg" alt="<?= $lang['expert_caption_training'] ?>" loading="lazy">
                <div class="gallery-caption"><?= $lang['expert_caption_training'] ?></div>
            </div>
        </div>
    </div>
</section>

<!-- ===================== FAQ ===================== -->
<section class="section section-alt" id="faq">
    <div class="container">
        <h2 class="section-title text-center"><?= $lang['faq_title'] ?></h2>
        <div class="faq-list">
            <?php foreach ($lang['faq'] as $faq_item): ?>
            <div class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <button class="faq-question" aria-expanded="false" itemprop="name">
                    <?= $faq_item['q'] ?>
                    <svg class="faq-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
                <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <div class="faq-answer-inner" itemprop="text"><?= $faq_item['a'] ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ===================== CONTACT CTA ===================== -->
<section class="cta-section" id="contact">
    <div class="container">
        <h2><?= $lang['contact_title'] ?></h2>
        <p><?= $lang['contact_text'] ?></p>
        <div class="cta-cards">
            <a href="tel:+41582553144" class="cta-card">
                <div class="cta-card-icon">
                    <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                </div>
                <span class="cta-card-label"><?= $lang['contact_phone'] ?></span>
                <span class="cta-card-value">+41 58 255 3 144</span>
            </a>
            <a href="mailto:secretariat@drvillard.ch" class="cta-card">
                <div class="cta-card-icon">
                    <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                </div>
                <span class="cta-card-label"><?= $lang['contact_email'] ?></span>
                <span class="cta-card-value">secretariat@drvillard.ch</span>
            </a>
            <a href="#rdv" class="cta-card cta-card-accent">
                <div class="cta-card-icon">
                    <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                </div>
                <span class="cta-card-label"><?= $current_lang === 'fr' ? 'En ligne' : 'Online' ?></span>
                <span class="cta-card-value"><?= $current_lang === 'fr' ? 'Réserver un créneau' : 'Book a slot' ?></span>
            </a>
        </div>
        <p class="cta-tip"><?= $lang['contact_tip'] ?></p>
    </div>
</section>

<!-- ===================== BOOKING WIDGET ===================== -->
<section class="section" id="rdv">
    <div class="container">
        <h2 class="section-title text-center"><?= $current_lang === 'fr' ? 'Prendre rendez-vous en ligne' : 'Book an appointment online' ?></h2>
        <p class="section-subtitle" style="text-align:center;margin:0 auto 32px;"><?= $current_lang === 'fr' ? 'Sélectionnez un créneau directement en ligne pour une consultation à Genève ou Lausanne.' : 'Select a time slot online for a consultation in Geneva or Lausanne.' ?></p>
        <iframe id="janus-widget"
            src="https://januswidget.villard.swiss/rendez-vous/dr/5?lang=<?= $current_lang ?>"
            style="width:100%;min-height:600px;border:none;border-radius:12px;"
            allowfullscreen=""
            title="<?= $current_lang === 'fr' ? 'Prise de rendez-vous en ligne' : 'Online appointment booking' ?>">
        </iframe>
    </div>
</section>

<!-- ===================== FOOTER ===================== -->
<footer class="footer">
    <div class="container">
        <p><?= $lang['footer_copyright'] ?></p>
        <p><?= $lang['footer_disclaimer'] ?></p>
        <p><a href="https://www.sciencedirect.com/science/article/pii/S2543343126000618" target="_blank" rel="noopener"><?= $lang['footer_reco'] ?></a></p>
        <p><a href="#privacy" class="privacy-link"><?= $current_lang === 'fr' ? 'Politique de confidentialité' : 'Privacy policy' ?></a></p>
    </div>
</footer>

<!-- ===================== COOKIE BANNER (nLPD / RGPD) ===================== -->
<div id="cookie-banner" class="cookie-banner" role="dialog" aria-label="<?= $current_lang === 'fr' ? 'Consentement cookies' : 'Cookie consent' ?>" style="display:none;">
    <div class="cookie-inner">
        <p>
            <?php if ($current_lang === 'fr'): ?>
                Ce site utilise des cookies strictement nécessaires à son fonctionnement. Aucun cookie de traçage ou publicitaire n'est utilisé. En poursuivant votre navigation, vous acceptez l'utilisation de ces cookies. <a href="#privacy" class="cookie-link">Politique de confidentialité</a>
            <?php else: ?>
                This site uses cookies strictly necessary for its operation. No tracking or advertising cookies are used. By continuing to browse, you accept the use of these cookies. <a href="#privacy" class="cookie-link">Privacy policy</a>
            <?php endif; ?>
        </p>
        <button id="cookie-accept" class="btn btn-blue" style="padding:10px 24px;font-size:0.9rem;"><?= $current_lang === 'fr' ? 'Accepter' : 'Accept' ?></button>
    </div>
</div>

<!-- ===================== PRIVACY POLICY MODAL ===================== -->
<div id="privacy" class="privacy-section" style="display:none;">
    <div class="container" style="padding:60px 24px;">
        <button class="privacy-close" onclick="document.getElementById('privacy').style.display='none';history.replaceState(null,'','/<?= $current_lang ?>');" aria-label="<?= $current_lang === 'fr' ? 'Fermer' : 'Close' ?>">&times;</button>
        <?php if ($current_lang === 'fr'): ?>
        <h2 class="section-title">Politique de confidentialité</h2>
        <p><strong>Responsable du traitement des données</strong><br>Dr Nicolas Villard — Versatile Imaging Sàrl<br>Genève / Lausanne, Suisse<br>Contact : <a href="mailto:secretariat@drvillard.ch">secretariat@drvillard.ch</a></p>
        <h3>Données collectées</h3>
        <p>Ce site ne collecte aucune donnée personnelle de manière active. Aucun formulaire de contact, aucun outil d'analyse (Google Analytics, etc.) et aucun cookie publicitaire ou de traçage ne sont utilisés. Seuls des cookies strictement nécessaires au fonctionnement du site (préférence de langue) peuvent être déposés.</p>
        <h3>Widget de prise de rendez-vous</h3>
        <p>Le widget de prise de rendez-vous intégré (Janus) est un service tiers. Les données que vous saisissez dans ce widget sont traitées par ce service conformément à sa propre politique de confidentialité. Le Dr Villard est responsable du traitement de ces données dans le cadre de la relation médecin-patient.</p>
        <h3>Vos droits</h3>
        <p>Conformément à la nouvelle Loi fédérale sur la protection des données (nLPD, Suisse) et au Règlement Général sur la Protection des Données (RGPD, UE/France), vous disposez d'un droit d'accès, de rectification, de suppression et de portabilité de vos données personnelles. Vous pouvez exercer ces droits en contactant <a href="mailto:secretariat@drvillard.ch">secretariat@drvillard.ch</a>.</p>
        <h3>Hébergement</h3>
        <p>Ce site est hébergé par Infomaniak Network SA, Genève, Suisse. Les données sont stockées exclusivement en Suisse.</p>
        <p><em>Dernière mise à jour : juin 2026</em></p>
        <?php else: ?>
        <h2 class="section-title">Privacy policy</h2>
        <p><strong>Data controller</strong><br>Dr Nicolas Villard — Versatile Imaging Sàrl<br>Geneva / Lausanne, Switzerland<br>Contact: <a href="mailto:secretariat@drvillard.ch">secretariat@drvillard.ch</a></p>
        <h3>Data collected</h3>
        <p>This site does not actively collect any personal data. No contact forms, no analytics tools (Google Analytics, etc.) and no advertising or tracking cookies are used. Only cookies strictly necessary for the site's operation (language preference) may be stored.</p>
        <h3>Appointment booking widget</h3>
        <p>The integrated appointment booking widget (Janus) is a third-party service. The data you enter in this widget is processed by this service in accordance with its own privacy policy. Dr Villard is responsible for processing this data within the doctor-patient relationship.</p>
        <h3>Your rights</h3>
        <p>In accordance with the Swiss Federal Data Protection Act (nFADP) and the General Data Protection Regulation (GDPR, EU/France), you have the right to access, rectify, delete and port your personal data. You may exercise these rights by contacting <a href="mailto:secretariat@drvillard.ch">secretariat@drvillard.ch</a>.</p>
        <h3>Hosting</h3>
        <p>This site is hosted by Infomaniak Network SA, Geneva, Switzerland. Data is stored exclusively in Switzerland.</p>
        <p><em>Last updated: June 2026</em></p>
        <?php endif; ?>
    </div>
</div>

<script src="js/main.js"></script>
<script>
window.addEventListener('message', function(e) {
    if (e.data && e.data.type === 'janus-resize') {
        document.getElementById('janus-widget').style.height = e.data.height + 'px';
    }
    if (e.data && e.data.type === 'janus-step-change') {
        var el = document.getElementById('rdv');
        if (el) el.scrollIntoView({behavior: 'smooth', block: 'start'});
    }
});
</script>
</body>
</html>
