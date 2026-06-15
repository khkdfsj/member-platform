# DepartmentIFO Member Platform Capability Map

This system should not be a CRUD table. It should evolve into a lightweight people operations platform for a student department.

## Capability Principles

- People data is the system of record: profile, status, department, role, training, evaluation, history.
- Permissions are role-based, scoped, auditable and overrideable.
- Every sensitive operation is logged and reversible where possible.
- Default views serve daily work: active members first, retired/suspended as separate cohorts.
- Managers see the right scope, not everything by accident.
- Each page must answer a real management question.

## Mature Product Benchmark

- Workday-style HCM: core member database, automation, workforce analytics, talent growth, learning and reporting.
- BambooHR-style HRIS: employee records, self-service, reports, performance management, workflows and centralized documents.
- SAP SuccessFactors-style RBP: role based permissions for performance and goals, manager/HR/admin separation.
- Microsoft Entra-style RBAC: least privilege, custom roles, scoped assignments and auditability.

## Target Modules

### 1. Member Records

- Paginated active member list by default.
- Status cohorts: active, trial, suspended, retired, left, graduated.
- Custom column visibility.
- Batch operations with permission checks.
- Detail page: basic profile, department history, training record, evaluation record, audit trail.
- Self-view mode for ordinary members.

### 2. Organization

- Department tree with nested departments.
- Visual member cards under each department.
- Department CRUD with guardrails.
- Department leaders, deputy leaders and member counts.
- Department change history.

### 3. RBAC and Delegated Authorization

- Super admin and teacher: full access.
- Minister: manage own department and lower roles.
- Vice minister: manage lower members in own department.
- Committee: self profile, own evaluations, public organization view.
- Permission overrides: grant/deny exact feature to exact member.
- Hidden UI for unauthorized features plus backend enforcement.

### 4. Evaluation and Growth

- Evaluation cycles.
- Four-dimension score model.
- Growth comments and improvement suggestions.
- Department average score and coverage.
- Individual evaluation timeline.
- Training/development records.

### 5. Workflow and Audit

- Join, leave, transfer, profile update and permission requests.
- Approval status and reviewer notes.
- Full audit log for all sensitive actions.
- Request trace through Auth Monitor.

### 6. Reporting

- Workforce headcount by department/status/post.
- Active/retired/suspended trends.
- Evaluation coverage and score distribution.
- Data quality warnings: missing phone/email/department/post.
- Export by filtered cohort.

### 7. Platform Operations

- Auth Monitor integration.
- API request logs, slow endpoints, error logs.
- Permission assignment logs.
- Backup/export readiness.

## Near-Term Implementation Backlog

- Custom table columns and persisted user preference.
- Batch status update and batch export.
- Rich member detail drawer with editable sections.
- Department leader assignment and nested department management.
- Evaluation templates and cycle management.
- Approval workflow actions with approve/reject buttons.
- Data quality dashboard.
- Password reset workflow with sensitive permission guard.
- Notification center.
- Auth Monitor role/session management UI.
