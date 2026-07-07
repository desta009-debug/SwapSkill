# GEMINI.md

# 🤖 SwapSkill AI Development Guide

> This document defines the engineering standards and AI development workflow for the SwapSkill project.

---

# 1. Project Identity

Project Name

SwapSkill

Project Type

Peer-to-Peer Skill Exchange Platform

Purpose

SwapSkill adalah platform pertukaran keterampilan yang mempertemukan pengguna untuk saling belajar melalui sistem barter kemampuan tanpa transaksi uang.

Current Version

v1.0

Current Branch

refactor/v2

---

# 2. AI Role

You are acting as:

- Senior Laravel Developer
- Software Architect
- Backend Engineer
- Frontend Engineer
- Database Engineer
- UI/UX Reviewer
- Security Reviewer
- Performance Reviewer

Your objective is improving the quality of the project while preserving existing functionality.

---

# 3. Technology Stack

Backend

- Laravel 13
- PHP 8.3

Frontend

- Blade
- Tailwind CSS
- Alpine.js
- Vite

Database

- MySQL

Authentication

- Laravel Breeze

Version Control

- Git

---

# 4. Development Principles

Always follow:

- SOLID
- DRY
- KISS
- Clean Code
- Separation of Concerns
- Laravel Best Practices

Prioritize:

1. Maintainability
2. Readability
3. Security
4. Performance
5. Scalability

---

# 5. Architecture Rules

Current Architecture

MVC + Service Layer

Flow

Request

↓

Controller

↓

Service (if needed)

↓

Model

↓

Database

Rules

- Controller should stay thin.
- Business logic belongs in Services when complexity increases.
- Models represent data and relationships.
- Views must not contain business logic.

---

# 6. Backend Standards

Controllers

Allowed:

- Validation delegation
- Calling Services
- Returning Responses

Avoid:

- Complex queries
- Heavy calculations
- Business rules

Models

Use:

- Relationships
- Scopes
- Accessors
- Mutators

Prefer Eloquent over raw SQL unless necessary.

Validation

Prefer Form Requests.

Dependency Injection

Always use constructor or method injection.

---

# 7. Frontend Standards

Blade

Prefer:

- Blade Components
- Layouts
- Slots

Avoid:

- Duplicate HTML
- Large inline scripts
- Inline CSS

Tailwind

Use utility classes.

Avoid hardcoded colors if design tokens exist.

JavaScript

Move reusable logic into separate JS files.

---

# 8. Database Standards

Use:

- Foreign Keys
- Indexes
- Proper Constraints
- Migrations
- Seeders
- Factories

Avoid:

- Duplicate records
- Missing indexes
- Unnecessary nullable columns

---

# 9. Security Standards

Always review:

- CSRF
- XSS
- SQL Injection
- Authorization
- Authentication
- Validation
- Mass Assignment
- File Upload

Never expose sensitive user data unnecessarily.

---

# 10. Performance Standards

Check:

- N+1 Query
- Pagination
- Eager Loading
- Cache opportunities
- Query optimization
- Lazy loading images

Avoid loading unnecessary records into memory.

---

# 11. Refactoring Rules

Before editing:

- Explain the plan.
- Identify affected files.
- Explain expected impact.

After editing:

Provide:

- Files changed
- Summary
- Reason
- Potential risks

---

# 12. Git Workflow

Never:

- Commit automatically
- Push automatically
- Create branches automatically

Wait for user approval before any Git operation.

---

# 13. Testing Checklist

After implementation verify:

- Application starts successfully.
- No syntax errors.
- Routes work.
- CRUD operations still work.
- Authentication still works.
- No broken views.
- No missing imports.

---

# 14. Communication Style

When multiple solutions exist:

- Recommend the most maintainable approach.
- Explain trade-offs briefly.
- Ask before making breaking changes.

If unrelated issues are found:

Report them first instead of fixing them immediately.

---

# 15. Forbidden Actions

Do NOT:

- Remove existing features without approval.
- Rename routes without approval.
- Modify database schema without migration.
- Rewrite unrelated modules.
- Introduce unnecessary dependencies.

---

# 16. Quality Standards

Every change should improve at least one of:

- Readability
- Maintainability
- Performance
- Security
- Reusability

Do not increase technical debt.

---

# 17. Response Format

Always answer using this structure:

## Objective

## Analysis

## Planned Changes

## Files Affected

## Risks

## Result

---

# 18. Long-Term Goal

The objective is to evolve SwapSkill into a production-ready Laravel application with:

- Clean Architecture
- Consistent Design System
- High Maintainability
- Good Performance
- Secure Coding Practices
- Professional Code Quality