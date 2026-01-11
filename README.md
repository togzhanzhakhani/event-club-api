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
```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Api/
│   │   │   ├── AuthController.php
│   │   │   ├── EventController.php
│   │   │   ├── CompetitionController.php
│   │   │   ├── PostController.php
│   │   │   └── ProfileController.php
│   ├── Requests/
│   │   ├── Auth/
│   │   │   ├── LoginRequest.php
│   │   │   └── RegisterRequest.php
│   │   ├── Event/
│   │   │   ├── StoreEventRequest.php
│   │   │   └── RegisterEventRequest.php
│   │   └── Competition/
│   │       └── ParticipateRequest.php
│   ├── Resources/
│   │   ├── EventResource.php
│   │   ├── EventCollection.php
│   │   ├── CompetitionResource.php
│   │   ├── PostResource.php
│   │   └── UserResource.php
│   └── Middleware/
│       ├── AdminMiddleware.php
│       └── CheckSubscription.php
├── Models/
│   ├── User.php
│   ├── Event.php
│   ├── EventCategory.php
│   ├── EventRegistration.php
│   ├── Competition.php
│   ├── CompetitionEntry.php
│   ├── Post.php
│   ├── City.php
│   ├── Venue.php
│   └── Hall.php
├── Services/
│   ├── EventService.php
│   ├── CompetitionService.php
│   └── NotificationService.php
├── Jobs/
│   ├── DailyEventGeneratorJob.php
│   ├── DailyCompetitionCheckJob.php
│   └── SendNotificationJob.php
└── Console/
    └── Kernel.php (cron jobs)
```

### Architectural Principles

- **Thin controllers** — no business logic inside controllers
- **Service layer** — core domain logic lives in Services
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

## 🔗 API Endpoints

### Authentication
```
POST   /api/register          - Регистрация
POST   /api/login             - Вход
POST   /api/logout            - Выход
GET    /api/user              - Текущий пользователь
```

### Events
```
GET    /api/events            - Список событий (с фильтрами)
GET    /api/events/{id}       - Детали события
POST   /api/events/{id}/register - Регистрация на событие
GET    /api/events/upcoming   - Ближайшие события
```

### Competitions
```
GET    /api/competitions      - Список конкурсов
GET    /api/competitions/{id} - Детали конкурса
POST   /api/competitions/{id}/participate - Участвовать
GET    /api/competitions/my   - Мои участия
```

### Posts
```
GET    /api/posts             - Список постов
GET    /api/posts/{id}        - Детали поста
```

### Profile
```
GET    /api/profile           - Профиль пользователя
PUT    /api/profile           - Обновить профиль
GET    /api/profile/events    - Мои события
GET    /api/profile/history   - История посещений
```

### Admin (требует role=admin)
```
POST   /api/admin/events      - Создать событие
PUT    /api/admin/events/{id} - Обновить событие
DELETE /api/admin/events/{id} - Удалить событие
POST   /api/admin/competitions - Создать конкурс
POST   /api/admin/posts       - Создать пост
```
---

## Validation & Data Flow

- All incoming requests are validated using **FormRequest** classes
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

## Client Applications

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