#!/usr/bin/env bash

for file in ./logos/*.png; do
    echo "$file"
    magick convert "${file}" -trim -background none -resize 300x95 "${file}-300.png"
    magick convert "${file}" -trim -background white -resize 90x80 -gravity center -extent 100x80 "${file}-100.jpg"
done
