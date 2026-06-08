<?php
$supported_langs = ['fr', 'en'];
$current_lang = isset($_GET['lang']) && in_array($_GET['lang'], $supported_langs) ? $_GET['lang'] : 'fr';
require_once __DIR__ . '/lang/' . $current_lang . '.php';
$base_url = 'https://nodule-thyroide.ch';
$other_lang_url = '?lang=' . $lang['other_lang'];
$canonical = $current_lang === 'fr' ? $base_url : $base_url . '?lang=en';
?>
<!DOCTYPE html>
<html lang="<?= $lang['lang_code'] ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $lang['site_title'] ?></title>
    <meta name="description" content="<?= $lang['meta_description'] ?>">
    <meta name="keywords" content="<?= $lang['meta_keywords'] ?>">
    <link rel="canonical" href="<?= $canonical ?>">
    <link rel="alternate" hreflang="fr" href="<?= $base_url ?>">
    <link rel="alternate" hreflang="en" href="<?= $base_url ?>?lang=en">
    <link rel="alternate" hreflang="x-default" href="<?= $base_url ?>">

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
                "priceRange": "Pris en charge LAMal",
                "address": [
                    {
                        "@type": "PostalAddress",
                        "addressLocality": "Genève",
                        "addressRegion": "GE",
                        "addressCountry": "CH"
                    },
                    {
                        "@type": "PostalAddress",
                        "addressLocality": "Lausanne",
                        "addressRegion": "VD",
                        "addressCountry": "CH"
                    }
                ],
                "geo": {
                    "@type": "GeoCoordinates",
                    "latitude": 46.2044,
                    "longitude": 6.1432
                },
                "areaServed": "Suisse Romande"
            }
        ]
    }
    </script>
</head>
<body>

<!-- ===================== HEADER ===================== -->
<header class="header" role="banner">
    <div class="header-inner">
        <a href="?lang=<?= $current_lang ?>" class="logo">nodule-thyroide<span>.ch</span></a>
        <nav class="nav" role="navigation" aria-label="<?= $current_lang === 'fr' ? 'Navigation principale' : 'Main navigation' ?>">
            <a href="#thyroide"><?= $lang['nav_thyroid'] ?></a>
            <a href="#nodules"><?= $lang['nav_nodules'] ?></a>
            <a href="#traitements"><?= $lang['nav_treatments'] ?></a>
            <a href="#comparaison"><?= $lang['nav_comparison'] ?></a>
            <a href="#expert"><?= $lang['nav_expert'] ?></a>
            <a href="#faq"><?= $lang['nav_faq'] ?></a>
            <a href="#contact" class="nav-cta"><?= $lang['nav_contact'] ?></a>
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
                <a href="#contact" class="btn btn-primary"><?= $lang['hero_cta'] ?></a>
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
        <div class="content-with-image reverse mt-40">
            <div>
                <h3 class="section-title" style="font-size:1.3rem;"><?= $lang['followup_title'] ?></h3>
                <div class="content-block">
                    <p><?= $lang['followup_text_1'] ?></p>
                    <p><?= $lang['followup_text_2'] ?></p>
                    <p><?= $lang['followup_text_3'] ?></p>
                    <p><?= $lang['followup_text_4'] ?></p>
                    <p><?= $lang['followup_text_5'] ?></p>
                </div>
            </div>
            <div class="content-image">
                <img src="images/evolution-nodule.png" alt="<?= $current_lang === 'fr' ? 'Évolution d\'un nodule thyroïdien après traitement par radiofréquence : réduction progressive de la taille' : 'Thyroid nodule evolution after radiofrequency treatment: progressive size reduction' ?>" width="700" height="200" loading="lazy">
            </div>
        </div>

        <!-- Side effects -->
        <div class="mt-40">
            <h3 class="section-title" style="font-size:1.3rem;"><?= $lang['side_effects_title'] ?></h3>
            <p class="mb-40" style="font-weight:500;color:var(--success);"><?= $lang['side_effects_intro'] ?></p>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                <div class="nodule-card" style="border-left-color:var(--accent-light);">
                    <h3 style="font-size:1.05rem;"><?= $lang['side_effect_1_title'] ?></h3>
                    <p><?= $lang['side_effect_1_text'] ?></p>
                </div>
                <div class="nodule-card" style="border-left-color:var(--accent-light);">
                    <h3 style="font-size:1.05rem;"><?= $lang['side_effect_2_title'] ?></h3>
                    <p><?= $lang['side_effect_2_text'] ?></p>
                </div>
                <div class="nodule-card" style="border-left-color:var(--accent-light);">
                    <h3 style="font-size:1.05rem;"><?= $lang['side_effect_3_title'] ?></h3>
                    <p><?= $lang['side_effect_3_text'] ?></p>
                </div>
                <div class="nodule-card" style="border-left-color:var(--success);">
                    <h3 style="font-size:1.05rem;"><?= $lang['side_effect_4_title'] ?></h3>
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
        <h3 style="font-size:1.2rem; font-weight:700; color:var(--primary); margin-bottom:20px;"><?= $lang['expert_locations'] ?></h3>
        <div class="locations">
            <div class="location-card">
                <div class="location-icon">
                    <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                </div>
                <p><strong>Genève</strong><br><?= $lang['expert_location_ge'] ?></p>
            </div>
            <div class="location-card">
                <div class="location-icon">
                    <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                </div>
                <p><strong>Lausanne</strong><br><?= $lang['expert_location_la'] ?></p>
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
        <div class="cta-contact-info">
            <div class="cta-contact-item">
                <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                <span><?= $lang['contact_phone'] ?> : <a href="tel:+41000000000">+41 00 000 00 00</a></span>
            </div>
            <div class="cta-contact-item">
                <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                <span><?= $lang['contact_email'] ?> : <a href="mailto:contact@nodule-thyroide.ch">contact@nodule-thyroide.ch</a></span>
            </div>
        </div>
        <p class="cta-tip"><?= $lang['contact_tip'] ?></p>
    </div>
</section>

<!-- ===================== FOOTER ===================== -->
<footer class="footer">
    <div class="container">
        <p><?= $lang['footer_copyright'] ?></p>
        <p><?= $lang['footer_disclaimer'] ?></p>
        <p><a href="https://www.sciencedirect.com/science/article/pii/S2543343126000618" target="_blank" rel="noopener"><?= $lang['footer_reco'] ?></a></p>
    </div>
</footer>

<script src="js/main.js"></script>
</body>
</html>
