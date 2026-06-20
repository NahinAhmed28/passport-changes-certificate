# Passport Changes Certificate

Passport Changes Certificate is a Laravel-based application for handling passport change certificate workflows, records, and administrative processing.

## Features

- Certificate request and processing workflow
- Applicant data collection and status tracking
- Admin review and certificate management
- Database-backed application records
- Document upload or generated certificate support when implemented

## Modules

- Applicant module: applicant information and request details
- Certificate module: certificate records, statuses, and output generation
- Admin module: review, approval, rejection, and management screens
- Document module: supporting files or generated PDFs when enabled
- Reporting module: searchable records, filters, and exports

## System Architecture

The system follows Laravel MVC structure. Users or staff submit certificate-related requests through forms. Controllers validate and manage workflow state. Models store applicants, requests, certificate records, and supporting metadata. Optional document-generation services can create printable certificates. Environment settings configure database, storage, and mail services.

## Getting Started

```bash
git clone https://github.com/NahinAhmed28/passport-changes-certificate.git
cd passport-changes-certificate
composer install
cp .env.example .env
php artisan key:generate
npm install
npm run dev
php artisan serve
```
