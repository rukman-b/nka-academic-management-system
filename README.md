# NKA Academic Management System (NKA-AMS)

 **A modular, Dockerised academic management platform built with Laravel 11 and a multi-guard RBAC architecture.**

***

## 1. System Overview

The **NKA Academic Management System (NKA-AMS)** is a Laravel-based web application designed to support structured academic administration workflows within higher education and vocational training environments.

The system is engineered around a **multi-stakeholder architecture** and emphasises:

* role and permission-based access control (RBAC)

* guard-level authentication separation

* centralised session management

* reproducible containerised environments

* documentation-driven engineering discipline

This repository represents the **engineering baseline** of the system and serves as the foundation for requirement-driven functional expansion.

***
## 2. Architectural Principles

The system is designed according to the following principles:

### Separation of Concerns

Authentication, session storage, caching, queue handling, and database persistence are isolated at the infrastructure level.

### Stateless Application Layer

The Laravel container is stateless. Persistent state is externalised to Redis and MariaDB.

### Deterministic Multi-Guard Authentication

Each stakeholder type operates under a dedicated guard with explicit session and access boundaries.

### Infrastructure Reproducibility

Docker and Docker Compose guarantee environment parity across development machines.

### Documentation-First Development

Architectural decisions are formalised and versioned alongside code changes.

---
 ## 3. Technical Stack

| Layer | Technology |
|-------|------------|
| Framework | Laravel 11 (PHP 8.2) |
| Authentication & Authorisation | Multi-guard architecture + Spatie Laravel Permission|
| UI Framework | AdminLTE |
| Frontend Tooling | Vite + Node.js |
| Database | MariaDB (Dockerised) |
| State Layer | Redis (phpredis extension) |
| Environment | Docker & Docker Compose |
| Testing | Isolated environment via .env.testing |

---
## 4. Redis State Architecture

Redis functions as the centralised state layer of the system and is responsible for:

* HTTP session storage

* Application caching

* Queue transport backend

To ensure isolation and predictability, Redis uses dedicated logical databases:
| Function | Redis DB |
|----------|----------|
| Sessions | DB 0 |
| Cache | DB 1 |
| Queue | DB 2 |

Key characteristics:

* Dedicated cache key prefix (`CACHE_PREFIX`)

* Dedicated session key prefix (`SESSION_PREFIX`)

* Queue lists stored as `queues:<queue-name>`

* No global Redis prefix at connection level

* Docker service name used as Redis hostname (no internal localhost coupling)

This structure enables:

* horizontal scalability

* cross-container session consistency

* deterministic queue processing

* key-collision prevention

Redis usage can be independently verified via CLI-level inspection.

---
## 5. Development Environment (Docker)

The system runs in a fully containerised development environment.

### Core Services

* **Laravel Application Container** (PHP runtime)

* **Nginx** (HTTP server)

* **MariaDB** (persistent data)

* **Redis** (state layer)

* **Node / Vite** (asset compilation)

* **phpMyAdmin** (optional development utility)

### Start the Environment

```bash
docker compose up -d --build
```
### Access Points
| Service | URL |
|---------|-----|
| Application | `http://localhost:8000` |
| phpMyAdmin | `http://localhost:8080` |

All services communicate via Docker internal networking. No internal service relies on `localhost`.

 ---
 ## 6. Environment Configuration

The project uses structured environment separation:

| File | Purpose |
|------|---------|
| `.env` | Local development configuration (not committed) |
| `.env.example` | Configuration template |
| `.env.testing` | Isolated testing configuration |

Sensitive values (keys, credentials, secrets) are excluded from version control.

---
## 7\. Repository Structure (High-Level)
| Directory | Purpose |
|-----------|---------|
| `app/` | Core application logic |
| `config/` | Framework and architectural configuration |
| `database/` | Migrations and seeders |
| `docker/` | Container definitions and scripts |
| `resources/` | Views and frontend assets |
| `routes/` | Route definitions |
| `storage/` | Logs, cache, runtime data |

---

## 8. Versioning Strategy

The repository follows a milestone-based versioning model.

The current baseline release establishes:

* multi-guard authentication structure

* Redis-backed state management

* Dockerised environment reproducibility

* architectural documentation alignment

Functional modules are introduced only after formalised requirement validation.

***

## 9. System Integrity Guarantees

The architecture ensures:

* single-session enforcement consistency

* container restart safety (no session loss)

* externalised persistent state

* infrastructure-layer separation of responsibilities

This design supports safe scaling without architectural modification.

***

## 10. Academic & Ethical Statement

This system is built using **Laravel**, an open-source framework licensed under the MIT License.

Laravel is used as enabling infrastructure.
All architectural decisions, design patterns, configuration logic, and implementation strategies are authored and reviewed by the project owner.

Tooling assistance supports — but does not replace — human-directed engineering judgement.

***

## 11. License Status

This repository is currently maintained as a **research artefact**.

Public licensing terms will be defined at the time of formal publication.


---

## Operational Verification

For detailed Redis verification procedures (Cache / Queue / Session),
including CLI-based proof steps, see:

- [Docker Services – Redis Verification](./docs/docker-services.md#redis-verification)

This section documents how to:
- verify Redis cache storage (DB 1),
- verify Redis queue processing (DB 2),
- verify Redis session storage (DB 0),
- confirm prefix behaviour and configuration alignment.

