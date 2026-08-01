<?php

namespace App\OpenApi;

/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     title="User",
 *     description="User model",
 *     required={"id", "name", "email", "created_at", "updated_at"},
 *     @OA\Property(property="id", type="integer", example=1, description="User ID"),
 *     @OA\Property(property="name", type="string", example="John Doe", description="User's full name"),
 *     @OA\Property(property="email", type="string", format="email", example="john@example.com", description="User's email address"),
 *     @OA\Property(property="email_verified_at", type="string", format="date-time", nullable=true, description="Email verification timestamp"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Account creation timestamp"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Last update timestamp")
 * )
 * 
 * @OA\Schema(
 *     schema="Project",
 *     type="object",
 *     title="Project",
 *     description="Project model",
 *     required={"id", "name", "status", "user_id", "created_at", "updated_at"},
 *     @OA\Property(property="id", type="integer", example=1, description="Project ID"),
 *     @OA\Property(property="name", type="string", example="Website Redesign", description="Project name"),
 *     @OA\Property(property="description", type="string", example="Complete redesign of company website", nullable=true, description="Project description"),
 *     @OA\Property(property="status", type="string", enum={"active", "completed", "archived"}, example="active", description="Project status"),
 *     @OA\Property(property="user_id", type="integer", example=1, description="Owner user ID"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Creation timestamp"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Last update timestamp"),
 *     @OA\Property(property="tasks_count", type="integer", example=5, nullable=true, description="Total number of tasks in project")
 * )
 * 
 * @OA\Schema(
 *     schema="Task",
 *     type="object",
 *     title="Task",
 *     description="Task model",
 *     required={"id", "project_id", "title", "priority", "status", "created_at", "updated_at"},
 *     @OA\Property(property="id", type="integer", example=1, description="Task ID"),
 *     @OA\Property(property="project_id", type="integer", example=1, description="Parent project ID"),
 *     @OA\Property(property="title", type="string", example="Implement user authentication", description="Task title"),
 *     @OA\Property(property="description", type="string", example="Add JWT authentication to API endpoints", nullable=true, description="Task description"),
 *     @OA\Property(property="priority", type="string", enum={"low", "medium", "high"}, example="high", description="Task priority level"),
 *     @OA\Property(property="status", type="string", enum={"todo", "in_progress", "done"}, example="todo", description="Task status"),
 *     @OA\Property(property="due_date", type="string", format="date", example="2026-12-31", nullable=true, description="Task due date"),
 *     @OA\Property(property="overdue_notified_at", type="string", format="date-time", nullable=true, description="Timestamp when overdue notification was sent"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Creation timestamp"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Last update timestamp"),
 *     @OA\Property(property="project", ref="#/components/schemas/Project", nullable=true, description="Parent project details")
 * )
 * 
 * @OA\Schema(
 *     schema="DashboardStatistics",
 *     type="object",
 *     title="Dashboard Statistics",
 *     description="Dashboard metrics and statistics",
 *     @OA\Property(property="total_projects", type="integer", example=10, description="Total number of projects"),
 *     @OA\Property(property="active_projects", type="integer", example=5, description="Number of active projects"),
 *     @OA\Property(property="completed_projects", type="integer", example=3, description="Number of completed projects"),
 *     @OA\Property(property="archived_projects", type="integer", example=2, description="Number of archived projects"),
 *     @OA\Property(property="total_tasks", type="integer", example=50, description="Total number of tasks"),
 *     @OA\Property(property="todo_tasks", type="integer", example=15, description="Number of tasks in todo status"),
 *     @OA\Property(property="in_progress_tasks", type="integer", example=20, description="Number of tasks in progress"),
 *     @OA\Property(property="done_tasks", type="integer", example=15, description="Number of completed tasks"),
 *     @OA\Property(property="overdue_tasks", type="integer", example=5, description="Number of overdue tasks"),
 *     @OA\Property(property="high_priority_tasks", type="integer", example=8, description="Number of high priority tasks")
 * )
 * 
 * @OA\Schema(
 *     schema="StatusOption",
 *     type="object",
 *     title="Status Option",
 *     description="Status enum option with metadata",
 *     @OA\Property(property="value", type="string", example="active", description="Status value"),
 *     @OA\Property(property="label", type="string", example="Active", description="Human-readable label"),
 *     @OA\Property(property="color", type="string", example="green", description="UI color hint")
 * )
 * 
 * @OA\Schema(
 *     schema="PriorityOption",
 *     type="object",
 *     title="Priority Option",
 *     description="Priority enum option with metadata",
 *     @OA\Property(property="value", type="string", example="high", description="Priority value"),
 *     @OA\Property(property="label", type="string", example="High", description="Human-readable label"),
 *     @OA\Property(property="color", type="string", example="red", description="UI color hint")
 * )
 * 
 * @OA\Schema(
 *     schema="PaginationMeta",
 *     type="object",
 *     title="Pagination Metadata",
 *     description="Pagination information",
 *     @OA\Property(property="current_page", type="integer", example=1, description="Current page number"),
 *     @OA\Property(property="from", type="integer", example=1, description="First item number on current page"),
 *     @OA\Property(property="last_page", type="integer", example=5, description="Last page number"),
 *     @OA\Property(property="per_page", type="integer", example=15, description="Items per page"),
 *     @OA\Property(property="to", type="integer", example=15, description="Last item number on current page"),
 *     @OA\Property(property="total", type="integer", example=65, description="Total number of items")
 * )
 * 
 * @OA\Schema(
 *     schema="PaginationLinks",
 *     type="object",
 *     title="Pagination Links",
 *     description="Pagination navigation links",
 *     @OA\Property(property="first", type="string", example="http://localhost:8000/api/v1/projects?page=1", description="URL to first page"),
 *     @OA\Property(property="last", type="string", example="http://localhost:8000/api/v1/projects?page=5", description="URL to last page"),
 *     @OA\Property(property="prev", type="string", nullable=true, example=null, description="URL to previous page"),
 *     @OA\Property(property="next", type="string", example="http://localhost:8000/api/v1/projects?page=2", description="URL to next page")
 * )
 * 
 * @OA\Schema(
 *     schema="RegisterRequest",
 *     type="object",
 *     title="Register Request",
 *     description="User registration request payload",
 *     required={"name", "email", "password", "password_confirmation"},
 *     @OA\Property(property="name", type="string", example="John Doe", description="User's full name"),
 *     @OA\Property(property="email", type="string", format="email", example="john@example.com", description="User's email address"),
 *     @OA\Property(property="password", type="string", format="password", example="password123", minLength=8, description="User password (min 8 characters)"),
 *     @OA\Property(property="password_confirmation", type="string", format="password", example="password123", description="Password confirmation (must match password)")
 * )
 * 
 * @OA\Schema(
 *     schema="LoginRequest",
 *     type="object",
 *     title="Login Request",
 *     description="User login request payload",
 *     required={"email", "password"},
 *     @OA\Property(property="email", type="string", format="email", example="admin@example.com", description="User's email address"),
 *     @OA\Property(property="password", type="string", format="password", example="password", description="User password")
 * )
 * 
 * @OA\Schema(
 *     schema="ProjectRequest",
 *     type="object",
 *     title="Project Request",
 *     description="Create/Update project request payload",
 *     required={"name", "status"},
 *     @OA\Property(property="name", type="string", example="Website Redesign", minLength=1, maxLength=255, description="Project name"),
 *     @OA\Property(property="description", type="string", example="Complete redesign of company website", nullable=true, description="Project description"),
 *     @OA\Property(property="status", type="string", enum={"active", "completed", "archived"}, example="active", description="Project status")
 * )
 * 
 * @OA\Schema(
 *     schema="TaskRequest",
 *     type="object",
 *     title="Task Request",
 *     description="Create/Update task request payload",
 *     required={"title", "priority", "status"},
 *     @OA\Property(property="title", type="string", example="Implement user authentication", minLength=1, maxLength=255, description="Task title"),
 *     @OA\Property(property="description", type="string", example="Add JWT authentication to API endpoints", nullable=true, description="Task description"),
 *     @OA\Property(property="priority", type="string", enum={"low", "medium", "high"}, example="high", description="Task priority level"),
 *     @OA\Property(property="status", type="string", enum={"todo", "in_progress", "done"}, example="todo", description="Task status"),
 *     @OA\Property(property="due_date", type="string", format="date", example="2026-12-31", nullable=true, description="Task due date (YYYY-MM-DD)")
 * )
 * 
 * @OA\Schema(
 *     schema="AuthResponse",
 *     type="object",
 *     title="Authentication Response",
 *     description="Successful authentication response",
 *     @OA\Property(property="user", ref="#/components/schemas/User", description="Authenticated user details"),
 *     @OA\Property(property="token", type="string", example="1|AbCdEfGhIjKlMnOpQrStUvWxYz", description="Bearer authentication token")
 * )
 */
class Schemas{}
