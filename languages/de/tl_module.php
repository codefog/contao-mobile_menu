<?php

/**
 * mobile_menu extension for Contao Open Source CMS
 *
 * Copyright (C) 2011-2017 Codefog
 *
 * @package mobile_menu
 * @author  Codefog <http://codefog.pl>
 * @author  Kamil Kuzminski <kamil.kuzminski@codefog.pl>
 * @author  Didier Federer <d.federer@designpilot.ch>
 * @author  Joachim Scholtysik <info@bitsandmedia.de>
 * @license LGPL
 */

/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_phones'] = [
    'Auf Smartphones anzeigen',
    'Zeigt das Menü auf Smartphones an (Max. Breite: 767px).',
];
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_tablets'] = [
    'Auf Tablets anzeigen',
    'Zeigt das Menü auf Tablets an (Max. Breite: 991px).',
];
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_breakpoint'] = [
    'Individueller Breakpoint (px)',
    'Hier können Sie einen individuellen Breakpoint in Pixel eingeben, bei dem das Menü angezeigt werden soll. Dieser Wert überschreibt die oben vordefinierten Breakpoints für Smartphones und Tablets!',
];
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_disableNavigation'] = [
    'Zusammenklappbare Navigation deaktivieren',
    'Deaktiviert die Eigenschaft, die Navigation standardmäßig zusammenklappen zu können (nicht empfohlen).',
];
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_parentTogglers'] = [
    'Eltern-Menüpunkte nur als Toggler verwenden',
    'Bewirkt, dass die Menüpunkte mit Untermenüs nur als Toggler verwendet werden können. Damit ist es nicht möglich, eine Seite mit Untermenüs durch Klick auszuwählen.',
];
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_closeOnLinkClick'] = [
    'Menü beim Klick auf einen Link schließen.',
    'Schließt das Menü, wenn ein Link darin angeklickt wird. Das ist besonders hilfreich beim Scrollen in einer One-Page Navigation.',
];
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_position'] = [
    'Position',
    'Hier können Sie die Menüposition auswählen.',
];
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_size'] = [
    'Individuelle Menügröße (%)',
    'Hier können Sie die individuelle Menübreite oder -höhe in % eingeben.',
];
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_overlay'] = [
    'Overlay aktivieren',
    'Aktivieren des Overlays über den Inhalt, wenn das Menü aktiv ist.',
];
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_offCanvas'] = [
    'Off Canvas Effekt',
    'Den Off Canvas Effekt verwenden, wenn das Menü aktiv ist.',
];
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_noShadow'] = [
    'Menüschatten deaktivieren',
    'Deaktivieren des Menüschattens, wenn das Menü aktiv ist.',
];
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_animation'] = [
    'Animation aktivieren',
    'Aktvivieren der Animation für die Anzeige und das Verstecken des Menüs.',
];
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_animationSpeed'] = [
    'Animationsgeschwindigkeit (ms)',
    'Hier können Sie die Animationsgeschwindigkeit des Menüs eingeben (1000ms = 1 Sekunde).',
];
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_trigger'] = [
    'Trigger Inhalt',
    'Hier können Sie den HTML Inhalt des Triggers hinzufügen.',
];
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_html'] = [
    'Menu Inhalt',
    'Hier können Sie den HTML Inhalt des Menüs hinzufügen.',
];
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_keepInPlace']   = [
    'Menü an der Position behalten',
    'Bewege das Menü nicht ans Ende des &lt;body&gt; Elementes. <strong>Hinweis:</strong> Diese Einstellung ist für Nutzer, die das Standardverhalten des Menüs ändern möchten.'
];

/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_position']['left'] = 'Links';
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_position']['right'] = 'Rechts';
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_position']['top'] = 'Oben';
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_position']['bottom'] = 'Unten';

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_display_legend'] = 'Anzeigeeinstellungen';
$GLOBALS['TL_LANG']['tl_module']['mobile_menu_design_legend'] = 'Darstellungseinstellungen';
