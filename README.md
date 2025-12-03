# VIN Decoder API

A lightweight, extensible REST API for decoding Vehicle Identification Numbers (VIN) written in **Laravel**.  
The project demonstrates clean architecture, separation of concerns, dependency injection, API design, and domain-driven modelling.

VIN Decoder API extracts structured information from a VIN number such as:

- WMI (World Manufacturer Identifier)
- Manufacturer name
- Vehicle attributes (VDS)
- Production data (VIS)
- Region of origin
- Model year

…and organizes this data into a clean, structured response.

---

## Features

- Decode VIN and extract core vehicle information
- Validate VIN format (length + forbidden characters)
- Derive model year from standard VIN year code
- Identify geographic region from VIN prefix
- Manufacturer lookup based on WMI code
- Clean and extensible architecture
- Centralized repository for manufacturer data
- Fully JSON based REST API
- Easy to extend with new providers or data sources

---

## Tech Stack

- **PHP 8.2+**
- **Laravel 12**
- **MySQL**
- Composer
- PHPUnit

---

## Architecture

The project emphasizes **clean code**, **maintainability**, and **predictable data flow**.

Key components:

- `VinDecoderService` – core business logic
- `VinManufacturerRepository` – data lookup
- `VinManufacturer` – database model
- `VinDecodeRequest` – validation
- API controller – single-action endpoint

```
app/
  Http/
    Controllers/Api/VinDecodeController.php
    Requests/VinDecodeRequest.php
  Models/
    VinManufacturer.php
  Repositories/
    VinManufacturerRepository.php
  Services/
    VinDecoderService.php
```

All dependencies are injected and unit-testable.  
The codebase is small, readable, and intentionally modular.

---

## API Usage

### Endpoint

```http
POST /api/vin/decode
Content-Type: application/json
```

### Request body

```json
{
  "vin": "WVWZZZ1JZXW000001"
}
```

### Response

```json
{
  "data": {
    "vin": "WVWZZZ1JZXW000001",
    "wmi": "WVW",
    "vds": "ZZZ1JZ",
    "vis": "XW000001",
    "region": "Europe",
    "manufacturer": "Volkswagen",
    "model_year": 1999,
    "serial": "000001"
  }
}
```

---

## Error Responses

### Invalid VIN format

```json
{
  "message": "The vin field is invalid.",
  "errors": {
    "vin": [
      "VIN must be exactly 17 characters.",
      "VIN contains forbidden characters."
    ]
  }
}
```

---

## Business Logic

### VIN validation:

- 17 characters
- Uppercase alphanumeric
- No `I`, `O`, `Q`

### Model year decoding:

Based on standard VIN year codes.

### Region detection:

Mapped to continent by first character.

### Manufacturer lookup:

Lookup by WMI using repository:

```php
$repo->findByWmi('WVW'); // returns model or null
```

---

## Extensibility

This project is designed to be extended.

Ideas:

- Integration with external VIN APIs
- Rich vehicle attributes (engine, transmission, body type)
- Caching layer for high throughput
- Admin panel to manage manufacturers
- Authentication (Sanctum / OAuth)
- Swagger / OpenAPI docs
- VIN scanning mobile app

Architecture supports:

- Multiple data providers
- Database or config-based lookups
- Swappable repositories via DI

---

## Installation

```bash
git clone https://github.com/your-user/vin-decoder-api.git
cd vin-decoder-api

composer install

cp .env.example .env
php artisan key:generate

php artisan migrate --seed

php artisan serve
```

Default URL:

```
http://localhost:8000
```

---

## Example cURL

```bash
curl -X POST http://localhost:8000/api/vin/decode   -H "Content-Type: application/json"   -d '{"vin":"WVWZZZ1JZXW000001"}'
```

---

## Testing

```bash
php artisan test
```

(or Pest)

---

## Why This Project

This project was built to demonstrate:

- Clean REST API design
- Domain-driven composition
- Proper use of repositories and services
- Predictable and testable architecture
- Practical automotive-related logic
- Lightweight but real-world domain

It's a great example of solving a non-trivial problem in a **simple yet professional way**.

Recruiters and developers can quickly scan the repo and understand both:
- What the app does
- How well the code is structured

---

## Future Roadmap

- Decode check digit and validate checksum
- Decode engine/body/trim
- Decode market-specific info (NA/EU/JDM)
- Manufacturer dashboard
- Frontend UI (Vue / React / Blade)
- Mobile app demo with scanning

---

## Contributing

Pull requests are welcome.  
If you discover incorrectly decoded VINs, feel free to report them.

---

## License

MIT

---

# Summary

A clean, extensible VIN decoder service built with Laravel, showcasing:

- Modular architecture  
- Separation of concerns  
- Real business logic  
- Expandable manufacturer database  
- Useful API design  

Perfect foundation for bigger automotive software projects.
