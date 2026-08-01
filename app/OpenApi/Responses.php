<?php

namespace App\OpenApi;

/**
 * @OA\Response(
 *     response="SuccessResponse",
 *     description="Successful operation",
 *     @OA\JsonContent(
 *         @OA\Property(property="success", type="boolean", example=true, description="Operation success status"),
 *         @OA\Property(property="message", type="string", example="Operation successful", description="Success message"),
 *         @OA\Property(property="data", type="object", nullable=true, description="Response data")
 *     )
 * )
 * 
 * @OA\Response(
 *     response="CreatedResponse",
 *     description="Resource created successfully",
 *     @OA\JsonContent(
 *         @OA\Property(property="success", type="boolean", example=true, description="Operation success status"),
 *         @OA\Property(property="message", type="string", example="Resource created successfully", description="Success message"),
 *         @OA\Property(property="data", type="object", description="Created resource data")
 *     )
 * )
 * 
 * @OA\Response(
 *     response="DeletedResponse",
 *     description="Resource deleted successfully",
 *     @OA\JsonContent(
 *         @OA\Property(property="success", type="boolean", example=true, description="Operation success status"),
 *         @OA\Property(property="message", type="string", example="Resource deleted successfully", description="Success message"),
 *         @OA\Property(property="data", type="object", nullable=true, example=null, description="Response data (usually null for deletes)")
 *     )
 * )
 * 
 * @OA\Response(
 *     response="Unauthorized",
 *     description="Unauthenticated - Missing or invalid authentication token",
 *     @OA\JsonContent(
 *         @OA\Property(property="message", type="string", example="Unauthenticated.", description="Error message")
 *     )
 * )
 * 
 * @OA\Response(
 *     response="Forbidden",
 *     description="Forbidden - User lacks permission to perform this action",
 *     @OA\JsonContent(
 *         @OA\Property(property="success", type="boolean", example=false, description="Operation success status"),
 *         @OA\Property(property="message", type="string", example="Unauthorized", description="Error message"),
 *         @OA\Property(property="errors", type="object", nullable=true, description="Additional error details")
 *     )
 * )
 * 
 * @OA\Response(
 *     response="NotFound",
 *     description="Resource not found",
 *     @OA\JsonContent(
 *         @OA\Property(property="success", type="boolean", example=false, description="Operation success status"),
 *         @OA\Property(property="message", type="string", example="Resource not found", description="Error message"),
 *         @OA\Property(property="errors", type="object", nullable=true, description="Additional error details")
 *     )
 * )
 * 
 * @OA\Response(
 *     response="ValidationError",
 *     description="Validation failed - The given data was invalid",
 *     @OA\JsonContent(
 *         @OA\Property(property="success", type="boolean", example=false, description="Operation success status"),
 *         @OA\Property(property="message", type="string", example="The given data was invalid.", description="Error message"),
 *         @OA\Property(
 *             property="errors",
 *             type="object",
 *             description="Field-specific validation errors",
 *             @OA\Property(
 *                 property="email",
 *                 type="array",
 *                 @OA\Items(type="string", example="The email field is required.")
 *             ),
 *             @OA\Property(
 *                 property="password",
 *                 type="array",
 *                 @OA\Items(type="string", example="The password must be at least 8 characters.")
 *             )
 *         )
 *     )
 * )
 * 
 * @OA\Response(
 *     response="InvalidCredentials",
 *     description="Invalid login credentials",
 *     @OA\JsonContent(
 *         @OA\Property(property="success", type="boolean", example=false, description="Operation success status"),
 *         @OA\Property(property="message", type="string", example="Invalid credentials", description="Error message"),
 *         @OA\Property(property="errors", type="object", nullable=true, description="Additional error details")
 *     )
 * )
 * 
 * @OA\Response(
 *     response="ServerError",
 *     description="Internal server error",
 *     @OA\JsonContent(
 *         @OA\Property(property="success", type="boolean", example=false, description="Operation success status"),
 *         @OA\Property(property="message", type="string", example="Internal server error", description="Error message"),
 *         @OA\Property(property="errors", type="object", nullable=true, description="Additional error details")
 *     )
 * )
 * 
 * @OA\Response(
 *     response="TooManyRequests",
 *     description="Too many requests - Rate limit exceeded",
 *     @OA\JsonContent(
 *         @OA\Property(property="message", type="string", example="Too Many Attempts.", description="Rate limit message")
 *     )
 * )
 * 
 * @OA\Response(
 *     response="Conflict",
 *     description="Conflict - Resource already exists or operation conflicts with current state",
 *     @OA\JsonContent(
 *         @OA\Property(property="success", type="boolean", example=false, description="Operation success status"),
 *         @OA\Property(property="message", type="string", example="Resource already exists", description="Error message"),
 *         @OA\Property(property="errors", type="object", nullable=true, description="Additional error details")
 *     )
 * )
 */
class Responses{}
