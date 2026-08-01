<?php

namespace App\OpenApi;

/**
 * @OA\Post(
 *     path="/api/v1/register",
 *     operationId="register",
 *     tags={"Authentication"},
 *     summary="Register a new user",
 *     description="Create a new user account and receive an authentication token. No authentication required.",
 *     @OA\RequestBody(
 *         required=true,
 *         description="User registration data",
 *         @OA\JsonContent(ref="#/components/schemas/RegisterRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="User registered successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="User registered successfully"),
 *             @OA\Property(property="data", ref="#/components/schemas/AuthResponse")
 *         )
 *     ),
 *     @OA\Response(response=422, ref="#/components/responses/ValidationError"),
 *     @OA\Response(response=500, ref="#/components/responses/ServerError")
 * )
 * 
 * @OA\Post(
 *     path="/api/v1/login",
 *     operationId="login",
 *     tags={"Authentication"},
 *     summary="Login user",
 *     description="Authenticate user with email and password, returns authentication token. No authentication required.",
 *     @OA\RequestBody(
 *         required=true,
 *         description="User login credentials",
 *         @OA\JsonContent(ref="#/components/schemas/LoginRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Login successful",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Login successful"),
 *             @OA\Property(property="data", ref="#/components/schemas/AuthResponse")
 *         )
 *     ),
 *     @OA\Response(response=401, ref="#/components/responses/InvalidCredentials"),
 *     @OA\Response(response=422, ref="#/components/responses/ValidationError"),
 *     @OA\Response(response=500, ref="#/components/responses/ServerError")
 * )
 * 
 * @OA\Post(
 *     path="/api/v1/logout",
 *     operationId="logout",
 *     tags={"Authentication"},
 *     summary="Logout user",
 *     description="Revoke the current user's authentication token. Requires authentication.",
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Logged out successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Logged out successfully"),
 *             @OA\Property(property="data", type="object", nullable=true, example=null)
 *         )
 *     ),
 *     @OA\Response(response=401, ref="#/components/responses/Unauthorized"),
 *     @OA\Response(response=500, ref="#/components/responses/ServerError")
 * )
 */
class AuthEndpoints{}
