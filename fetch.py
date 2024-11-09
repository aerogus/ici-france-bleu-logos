#!/usr/bin/env python3

##
# Scrapper des logos ICI (ex France Bleu)
# ne marche pas car chargement dynamique en JS de l'image
# cf. fetch.php pour autre méthode
##

from bs4 import BeautifulSoup
import requests, sys

f = open("links.html", "r")
html = f.read()

soup_links = BeautifulSoup(html, 'html.parser')

for link in soup_links.select('html > body > a'):
    url = link['href']
    print(url)
    r = requests.get(url)
    soup_img = BeautifulSoup(r.content, 'html.parser')
    for item in soup_img.select('.svelte-oim9cc'):
        print(item['src'])
