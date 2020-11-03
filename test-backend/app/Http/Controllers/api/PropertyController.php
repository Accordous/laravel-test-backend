<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Repositories\PropertyRepository;

/**
 *  @OA\Get(
 *     path="/propriedades",
 *     tags={"Propriedades"},
 *     @OA\Response(response="200", description="Retorna todas as contas cadastradas."),
 * ),
 * @OA\Post(
 *   path="/propriedades",
 *     tags={"Propriedades"},
 *     @OA\Parameter(
 *         description="E-mail do Proprietário",
 *         in="query",
 *         name="email_owner",
 *         required=true,
 *         @OA\Schema(
 *           type="string",
 *         )
 *     ),
 *     @OA\Parameter(
 *         description="Rua",
 *         in="query",
 *         name="street",
 *         required=true,
 *         @OA\Schema(
 *           type="string",
 *         )
 *     ),
 *     @OA\Parameter(
 *         description="Numero da Casa",
 *         in="query",
 *         name="number",
 *         required=true,
 *         @OA\Schema(
 *           type="string",
 *         )
 *     ),
 *     @OA\Parameter(
 *         description="Bairro",
 *         in="query",
 *         name="neighborhood",
 *         required=true,
 *         @OA\Schema(
 *           type="string",
 *         )
 *     ),
 *     @OA\Parameter(
 *         description="Cidade",
 *         in="query",
 *         name="city",
 *         required=true,
 *         @OA\Schema(
 *           type="string",
 *         )
 *     ),
 *     @OA\Parameter(
 *         description="Estado, exemplo: MG",
 *         in="query",
 *         name="state",
 *         required=true,
 *         @OA\Schema(
 *           type="string",
 *         )
 *     ),
 *    @OA\Parameter(
 *         description="C ou NC (C => Contratado, NC => Não Contratado)",
 *         in="query",
 *         name="status",
 *         required=false,
 *         @OA\Schema(
 *           type="enum",
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
 *     )
 *   )
 * ),
 *  @OA\Get(
 *     path="/propriedades/{id}",
 *     tags={"Propriedades"},
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
 *   path="/propriedades/{id}",
 *   tags={"Propriedades"},
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
 *         description="E-mail do Proprietário",
 *         in="query",
 *         name="email_owner",
 *         required=true,
 *         @OA\Schema(
 *           type="string",
 *         )
 *     ),
 *     @OA\Parameter(
 *         description="Rua",
 *         in="query",
 *         name="street",
 *         required=true,
 *         @OA\Schema(
 *           type="string",
 *         )
 *     ),
 *     @OA\Parameter(
 *         description="Numero da Casa",
 *         in="query",
 *         name="number",
 *         required=true,
 *         @OA\Schema(
 *           type="string",
 *         )
 *     ),
 *     @OA\Parameter(
 *         description="Bairro",
 *         in="query",
 *         name="neighborhood",
 *         required=true,
 *         @OA\Schema(
 *           type="string",
 *         )
 *     ),
 *     @OA\Parameter(
 *         description="Cidade",
 *         in="query",
 *         name="city",
 *         required=true,
 *         @OA\Schema(
 *           type="string",
 *         )
 *     ),
 *     @OA\Parameter(
 *         description="Estado, exemplo: MG",
 *         in="query",
 *         name="state",
 *         required=true,
 *         @OA\Schema(
 *           type="string",
 *         )
 *     ),
 *    @OA\Parameter(
 *         description="C ou NC (C => Contratado, NC => Não Contratado)",
 *         in="query",
 *         name="status",
 *         required=false,
 *         @OA\Schema(
 *           type="enum",
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
 *     )
 *   )
 * ),
 *  @OA\Delete(
 *     path="/propriedades/{id}",
 *     tags={"Propriedades"},
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
 *   @OA\Get(
 *     path="/propriedades-contratos/{id}",
 *     tags={"Propriedades"},
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
 */
class PropertyController extends Controller
{
    protected $repository;

    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function contract($id)
    {
        return $this->repository->contract($id);
    }
}
