````markdown
# Informator dla wędkarza

Projekt zaliczeniowy wykonany w ramach przedmiotu **Metodologia Tworzenia Projektów Informatycznych** na kierunku Informatyka Stosowana.

Aplikacja jest prostym serwisem internetowym dla wędkarzy odwiedzających jeziora Suwalszczyzny i okolic Augustowa.

## Autorzy

- Kamil Żero
- Marek Najbuk
- Marek Palinowski

## Opis projektu

Serwis zawiera podstawowe informacje przydatne dla wędkarzy:

- jeziora regionu,
- gatunki ryb,
- okresy ochronne,
- opłaty i zezwolenia,
- sklepy wędkarskie,
- formularz kontaktowy,
- opis projektu w PDF.

Projekt został wykonany jako statyczna strona WWW.

## Technologie

- HTML5
- CSS3
- JavaScript
- Raspberry Pi
- Raspberry Pi OS / Raspbian
- Apache HTTP Server
- Docker

## Struktura projektu

```text
projekt/
├── index.html
├── jeziora.html
├── ryby.html
├── ochrona.html
├── oplaty.html
├── sklepy.html
├── kontakt.html
├── opis-projektu.pdf
├── css/
│   └── style.css
└── js/
    └── script.js
````

## Uruchomienie lokalne

Wystarczy otworzyć plik:

```text
index.html
```

w dowolnej przeglądarce internetowej.

## Instalacja na Raspberry Pi z Apache

Aktualizacja systemu:

```bash
sudo apt update
sudo apt upgrade -y
```

Instalacja Apache:

```bash
sudo apt install apache2 -y
```

Skopiowanie plików projektu:

```bash
sudo cp -r * /var/www/html/
```

Restart Apache:

```bash
sudo systemctl restart apache2
```

Strona będzie dostępna pod adresem IP Raspberry Pi, np.:

```text
http://adres-ip-raspberry-pi
```

## Uruchomienie w Dockerze

Utwórz plik `Dockerfile`:

```dockerfile
FROM nginx:alpine
COPY . /usr/share/nginx/html
EXPOSE 80
```

Budowanie obrazu:

```bash
docker build -t informator-wedkarza .
```

Uruchomienie kontenera:

```bash
docker run -d --name informator-wedkarza -p 80:80 informator-wedkarza
```

Strona będzie dostępna pod adresem:

```text
http://adres-ip-serwera
```

## Dostępność WCAG

W projekcie dodano proste funkcje dostępności:

* powiększanie czcionki,
* tryb wysokiego kontrastu.

Funkcje zostały wykonane w JavaScript.

## Adres wdrożenia

```text
http://212.33.72.196
```

## Licencja

Projekt wykonany wyłącznie do celów edukacyjnych.

```
```
