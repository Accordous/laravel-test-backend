<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Repositories\PropertyOwnerRepository;

/**
 *  @OA\Get(
 *     path="/dono-propriedade",
 *     tags={"Donos das Propriedades"},
 *     @OA\Response(response="200", description="Retorna todas as contas cadastradas."),
 * ),
 * @OA\Post(
 *   path="/dono-propriedade",
 *     tags={"Donos das Propriedades"},
 *     @OA\Parameter(
 *         in="query",
 *         name="email_owner",
 *         required=true,
 *         @OA\Schema(
 *           type="string",
 *         )
 *     ),
 *   @OA\Response(
 *     response="200",
 *     description="Retorna o registro criado",
 *   ),
 * @OA\RequestBody(
 *     description="Conta criada",
 *     required=false,
 *     @OA\MediaType(
 *       mediaType="application/json",
 *     ),
 *     @OA\MediaType(
 *       mediaType="XMLHttpRequest",
 *     )
 *   )
 * ),
 *  @OA\Get(
 *     path="/dono-propriedade/{id}",
 *     tags={"Donos das Propriedades"},
 *     @OA\Parameter(
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(
 *           type="string",
 *           format="integer"
 *         )
 *     ),
 *     @OA\Response(response="200", description="Retorna um registro pelo ID.")
 * ),
 * @OA\Put(
 *   path="/dono-propriedade/{id}",
 *   tags={"Donos das Propriedades"},
 *     @OA\Parameter(
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(
 *           type="string",
 *           format="integer"
 *         )
 *     ),
 *     @OA\Parameter(
 *         in="query",
 *         name="email_owner",
 *         required=true,
 *         @OA\Schema(
 *           type="string",
 *         )
 *     ),
 *   @OA\Response(
 *     response="200",
 *     description="Retorna o registro Atualizado",
 *   ),
 * @OA\RequestBody(
 *     description="Conta criada",
 *     required=false,
 *     @OA\MediaType(
 *       mediaType="application/json",
 *     ),
 *     @OA\MediaType(
 *       mediaType="XMLHttpRequest",
 *     )
 *   )
 * ),
 *  @OA\Delete(
 *     path="/dono-propriedade/{id}",
 *     tags={"Donos das Propriedades"},
 *     @OA\Parameter(
 *         in="path",
 *         name="id",
 *         required=false,
 *         @OA\Schema(
 *           type="string",
 *           format="integer"
 *         )
 *     ),
 *     @OA\Response(response="200", description="Deleta um registro pelo ID.")
 * ),
 */
class PropertyOwnerController extends Controller
{
    protected $repository;

    public function __construct(PropertyOwnerRepository $repository)
    {
        $this->repository = $repository;
    }
}
