# Récupération des logos ICI (ex France Bleu)

![logos](logos.jpg)

## Méthode 1

cf. `fetch.py` + `links.html`

puis cibler `img.svelte-oim9cc`, l'attribut `src` contient une `image/png` encodée en `base64`
sauvegarder avec le nom du répertoire l'uri + .png, ex: `mayenne.png`

Prérequis: interpréteur `python3`

### Installation

```
python3 -m venv .venv
. ./.venv/bin/activate
pip3 install -r requirements.txt
```

Ne marche pas car page chargée dynamiquement en js, il faudrait utiliser un outil de navigateur headless pour aller plus loin.

## Méthode 2

cf. `fetch.php`

Prérequis: interpréteur `php`

La ressource suivante référence un tableau des js spécifiques à chaque locale

https://www.francebleu.fr/client/immutable/chunks/BrandBanner.B7JIZlo0.js

Le js dédié a ce type d'url https://www.francebleu.fr/client/immutable/chunks/alsace.5panSrLE.js

Dans ce script on a 2 cas à traiter :

- un fichier png encodé en base64
- une référence vers une url d'un png

## Notes

Particularités trouvées:

- contentin -> cotentin
- normandie-rouen -> normandie
- normandie-caen -> normandie
- toulouse -> occitanie
- 107-1 -> paris
