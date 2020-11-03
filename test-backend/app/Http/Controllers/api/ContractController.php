<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Repositories\ContractRepository;

/**
 *  @OA\Get(
 *     path="/contratos",
 *     tags={"Contratos"},
 *     @OA\Response(response="200", description="Retorna todas as contas cadastradas."),
 * ),
 * @OA\Post(
 *   path="/contratos",
 *     tags={"Contratos"},
 *     @OA\Parameter(
 *         description="ID da Propriedade",
 *         in="query",
 *         name="property_id",
 *         required=true,
 *         @OA\Schema(
 *           type="string",
 *           format="integer"
 *         )
 *     ),
 *    @OA\Parameter(
 *         description="PF ou PJ (PF => Pessoa Fisíca, PJ => Pessoa Jurídica)",
 *         in="query",
 *         name="person",
 *         required=false,
 *         @OA\Schema(
 *           type="enum",
 *         )
 *     ),
 *     @OA\Parameter(
 *         description="CPF OU CNPJ",
 *         in="query",
 *         name="document",
 *         required=true,
 *         @OA\Schema(
 *           type="string",
 *         )
 *     ),
 *     @OA\Parameter(
 *         description="Email do Contratante",
 *         in="query",
 *         name="contractor_email",
 *         required=true,
 *         @OA\Schema(
 *           type="string",
 *         )
 *     ),
 *     @OA\Parameter(
 *         description="Nome do Contratante",
 *         in="query",
 *         name="name",
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
 *     )
 *   )
 * ),
 *  @OA\Get(
 *     path="/contratos/{id}",
 *     tags={"Contratos"},
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
 *   path="/contratos/{id}",
 *   tags={"Contratos"},
 *     @OA\Parameter(
 *         description="ID da Propriedade",
 *         in="query",
 *         name="property_id",
 *         required=true,
 *         @OA\Schema(
 *           type="string",
 *           format="integer"
 *         )
 *     ),
 *    @OA\Parameter(
 *         description="PF ou PJ (PF => Pessoa Fisíca, PJ => Pessoa Jurídica)",
 *         in="query",
 *         name="person",
 *         required=false,
 *         @OA\Schema(
 *           type="enum",
 *         )
 *     ),
 *     @OA\Parameter(
 *         description="CPF OU CNPJ",
 *         in="query",
 *         name="document",
 *         required=true,
 *         @OA\Schema(
 *           type="string",
 *         )
 *     ),
 *     @OA\Parameter(
 *         description="Email do Contratante",
 *         in="query",
 *         name="contractor_email",
 *         required=true,
 *         @OA\Schema(
 *           type="string",
 *         )
 *     ),
 *    @OA\Parameter(
 *         description="Nome do Contratante",
 *         in="query",
 *         name="name",
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
 *     )
 *   )
 * ),
 *  @OA\Delete(
 *     path="/contratos/{id}",
 *     tags={"Contratos"},
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
class ContractController extends Controller
{
    protected $repository;

    public function __construct(ContractRepository $repository)
    {
        $this->repository = $repository;
    }
}
