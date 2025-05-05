# Affiliate Reader (Laravel)

This Laravel application reads affiliate data from a text file, filters affiliates based on their geographic proximity to Dublin, and displays them in a web interface.

---

## Features

- File upload form for `.txt` files with affiliate data
- Filters affiliates within 100km of Dublin (53.3340285, -6.2535495)
- Displays sorted affiliate list by ID
- Gracefully handles invalid or empty files
- Comes with unit and feature tests
- Simple frontend with no usage of any JS frameworks

---

## Affiliate File Format

The uploaded file must be a `.txt` file with newline-delimited JSON entries.  
Each line should follow this format:

```json
{"latitude": "52.986375", "affiliate_id": 12, "name": "Yosef Giles", "longitude": "-6.043701"}
{"latitude": "51.92893", "affiliate_id": 1, "name": "Lance Keith", "longitude": "-10.27699"}
```
---

## Installation

```bash
git clone <your-repo-url>
cd affiliate-reader
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate

```

---

## Running Tests

This project includes both unit and feature tests.

Run all tests using the following command:

```bash
php artisan test
```
### Test Coverage

- Valid file uploads
- Empty file rejection
- Invalid JSON line handling
- Service logic (distance calculation and filtering)
