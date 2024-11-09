#!/usr/bin/env php
<?php
/**
 * Récupération des logos ICI 2025 (ex France Bleu)
 */

const BASE_URL = 'https://www.francebleu.fr/client/immutable/chunks/';

// cf. https://www.francebleu.fr/client/immutable/chunks/BrandBanner.B7JIZlo0.js
const LOCALES = [
    "alsace.5panSrLE.js",
    "armorique.B4YDXwwq.js",
    "auxerre.CYvXLdH6.js",
    "azur.DzJCRFL6.js",
    "bearn.DIa2jq_l.js",
    "belfort-montbeliard.C2rzywtX.js",
    "berry.CIjGhJr3.js",
    "besancon.MNjz1uVn.js",
    "bourgogne.CMD9kxm2.js",
    "breizh-izel.DtB_9CXB.js",
    "champagne-ardenne.v57OpnYf.js",
    "contentin.DKfQawfe.js",
    "creuse.D6Sv0UlA.js",
    "drome-ardeche.BAapcZZo.js",
    "elsass.B_3ySmmo.js",
    "gard-lozere.DuzudyYb.js",
    "gascogne.CdU0IeAg.js",
    "gironde.Ckr0N1MB.js",
    "herault.CN5ZvH3Y.js",
    "isere.CN1ZGR3r.js",
    "la-rochelle.Bfu_cREL.js",
    "limousin._4Mo37BM.js",
    "loire-ocean.BzcayGIr.js",
    "lorraine-nord.CkicoU6w.js",
    "lorraine.Du7YeETi.js",
    "maine.CeZCiuDD.js",
    "mayenne.CmMM1yq3.js",
    "nord.DE3dNZMs.js",
    "normandie.n105lTs8.js",
    "occitanie.Ct_pH5K0.js",
    "orleans.BtZy2xSn.js",
    "paris.Db4OrYkP.js",
    "pays-basque.Dd6MMdnC.js",
    "pays-d-auvergne.WL3PRZ4s.js",
    "pays-de-savoie.I_fYUwbw.js",
    "perigord.Dz6TxTt-.js",
    "picardie.Cz4Nkdtl.js",
    "poitou.CikcELNb.js",
    "provence.DIwe1T0m.js",
    "rcfm.CIwQG8RD.js",
    "roussillon.BFx33QIZ.js",
    "saint-etienne-loire.WI122P_S.js",
    "sud-lorraine.C_BReyHo.js",
    "touraine.BJWdejOY.js",
    "vaucluse.BwPHQ7Lq.js",
];

foreach (LOCALES as $locale) {
    $url = BASE_URL . $locale;
    echo $url . "\n";
    $slug = explode('.', $locale)[0];
    $content = file_get_contents($url);
    $data = explode('"', $content);
    $output = __DIR__ . '/logos/' . $slug . '.png';
    if (!is_dir(dirname($output))) {
        mkdir(dirname($output));
    }	
    if (str_starts_with($data[0], 'const A')) {
        // cas n°1 : encodé base64
        list($type, $data) = explode(';', $data[1]);
        list(, $data)      = explode(',', $data);
        echo "img base64\n";
        file_put_contents($output, base64_decode($data));
    } else {
        // cas n°2 : référence vers url
        $url = BASE_URL . $data[3];
        $url = str_replace('chunks/..', '', $url);
        echo "url img: " . $url . "\n";
        $img = file_get_contents($url);
        file_put_contents($output, $img);
    }
    sleep(2);
}
