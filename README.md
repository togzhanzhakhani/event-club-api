# Event Club API

Backend REST API for a multi-city **event discovery and attendance platform**, where users can browse, register for, and attend daily events such as meetups, workshops, festivals, hackathons, and talks.

All events are created and managed centrally via admin panel, and users consume events through a mobile application.

---

## Tech Stack

- PHP 8.1+
- Laravel 10
- Laravel Sanctum (API authentication)
- MySQL / PostgreSQL
- Queue system (Database / Redis)
- RESTful API
- API-first architecture (mobile-focused)

---

## Business Concept

- The platform operates multiple **venues** across different **cities**
- Each venue contains multiple **halls**
- Events are held **daily and hourly** in different halls
- Users can:
  - Browse free and paid events
  - Filter events by city, category, date
  - Register for events
- All events, content, and schedules are managed by administrators
---

## System Architecture

The project follows a **clean and scalable architecture** with clear separation of concerns.

### Directory Structure
```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Api/
│   │   │   ├── AuthController.php
│   │   │   ├── EventController.php
│   │   │   ├── EventRegistrationController.php
│   │   │   ├── MetaController.php
│   │   │   ├── PostController.php
│   │   │   └── ProfileController.php
│   ├── Requests/
│   │   │   ├── LoginRequest.php
│   │   │   └── RegisterRequest.php
│   ├── Resources/
│   │   ├── CityResource.php
│   │   ├── EventCategoryResource.php
│   │   ├── EventResource.php
│   │   ├── EventDatailResource.php
│   │   ├── PostResource.php
│   │   └── ProfileResource.php
├── Models/
│   ├── User.php
│   ├── Event.php
│   ├── EventCategory.php
│   ├── EventRegistration.php
│   ├── Post.php
│   ├── City.php
│   ├── Venue.php
│   └── Hall.php
├── Jobs/
│   ├── DailyEventGeneratorJob.php
└── Console/
    └── Kernel.php (cron jobs)
```

### Architectural Principles

- **Thin controllers** — no business logic inside controllers
- **FormRequest validation** — all request validation is centralized
- **Jobs & queues** — heavy and scheduled logic is asynchronous
- **API Resources** — consistent response formatting

---

## Domain Model Overview

### Geography
- **City** — supported cities
- **Venue** — physical locations in a city
- **Hall** — spaces inside venues where events take place

### Events
- **EventCategory** — tech, business, art, festival, etc.
- **Event** — scheduled activity with date, time, hall, and category
- **EventRegistration** — user registration and attendance tracking

### Users
- **User** — application user (mobile client)
- Authentication via **Laravel Sanctum**

### Content
- **Post** — news, announcements, articles
---

## Background Jobs & Cron Tasks

The system relies heavily on scheduled background jobs.

### Daily Scheduled Jobs

- **DailyEventPreparationJob**
  - Aggregates events scheduled for the next day
  - Generates internal preparation reports (attendance, services)

All cron tasks are configured via Laravel Scheduler and executed asynchronously using queues.

---

## Authentication

- Token-based authentication using **Laravel Sanctum**
- Designed for mobile clients
- Protected routes require valid API token

---

## API Endpoints

### Authentication
```
POST   /api/register         
POST   /api/login            
```

### Events
```
GET    /api/events           
GET    /api/events/{id}      
POST   /api/events/{id}/register  
```

### Posts
```
GET    /api/posts          
GET    /api/posts/{id}     
```

### Profile
```
GET    /api/profile        
PUT    /api/profile
```
---

## Validation & Data Flow

- All incoming requests are validated using **FormRequest** classes
- Responses are returned via **API Resources**

This approach improves:
- Maintainability
- Testability
- Readability
- Scalability

---

## Payments (Mock Implementation)

Paid events and additional services use a **mock payment provider**.

- No real financial transactions
- Simulated payment intents and callbacks
- Designed to demonstrate payment flow architecture

---

## Client Applications

This API is designed to be consumed by:
- Mobile application (Flutter)
- Admin panel (Voyager)

---

## Environment Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve