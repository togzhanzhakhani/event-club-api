# Event Club API

Backend REST API for a multi-city **event discovery and attendance platform**, where users can browse, register for, and attend daily events such as meetups, workshops, festivals, hackathons, and talks.

The system follows a **membership-based club model** (similar to fitness club applications), where all events are created and managed centrally via admin panel, and users consume events through a mobile application.

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
  - Participate in competitions and promotions
- All events, content, and schedules are managed by administrators

This model is inspired by **club-based systems** (e.g. gym memberships), but applied to event discovery and attendance.

---

## System Architecture

The project follows a **clean and scalable architecture** with clear separation of concerns.

### Directory Structure

app/
├── DTO/ # Data Transfer Objects
├── Enums/ # Enum classes (statuses, types)
├── Actions/ # Single-responsibility domain actions
├── Services/ # Business logic layer
├── Jobs/ # Background jobs (cron, queues)
├── Models/ # Eloquent models
├── Http/
│ ├── Controllers/ # Thin API controllers
│ ├── Requests/ # FormRequest validation
│ ├── Resources/ # API response transformers
│ └── Middleware/
database/
├── migrations/
├── seeders/
routes/
├── api.php

### Architectural Principles

- **Thin controllers** — no business logic inside controllers
- **Service layer** — core domain logic lives in Services
- **DTOs** — structured data passed between layers
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
- **Media** — polymorphic media storage (images, files)

### Gamification
- **Competition** — contests, raffles, promotions
- **CompetitionEntry** — user participation and winners

---

## Background Jobs & Cron Tasks

The system relies heavily on scheduled background jobs.

### Daily Scheduled Jobs

- **DailyEventPreparationJob**
  - Aggregates events scheduled for the next day
  - Generates internal preparation reports (attendance, services)

- **MembershipExpirationJob**
  - Checks expired memberships
  - Updates statuses and sends notifications

- **CompetitionResolutionJob**
  - Finalizes competitions
  - Selects winners
  - Sends notifications

- **ContentAutoPublishJob**
  - Automatically publishes scheduled posts

All cron tasks are configured via Laravel Scheduler and executed asynchronously using queues.

---

## Authentication

- Token-based authentication using **Laravel Sanctum**
- Designed for mobile clients
- Protected routes require valid API token

---

## API Design

- RESTful endpoints
- JSON responses
- Version-ready structure
- Consistent error handling
- Resource-based response formatting

Example endpoints:

GET /api/cities
GET /api/events
GET /api/events/{id}
POST /api/events/{id}/register
GET /api/me/events

---

## Validation & Data Flow

- All incoming requests are validated using **FormRequest** classes
- Validated data is mapped to **DTOs**
- Business logic is executed in **Services**
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

## 📱 Client Applications

This API is designed to be consumed by:
- Mobile application (Flutter)
- Admin panel (future scope)

---

## Environment Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve