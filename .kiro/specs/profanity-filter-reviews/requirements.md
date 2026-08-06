# Requirements Document: Profanity Filter for Skill Swap Reviews

## Introduction

This feature implements a real-time profanity detection and filtering system for skill swap review comments. The system detects inappropriate language as users type, displays immediate warnings, and prevents profane content from being stored in the database. The profanity word list is configurable and supports case-insensitive matching.

## Glossary

- **Profanity_Filter**: The system component that detects and filters inappropriate language in review comments
- **Review_Comment**: Text content written by users in the review field when rating skill swap exchanges
- **Word_List**: A configurable list of prohibited words and phrases stored in configuration
- **Real-time_Detection**: Profanity detection that occurs as users type, before submission
- **Censoring**: Replacing detected profane words with asterisks or censoring mask
- **Case-Insensitive_Matching**: Matching that treats uppercase and lowercase letters as equivalent
- **Rating_Model**: The database model representing skill swap ratings with a review field
- **Warning_Message**: Visual feedback displayed to user when profanity is detected

## Requirements

### Requirement 1: Detect Profanity in Real-time During Comment Typing

**User Story:** As a reviewer, I want to see immediate feedback when I type inappropriate language, so that I can correct my comments before submission.

#### Acceptance Criteria

1. WHEN a user types text in the review comment field, THE Profanity_Filter SHALL analyze each input character
2. WHEN the user types content matching a word from the Word_List, THE Profanity_Filter SHALL trigger a detection event within 100 milliseconds
3. THE Profanity_Filter SHALL perform Case-Insensitive_Matching against the Word_List
4. WHEN profanity is detected, THE system SHALL display a visible Warning_Message to the user in real-time
5. WHILE the user is still editing the review comment, THE Profanity_Filter SHALL continue monitoring for profanity without interrupting text input

### Requirement 2: Display Warning Message When Profanity is Detected

**User Story:** As a reviewer, I want clear indication that my comment contains inappropriate language, so that I know which parts need correction.

#### Acceptance Criteria

1. WHEN profanity is detected in the review comment field, THE system SHALL display a warning message with clear visual styling (e.g., red border, alert icon, or banner)
2. THE Warning_Message SHALL indicate that the review contains profanity and cannot be submitted
3. WHEN multiple profanities are detected, THE system SHALL show the count of detected violations in the warning
4. WHEN the user removes all profanity from the comment, THE system SHALL automatically clear the Warning_Message and enable submission

### Requirement 3: Prevent Profane Content from Being Saved to Database

**User Story:** As a system administrator, I want to ensure no profane content is saved to the database, so that the system maintains content quality standards.

#### Acceptance Criteria

1. WHEN a user attempts to submit a review comment containing profanity, THE Rating_Model SHALL reject the submission
2. THE system SHALL return a validation error to the user with instructions to remove profanity before saving
3. WHEN profanity is detected at submission time, THE database transaction SHALL not complete and the review SHALL not be created or updated
4. THE Rating_Model review field SHALL never contain words matching the Word_List in the database record

### Requirement 4: Automatically Censor Profanity in Frontend Display

**User Story:** As a platform user viewing reviews, I want profane language to be masked, so that the community maintains professional standards.

#### Acceptance Criteria

1. WHERE a review comment in the database contains patterns matching previous detection, THE system SHALL censor profanity with asterisks (e.g., "b***" for a 4-letter word) when displaying to users
2. THE censored display SHALL preserve the word length to maintain readability context
3. WHEN displaying review comments in any user-facing interface (detail pages, lists, notifications), THE system SHALL apply the same censoring rules consistently
4. THE censoring pattern SHALL match Case-Insensitive matching rules used during detection

### Requirement 5: Manage Configurable Profanity Word List

**User Story:** As a system administrator, I want to maintain and update the profanity word list, so that the filter adapts to new inappropriate language trends.

#### Acceptance Criteria

1. THE Profanity_Filter SHALL load the Word_List from a configuration file or database table on system startup
2. WHEN an administrator updates the Word_List, THE system SHALL reload the updated list without requiring a full application restart
3. THE Word_List configuration SHALL support adding, removing, and modifying prohibited words and phrases
4. THE Word_List SHALL be organized in a structured format (JSON, array, or database table) for easy maintenance
5. THE Profanity_Filter SHALL support both single-word and multi-word phrase matching from the Word_List

### Requirement 6: Support Case-Insensitive Matching for Profanity Detection

**User Story:** As a system designer, I want profanity detection to work regardless of letter casing, so that users cannot bypass the filter using uppercase or mixed-case variations.

#### Acceptance Criteria

1. WHEN the user types profanity in any case variation (lowercase, UPPERCASE, MiXeD), THE Profanity_Filter SHALL detect it as a violation
2. THE Case-Insensitive_Matching SHALL normalize both the input text and Word_List to the same case for comparison
3. WHEN the system stores profanity in the database for audit/logging purposes, THE original text case SHALL be preserved while matching remains case-insensitive
4. THE Word_List entries themselves SHALL be case-insensitive regardless of how they are stored in configuration

### Requirement 7: Log Profanity Detection Events for Moderation

**User Story:** As a system administrator, I want to track when profanity is attempted, so that I can monitor platform safety and identify patterns of misuse.

#### Acceptance Criteria

1. WHEN profanity is detected during comment submission, THE system SHALL log the detection event with timestamp, user ID, detected words, and full comment text
2. WHEN multiple profanity attempts occur from the same user, THE system SHALL aggregate this data for moderation review
3. THE Profanity_Filter SHALL maintain logs that are accessible to administrators through the moderation interface
4. IF profanity is successfully blocked before database save, THEN THE system SHALL record this as a prevented violation in the moderation log

### Requirement 8: Provide Admin Interface for Word List Management

**User Story:** As an administrator, I want a user-friendly interface to manage the profanity word list, so that I can easily add or remove words without editing configuration files.

#### Acceptance Criteria

1. THE system SHALL provide an admin dashboard where administrators can view the current Word_List
2. WHERE an administrator has permission to modify content policies, THE system SHALL allow adding new profanity entries
3. WHERE an administrator has permission to modify content policies, THE system SHALL allow removing existing profanity entries
4. WHEN an administrator modifies the Word_List, THE changes SHALL take effect immediately across all running instances
5. THE admin interface SHALL show statistics on how many reviews have been filtered for each profanity entry

