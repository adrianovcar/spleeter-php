# Spleeter PHP

[![Docker Image CI](https://github.com/adrianovcar/spleeter-php/actions/workflows/docker-image.yml/badge.svg?branch=main)](https://github.com/adrianovcar/spleeter-php/actions/workflows/docker-image.yml)
[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](https://opensource.org/licenses/MIT)
[![Maintenance](https://img.shields.io/badge/Maintained%3F-yes-green.svg)](https://GitHub.com/Naereen/StrapDown.js/graphs/commit-activity)
[![GitHub release](https://badgen.net/github/release/adrianovcar/spleeter-php)](https://GitHub.com/adrianovcar/spleeter-php/realease/)

**Implementation of deezer/spleeter using Vanilla PHP, recommended to separate songs instruments on "bulk" mode**

*[Spleeter](https://github.com/deezer/spleeter) is Deezer source separation library with pretrained models written in Python and uses Tensorflow. It makes it easy to train source separation model (assuming you have a dataset of isolated sources), and provides already trained state of the art model for performing various flavour of separation.*

This app was developed to create an easy way to separate instruments from audio files, using a web-based interface, turning it possible for non-technician users to create stems from batch files.

(If you need to persist your songs history, I recomend you take a look at https://github.com/ahmedash95/audio-spleeter) 

---
## Dependencies

You just need to have Docker installed on your computer

---

## Running the app

1. `docker build . -t spleeter-php`
2. `docker run --name spleeter-php -p 81:80 --mount type=bind,source="$(pwd)",target=/var/www/html -d spleeter-php`
3. By default, php-spleeter will be looking for audio files over the `./audio-files` folder
4. Click the button to process the files
5. Files processed will be on `./audio-files-processed` folder
6. Use interface controls to personalize the spleeter options

---

## Next steps

- [ ] Improve interface UX
- [ ] Add evaluate option on interface
- [ ] Create automated way to training AI models

---

## License
The code of Spleeter is [MIT-licensed](https://github.com/deezer/spleeter/blob/master/LICENSE).

--- 
## Contributing
I'll appreciate any kind of help \o/

---
## Reference
* Deezer Research - Source Separation Engine Story - deezer.io [blog post](https://deezer.io/releasing-spleeter-deezer-r-d-source-separation-engine-2b88985e797e)
* Music Source Separation tool with pre-trained models / ISMIR2019 extended abstract [link](http://archives.ismir.net/ismir2019/latebreaking/000036.pdf)

```BibTeX
@article{spleeter2020,
doi = {10.21105/joss.02154},
url = {https://doi.org/10.21105/joss.02154},
year = {2020},
publisher = {The Open Journal},
volume = {5},
number = {50},
pages = {2154},
author = {Romain Hennequin and Anis Khlif and Felix Voituret and Manuel Moussallam},
title = {Spleeter: a fast and efficient music source separation tool with pre-trained models},
journal = {Journal of Open Source Software},
note = {Deezer Research}
}
```
