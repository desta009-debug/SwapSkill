# Design Document: Profanity Filter for Skill Swap Reviews

## Overview

The Profanity Filter feature provides a comprehensive system for detecting, managing, and preventing inappropriate language in skill swap review comments. The system operates at multiple layers:

1. **Real-time Detection Layer** - JavaScript-based client-side detection as users type
2. **Validation Layer** - Server-side validation during form submission 
3. **Display Layer** - Backend censoring for all review display surfaces
4. **Management Layer** - Admin interface for configurable word list management
5. **Logging Layer** - Comprehensive moderation audit trail

The system integrates seamlessly with the existing `Rating` model and builds on the established `ModerationService` infrastructure. All profanity detection is case-insensitive and supports both single-word and multi-word phrase matching.

## Architecture

### High-Level System Flow

```
User Types Review Comment
        ↓
[Real-time Detection Service] (Client-side)
        ↓
User Sees Warning Message (if profanity detected)
        ↓
User Submits Form
        ↓
[Backend Validation] (Server-side ModerationService)
        ↓
Validation Error → User Correction → Resubmit
        ↓
Rating Created & Logged
        ↓
Review Displayed to Users
        ↓
[Censoring Filter] (On Display)
        ↓
User Sees Censored Content
```

### Component Layers

#### 1. Frontend Detection Layer

**Purpose**: Provide immediate user feedback while typing

**Components**:
- `ProfanityDetector.js` - Real-time detection engine
- `ReviewCommentField.vue` or blade component - Input field with detection integration
- `ProfanityWarning.vue` - Warning message component
- Client-side word list cache

**Key Behavior**:
- Detects profanity within 100ms of character input
- Displays warning without blocking text input
- Updates detection count as user types
- Clears warning when all profanity is removed
- Performs case-insensitive matching

#### 2. Backend Validation Layer

**Purpose**: Server-side enforcement gate before database persistence

**Components**:
- `ModerationService` (enhanced) - Core detection/censoring logic
- Custom validation rule: `ValidateProfanity`
- `RatingController::store()` - Integration point

**Key Behavior**:
- Validates review content before Rating model creation
- Returns validation error if profanity detected
- Logs attempted violations for moderation
- Prevents any profane content from reaching database

#### 3. Censoring & Display Layer

**Purpose**: Mask profanity when displaying reviews to other users

**Components**:
- Accessor/Mutator in `Rating` model
- `ProfanityCensor` trait or helper
- View rendering logic

**Key Behavior**:
- Automatically censors reviews during retrieval
- Preserves word length for readability
- Applies consistently across all display surfaces
- Maintains original content in database (for auditing)

#### 4. Word List Management Layer

**Purpose**: Admin control over profanity detection scope

**Components**:
- `ProfanityWord` model - Database table for dynamic word list
- `ProfanityListController` - Admin CRUD endpoints
- Cache invalidation system
- `ModerationService` - Loads from cache/DB

**Key Behavior**:
- Supports add/remove/modify operations
- Immediate cache refresh (no restart required)
- Tracks usage statistics per word
- Supports both single words and phrases

#### 5. Logging & Moderation Layer

**Purpose**: Audit trail and moderation analytics

**Components**:
- Enhanced `ModerationLog` model
- `ModerationController` - Admin views
- Aggregation for statistics

**Key Behavior**:
- Logs all detection events at submission time
- Records original text, cleaned text, matched words
- Tracks user patterns across multiple attempts
- Provides admin dashboard with statistics

## Components and Interfaces

### Frontend Components

#### ReviewCommentField Component

```javascript
// Location: resources/js/components/ReviewCommentField.vue or similar
// Purpose: Text input field with integrated profanity detection

Props:
  - initialValue: string (optional)
  - maxLength: number (default: 1000)
  - placeholder: string

Data:
  - commentText: string
  - detectedProfanities: string[]
  - showWarning: boolean
  - detectionCount: number

Methods:
  - onInput(event) - Handles character input, triggers detection
  - detectProfanity(text) - Calls ProfanityDetector service
  - clearWarning() - Hides warning when profanity removed

Events:
  - @input - Emits comment text to parent
  - @profanity-detected - Emits detection state
```

#### ProfanityWarning Component

```javascript
// Location: resources/js/components/ProfanityWarning.vue
// Purpose: Display detection warning and violation details

Props:
  - violationCount: number
  - detectedWords: string[]
  - isVisible: boolean

Template:
  - Red-bordered alert container
  - Warning icon/banner
  - Message: "Your review contains X profanity violation(s)"
  - List of detected words (if display desired)
  - Instruction text
```

#### ProfanityDetector Service

```javascript
// Location: resources/js/services/ProfanityDetector.js
// Purpose: Client-side detection engine

Properties:
  - wordList: string[] (loaded from backend API)
  - cacheUpdateTime: timestamp

Methods:
  - detect(text: string): DetectionResult
  - hasViolations(text: string): boolean
  - getMatchedWords(text: string): string[]
  - updateWordList() - Fetches fresh list from backend

DetectionResult Interface:
  {
    hasViolations: boolean,
    matchedWords: string[],
    violationCount: number,
    detectionTime: number
  }

Performance:
  - 100ms response time target
  - Word list cached in-memory
  - Regex pattern compiled once
```

### Backend Components

#### ProfanityWord Model

```php
// Location: app/Models/ProfanityWord.php

Properties:
  - id: bigint
  - word: string (unique)
  - phrase: string (nullable, for multi-word phrases)
  - active: boolean (soft-enable/disable)
  - category: string (e.g., "insult", "profanity", "slur")
  - severity_level: integer (1-3, for future tiered responses)
  - block_count: integer (tracks detections)
  - created_at: timestamp
  - updated_at: timestamp
```

#### Enhanced ModerationService

```php
// Location: app/Services/ModerationService.php (enhanced)

Existing Methods:
  - contains(string $text): bool
  - clean(string $text): string
  - matchedWords(string $text): array
  - logEvent(...): ModerationLog

New Methods:
  - getWordList(): array
  - reloadWordList(): void
  - incrementBlockCount(string $word): void
  - censorForDisplay(string $text): string
  - validateReview(string $review): ValidationResult
  - getStatistics(): array
```

#### ValidateProfanity Rule

```php
// Location: app/Rules/ValidateProfanity.php

Purpose: Custom Laravel validation rule for forms

Usage:
  'review' => ['nullable', 'string', 'max:1000', new ValidateProfanity()]

Behavior:
  - Integrates with ModerationService
  - Returns validation error if violations detected
  - Logs attempted violation
  - Includes violation details in error message
```

#### ProfanityListController

```php
// Location: app/Http/Controllers/Admin/ProfanityListController.php

Routes:
  - GET /admin/profanity/list - Show word list
  - GET /admin/profanity/list/{id}/edit - Edit word form
  - POST /admin/profanity/list - Add new word
  - PATCH /admin/profanity/list/{id} - Update word
  - DELETE /admin/profanity/list/{id} - Remove word
  - POST /admin/profanity/list/bulk-action - Bulk operations

Actions:
  - Display paginated word list with statistics
  - Add/remove words with form validation
  - Trigger cache invalidation
  - Show usage frequency per word
  - Support bulk operations (import CSV, enable/disable multiple)
```

#### Enhanced RatingController

```php
// Location: app/Http/Controllers/RatingController.php (enhanced)

Modified store() method:
  - Adds ValidateProfanity rule to review field validation
  - Logs moderation event on success
  - Returns specific error message for profanity violations
  - Tracks submission attempt in logs
```

#### Censoring Accessor in Rating Model

```php
// Location: app/Models/Rating.php (enhanced)

New Accessor:
  - getCensoredReviewAttribute(): string
  - Returns censored version of review for display

Usage:
  $rating->censored_review // Returns cleaned version
  $rating->review // Returns original (for admin use)

New Scope:
  - withCensoredReview() - Loads with censored version
```

### Database Models

#### ProfanityWord Table

```sql
CREATE TABLE profanity_words (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    word VARCHAR(255) UNIQUE NOT NULL,
    phrase TEXT NULL,
    active BOOLEAN DEFAULT TRUE,
    category VARCHAR(100) DEFAULT 'general',
    severity_level TINYINT DEFAULT 1,
    block_count INT DEFAULT 0,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    INDEX idx_active (active),
    INDEX idx_category (category)
);
```

#### Enhanced ModerationLog Table

```sql
-- Existing table schema, no changes required
-- Fields: id, user_id, content_type, matched_words, original_content, cleaned_content, created_at

-- Optional Enhancement: Add column for review_id
ALTER TABLE moderation_logs ADD COLUMN review_id BIGINT UNSIGNED NULL;
```

#### Enhanced Rating Table

No database changes required. The `review` field already exists and holds original content.

**Model Relationship Enhancement**:
- `Rating` gets accessor for `censored_review`
- No data migration needed - censoring happens at display time
- Original content preserved for admin audit

## Data Models

### Rating Model Relationships

```php
class Rating extends Model {
    // Existing relationships
    public function skillSwap(): BelongsTo
    public function rater(): BelongsTo
    public function ratedUser(): BelongsTo
    
    // New relationship (optional, for direct link)
    public function moderationLog(): HasOne
    
    // New accessor
    public function getCensoredReviewAttribute(): string
    
    // New scope for queries
    public function scopeWithCensoredReview()
}
```

### ProfanityWord Model

```php
class ProfanityWord extends Model {
    protected $fillable = [
        'word',
        'phrase',
        'active',
        'category',
        'severity_level',
    ];
    
    protected $casts = [
        'active' => 'boolean',
        'severity_level' => 'integer',
    ];
    
    // Query scopes
    public function scopeActive()
    public function scopeByCategory(string $category)
    public function scopeOrderByFrequency()
}
```

### ModerationLog Model Enhancement

```php
class ModerationLog extends Model {
    // Existing relationships
    public function user(): BelongsTo
    
    // New optional relationship
    public function rating(): BelongsTo  // review_id
    
    // Query scopes
    public function scopeForContentType(string $type)
    public function scopeRecentViolations(int $days = 7)
    public function scopeByUser(int $userId)
}
```

## Integration Points

### With Rating Creation Flow

**Current Flow**:
1. User fills rating form with review text
2. Form submits to `RatingController::store()`
3. Validation rules applied
4. Rating created if valid
5. Response returned to user

**Enhanced Flow**:
1. User fills rating form with review text
2. **Frontend real-time detection** shows warning if needed
3. Form submits to `RatingController::store()`
4. **Enhanced validation rules** (including `ValidateProfanity`) applied
5. If profanity detected, validation error returned with specific message
6. If valid: **Moderation event logged**, Rating created, user notified
7. Response returned to user

### With Review Display

**Current Flow**:
1. Review accessed from Rating model
2. Displayed in view/API response

**Enhanced Flow**:
1. Review accessed from Rating model
2. **Accessor applies censoring** automatically
3. Censored version displayed to end users
4. Admin sees original via different property/query

### With Admin Interface

**New Admin Routes**:
- `/admin/profanity/list` - Word list management dashboard
- Related CRUD routes for word management
- Enhanced moderation dashboard with profanity statistics

### With API Responses

**Backend API for Frontend**:
- `GET /api/profanity-words` - Returns current word list (public, for client-side detection)
- `POST /api/profanity-words/validate` - On-demand server validation (optional)
- Cache headers to minimize API calls

## Error Handling

### Frontend Error Handling

**Detection Errors**:
- Word list fails to load: Show warning, allow manual form validation
- Detection timeout (>200ms): Log error, allow submission but flag for backend validation

**User Feedback**:
- "Unable to load profanity filter" message
- "Please try again or contact support" instruction
- Graceful degradation to backend-only validation

### Backend Error Handling

**Validation Errors**:
```php
// In ValidateProfanity rule
if ($this->moderationService->contains($value)) {
    return false; // Triggers validation error
}

// Error message
"This review contains inappropriate language. Please remove it before submitting."
```

**Database Errors**:
- Word list loading failure: Fall back to cached copy
- Log deletion failure: Don't block request, queue for retry
- Cache invalidation failure: Still update database (cache will refresh on next reload)

**Admin Errors**:
- Bulk import format errors: Validate before import, show error summary
- Word deletion conflicts: Check if word is active in detection, warn admin
- Statistics calculation errors: Show cached stats, queue recalculation

### Logging Strategy

All errors logged to:
- `storage/logs/laravel.log` - Standard Laravel logging
- `ModerationLog` table - Moderation-specific events
- Special log channel: `profanity` (optional, for isolated tracking)

## Testing Strategy

### Unit Testing Approach

**Test Coverage**:

1. **ModerationService Tests** (`tests/Unit/Services/ModerationServiceTest.php`)
   - `test_contains_detects_single_word()` - Verify detection
   - `test_contains_case_insensitive()` - Case-insensitive matching
   - `test_contains_with_multiple_violations()` - Multiple profanities in one text
   - `test_clean_censors_with_asterisks()` - Censoring format
   - `test_clean_preserves_word_length()` - Censoring preserves length
   - `test_matched_words_returns_unique_list()` - Deduplication
   - `test_matched_words_case_insensitive()` - Case handling in results
   - `test_log_event_creates_moderation_record()` - Logging functionality
   - `test_word_list_reload_refreshes_cache()` - Cache invalidation

2. **ValidateProfanity Rule Tests** (`tests/Unit/Rules/ValidateProfanityTest.php`)
   - `test_validation_fails_with_profanity()` - Validation rejection
   - `test_validation_passes_without_profanity()` - Validation pass
   - `test_validation_allows_empty_review()` - Null/empty handling
   - `test_logs_moderation_event_on_violation()` - Logging on validation failure

3. **Rating Model Tests** (`tests/Unit/Models/RatingTest.php`)
   - `test_censored_review_accessor_works()` - Accessor functionality
   - `test_censored_review_preserves_word_length()` - Length preservation
   - `test_original_review_unchanged()` - Original content untouched

4. **ProfanityWord Model Tests** (`tests/Unit/Models/ProfanityWordTest.php`)
   - `test_active_scope_filters_inactive_words()` - Scoping
   - `test_by_category_scope_works()` - Category filtering
   - `test_ordered_by_frequency_scope_works()` - Frequency ordering

### Integration Testing Approach

**Test Coverage**:

1. **Rating Creation Integration** (`tests/Feature/RatingProfanityTest.php`)
   - `test_rating_rejected_with_profanity()` - Full flow rejection
   - `test_rating_accepted_without_profanity()` - Full flow success
   - `test_moderation_log_created_on_violation_attempt()` - Log creation
   - `test_validation_error_message_shows_violation()` - User-facing error
   - `test_multiple_submissions_tracked_separately()` - User pattern tracking

2. **Admin Management Integration** (`tests/Feature/Admin/ProfanityListManagementTest.php`)
   - `test_admin_can_add_profanity_word()` - Word addition
   - `test_admin_can_remove_profanity_word()` - Word removal
   - `test_word_list_changes_reflect_immediately()` - Cache invalidation
   - `test_statistics_update_after_new_detections()` - Stats accuracy

3. **Display Censoring Integration** (`tests/Feature/ReviewDisplayTest.php`)
   - `test_review_censored_when_displayed_to_user()` - Censoring on display
   - `test_original_review_available_to_admin()` - Admin sees original
   - `test_censoring_consistent_across_multiple_displays()` - Consistency

4. **API Endpoint Tests** (`tests/Feature/Api/ProfanityApiTest.php`)
   - `test_word_list_endpoint_returns_current_words()` - API endpoint
   - `test_validation_endpoint_detects_profanity()` - Server validation
   - `test_word_list_cached_appropriately()` - Caching headers

### Frontend Testing Approach

**Unit Tests** (`resources/js/tests/`):

1. `ProfanityDetector.test.js`
   - `test_detects_single_word_violation()` - Detection logic
   - `test_detects_multiple_violations()` - Multiple words
   - `test_case_insensitive_matching()` - Case handling
   - `test_response_within_100ms()` - Performance requirement
   - `test_word_list_update()` - Cache refresh

2. `ReviewCommentField.test.js`
   - `test_displays_warning_on_violation()` - Warning display
   - `test_clears_warning_when_violation_removed()` - Warning clearing
   - `test_input_not_blocked_during_typing()` - Input flow
   - `test_violation_count_updated()` - Count accuracy

3. `ProfanityWarning.test.js`
   - `test_warning_visible_with_violations()` - Visibility logic
   - `test_violation_count_displayed()` - Count display
   - `test_words_list_shown_if_enabled()` - Optional word display

### Property-Based Testing

**Applicability Assessment**:

The profanity filter feature includes logic suitable for property-based testing:

✓ **Core detection logic** - Patterns and matching algorithms
✓ **Censoring logic** - Text transformation with fixed rules
✓ **Case-insensitive matching** - Normalization algorithms
✓ **Word list integration** - List-based filtering with invariants

✗ **Admin UI** - UI rendering and form handling (use snapshot tests)
✗ **Database operations** - Simple CRUD (use example tests)
✗ **Logging** - Side effect only (use mocks)

**Property-Based Test Strategy** (using fast-check or similar):

After prework analysis, we will define properties for:
1. Round-trip censoring properties
2. Case-insensitive matching invariants
3. Word list matching properties
4. Performance invariants

### Test Execution

**Backend Tests**:
```bash
# Run all profanity-related tests
php artisan test tests/Unit/Services/ModerationServiceTest.php
php artisan test tests/Feature/RatingProfanityTest.php
php artisan test tests/Feature/Admin/ProfanityListManagementTest.php

# Run with code coverage
php artisan test --coverage tests/Services/ModerationServiceTest.php
```

**Frontend Tests**:
```bash
# Run Vue component tests
npm run test:unit

# Run with coverage
npm run test:unit -- --coverage

# Run with watch mode for development
npm run test:unit -- --watch
```

**Performance Tests**:
```bash
# Validate 100ms response time for detection
npm run test:perf resources/js/tests/performance/ProfanityDetector.perf.js
```

## Implementation Notes

### Performance Considerations

1. **Client-side Detection**
   - Word list cached in JavaScript memory
   - Regex pattern compiled once
   - Target: <100ms detection time
   - Debounce detection calls (optional, every 300ms)

2. **Server-side Detection**
   - Word list cached via Laravel's Cache facade
   - Cache key: `profanity:words`
   - TTL: 24 hours (manual refresh via admin)
   - Database queries only on admin changes

3. **Display Censoring**
   - Applied via model accessor (lazy loading)
   - Cached in application memory if heavily accessed
   - Alternative: Cache censored reviews separately

### Security Considerations

1. **Word List Management**
   - Only accessible to admin users
   - Requires middleware authentication
   - Audit trail for all additions/removals

2. **Content Preservation**
   - Original content always stored in database
   - Necessary for appeals and auditing
   - Admin interface shows original for moderation

3. **Client-side Detection**
   - Word list is public API (learnable content)
   - Not for security, only UX improvement
   - Server-side validation is authoritative

### Scalability Considerations

1. **Large Word Lists**
   - Regex pattern efficiency decreases with list size
   - Consider database-backed search for 1000+ words
   - Or use trie data structure for matching

2. **High-Volume Moderation Logging**
   - Aggregate stats periodically to reduce log rows
   - Archive old logs to separate table
   - Consider partitioning ModerationLog table

3. **Cache Invalidation**
   - Current approach: Manual trigger or time-based
   - Future: Event-based cache clearing
   - Consider distributed cache (Redis) for multi-server setup



## Correctness Properties

*A property is a characteristic or behavior that should hold true across all valid executions of a system—essentially, a formal statement about what the system should do. Properties serve as the bridge between human-readable specifications and machine-verifiable correctness guarantees.*

The profanity filter feature is well-suited for property-based testing because it involves:
- Pure transformation functions (detection, censoring, matching)
- Algorithmic correctness (case-insensitive matching, pattern recognition)
- Invariant preservation (word length in censoring, case preservation in logging)
- Consistency across operations (same censoring output regardless of display context)

Property-based tests will generate hundreds of random inputs to verify these universal properties hold.

### Property 1: Case-Insensitive Detection Invariant

*For any profanity word in the Word_List and any case variation of that word in review text, the Profanity_Filter SHALL detect it as a violation regardless of casing.*

**Validates: Requirements 1.3, 6.1, 6.4**

**Rationale**: This property ensures that users cannot bypass the profanity filter by using uppercase, lowercase, or mixed-case variations. The detection mechanism should normalize case internally while preserving original case in logs.

### Property 2: Word Length Preservation in Censoring

*For any profanity word of length N in review text, the censored output SHALL contain exactly N asterisks in place of that word.*

**Validates: Requirements 4.2, 4.4**

**Rationale**: Censoring should mask the word while maintaining readability context. Users should see "b****" for a 4-letter word, not a variable number of asterisks. This length-preserving transformation is essential for maintaining text flow.

### Property 3: Detection and Censoring Consistency

*For any text, if the detection algorithm identifies a profanity word at position P, then the censoring algorithm SHALL replace that same word at position P with asterisks.*

**Validates: Requirements 4.1, 4.3, 4.4**

**Rationale**: The detection and censoring logic must be aligned. Any word the detector identifies should be censored identically. This ensures no profanities slip through the display layer if they passed detection.

### Property 4: Database Violation Prevention

*For any submitted review containing profanity, the Rating database record SHALL NOT be created or updated, and the review field of all existing Rating records SHALL never match any word in the Word_List.*

**Validates: Requirements 3.1, 3.3, 3.4**

**Rationale**: The system's primary guarantee is that profane content never reaches the database. This is a strong invariant that should be verified across all stored records.

### Property 5: Case-Insensitive Matching Symmetry

*For any text string and Word_List, performing case-insensitive matching by normalizing both input and list to lowercase SHALL produce identical results as performing case-insensitive matching by normalizing both to uppercase.*

**Validates: Requirements 6.2**

**Rationale**: The case normalization mechanism should be symmetric—regardless of which case we normalize to, matching results should be identical. This ensures correct implementation of case-insensitivity.

### Property 6: Single and Multi-Word Phrase Matching

*For any single-word or multi-word phrase in the Word_List, the detection algorithm SHALL identify all occurrences in text, regardless of surrounding punctuation or whitespace variations.*

**Validates: Requirements 5.5, 1.2**

**Rationale**: The profanity filter must handle both simple words and phrases. This property verifies that multi-word phrases like "bad phrase" are detected correctly even if users add extra spaces or punctuation nearby.

### Property 7: Detection Performance Constraint

*For any review text of length L characters, the detection algorithm SHALL complete in less than 100 milliseconds.*

**Validates: Requirement 1.2**

**Rationale**: Real-time detection requires responsiveness. Users should see feedback instantly as they type. This property verifies the system meets the 100ms performance requirement across all input sizes and content variations.

### Property 8: Warning Display State Transition

*For any review text in the input field, if detection identifies violations, the warning component SHALL be visible; if all violations are removed, the warning SHALL become invisible without page refresh.*

**Validates: Requirements 2.1, 2.4**

**Rationale**: The frontend warning system should immediately reflect detection state changes. Users should not need to refresh or resubmit to clear warnings.

### Property 9: Moderation Log Completeness

*For any submitted review containing profanity, the ModerationLog SHALL contain entries with all required fields: timestamp, user_id, detected_words array, original_content, and cleaned_content.*

**Validates: Requirements 7.1, 7.4**

**Rationale**: Moderation logs are the audit trail for the system. Each violation attempt must be fully documented for administrative review and pattern analysis.

### Property 10: Word List Reload Effectiveness

*For any new profanity word added to the Word_List via admin interface, the system SHALL detect that word in subsequent submissions without application restart; for any word removed, the system SHALL no longer detect it.*

**Validates: Requirements 5.2, 8.2, 8.3, 8.4**

**Rationale**: The word list must be dynamic. Administrators should be able to add or remove words immediately, and the change should take effect across all detection operations without server restart.

### Property 11: Multiple Violation Counting

*For any text containing N distinct profanity words (counting each occurrence), the system SHALL report exactly N violations in the warning message and moderation log.*

**Validates: Requirements 2.3, 7.1, 8.5**

**Rationale**: Violation counting must be accurate. Users and administrators need to know how many profanities were detected. This property ensures counting logic is correct across all input variations.

### Property 12: Content Preservation During Logging

*For any review text submitted, the ModerationLog SHALL store the original text with case preserved exactly as submitted, even though detection performed case-insensitive matching.*

**Validates: Requirements 6.3, 7.1**

**Rationale**: While detection is case-insensitive, logs must preserve the exact original text for auditing. This property ensures the system doesn't lose information despite performing normalized matching.

### Property 13: Censoring Idempotence

*For any review text, applying the censoring function twice SHALL produce the same result as applying it once. The already-censored text SHALL not be re-censored.*

**Validates: Requirements 4.1, 4.3**

**Rationale**: If censoring is applied multiple times (e.g., in different display paths), the output should stabilize after the first application. This ensures reviews don't become "b****-e*" when censored multiple times.

### Property 14: Validation Error Specificity

*For any submitted review with profanity, the validation error response SHALL include text indicating the presence of profanity and instruction to remove it before resubmission.*

**Validates: Requirements 3.2**

**Rationale**: Users need clear guidance when submission is rejected. The error message should explain why and what to do, not just say "invalid".

### Property 15: Input Non-Interruption

*For any sequence of character inputs to the review field, each character SHALL appear in the input field, and the detection process SHALL complete independently without blocking or delaying text input.*

**Validates: Requirement 1.5**

**Rationale**: The detection system should never interfere with the user's ability to type. Even if detection takes time, characters should appear immediately and detection should happen asynchronously.

